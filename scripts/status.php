<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
ini_set('display_errors', true);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
$now = date("Y-m-d H:i:s");
$data = array();
//get serial number
$serial = shell_exec("cat /proc/cpuinfo | grep Serial | cut -d ' ' -f 2");
if (!$serial) {
    $serial = "0";
}
//get cpu temperature
$cpu = shell_exec("cat /sys/class/thermal/thermal_zone0/temp");
$cpu_temp = number_format($cpu/1000,1);
$cpu_temp = number_format($cpu_temp-$cpufix,1);
//check date time from shell
$shell_timestamp = shell_exec("date +'%s'");
if ((time() - $shell_timestamp) < 65) {
    $shell_datetime = "1";
} else {
    $shell_datetime = "0";
}
//check date time from php
$php_timestamp = time();
if ((time() - $php_timestamp) < 65) {
    $php_datetime = "1";
} else {
    $php_datetime = "0";
}
//get inside temperature
//$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$sql = "SELECT * FROM `temp_inside` ORDER BY `id` DESC LIMIT 1";
$result=$local->query($sql);
if($result === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
} else {
    if($result->num_rows === 1) {
        $tempindata = mysqli_fetch_assoc($result);
        if ((time() - $tempindata['timestamp']) < 65) {
            $tempin = ($tempindata['value']-$tempinfix);
        } else {
            $tempin = "0";
        }
    }
}
if(!empty($tempindata)) {
  //init
  if ((time() - $tempindata['timestamp']) < 65) {
      $tempSensor = "1";
  } else {
      $tempSensor = "0";
  }
} else {
    $tempSensor = "0";
}
//check usb rfid
$rfid = shell_exec("/var/www/html/scripts/tty.sh");
$rfid_data = explode("_",$rfid);
if(!empty($rfid_data[0])) {
    $rfid_tty = str_replace("/dev/","",$rfid_data[0]);
} else {
    $rfid_tty = "0";	
}
if(!empty($rfid_data[9])) {
    $rfid_device = preg_replace('/\s+/','',$rfid_data[9]);
} else {
    $rfid_device = "0";	
}
//check node socket
$client = stream_socket_client("tcp://$localServer:3000",$errno,$errorMessage);
if ($client === false) {
    $socket = "0";
} else {
	$socket = "1";
	fclose($client);
}
//ping
$ping = shell_exec("ping -c 1 -w 1 $masterServer | awk 'FNR == 2 { print $(NF-1) }' | cut -d'=' -f2");
if (empty($ping)) {
    $ping = 0;
} else {
    $ping = preg_replace('/\s+/','',$ping);
}
//rfid reads
$reads = get_counter();
//build
/*
$post = "?inv=".$inv."&serial=".preg_replace('/\s+/','',$serial)."&cputemp=".preg_replace('/\./',',',$cpu_temp)."&stamp=".time()."&shelltime=".$shell_datetime."&phptime=".$php_datetime."&tempin=".preg_replace('/\./',',',$tempin)."&tempsensor=".$tempSensor."&tty=".$rfid_tty."&ttydevice=".$rfid_device."&socket=".$socket."&ping=".preg_replace('/\./',',',$ping)."&reads=".$reads;
$url = "http://".$masterServer."/scripts/status.php".$post;
$response = file_get_contents($url);
//echo $response;
*/
//new
$ip = shell_exec("/var/www/html/scripts/ip.sh");
if (empty($ip)) {
    $ip = "::1";
}
if($local_device['ip'] == preg_replace('/\s+/','',$ip)) {
    $ipstatus = "1";
} else {
    $ipstatus = "0";
}
$sql="INSERT INTO `status` (`dtime`,`inv`,`serial`,`ip`,`ipstatus`,`cputemp`,`timestamp`,`shelltime`,`phptime`,`tempin`,`tempsensor`,`tty`,`ttydevice`,`socket`,`ping`,`revision`,`reads`) 
                    VALUES ('".$now."','".$inv."','".preg_replace('/\s+/','',$serial)."','".preg_replace('/\s+/','',$ip)."','".$ipstatus."','".preg_replace('/\s+/','',$cpu_temp)."','".time()."','".$shell_datetime."','".$php_datetime."','".$tempin."','".$tempSensor."','".$rfid_tty."','".$rfid_device."','".$socket."','".$ping."','".$local_settings['revision']."','".$reads."')";
$result=$master->query($sql);
if($result === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$master->error,E_USER_ERROR);
} else {
    //$last_inserted_id = $local->insert_id;
    //$affected_rows = $local->affected_rows;
    //echo "Inserted resource id ".$master->insert_id;
}
?>
