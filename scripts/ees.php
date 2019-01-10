<?php
//local server
define('DB_SERVER',''); // set database host
define('DB_USER',''); // set database user
define('DB_PASS',''); // set database password
define('DB_NAME',''); // set database name

$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

//ees server
define('EES_SERVER',''); // set database host
define('EES_USER',''); // set database user
define('EES_PASS',''); // set database password
define('EES_DB',''); // set database name

$ees = new mysqli(EES_SERVER,EES_USER,EES_PASS,EES_DB);

$now = date("Y-m-d H:i:s");

$local_settings = get_local_settings();

$local_device = get_local_device();

$eth0 = shell_exec("/var/www/html/scripts/ip.sh");
if (empty($eth0)) {
    $eth0 = "::1";
}

$serial = shell_exec("cat /proc/cpuinfo | grep Serial | cut -d ' ' -f 2");
if (!$serial) {
    $serial = "0";
}

$sql="INSERT INTO `back_status` (datetime,ipaddr,serial,inv) VALUES ('".$now."','".$eth0."','".$serial."','".$local_device['inv']."')";

if($ees->query($sql) === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$ees->error,E_USER_ERROR);
} else {
    echo "Resource id #".$ees->insert_id. " inserted.";
}
	
function get_local_settings() {
	global $local_settings;
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql="SELECT * FROM `settings`";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
            $local_settings = mysqli_fetch_assoc($result);
        }
    }
    return $local_settings;
}
function get_local_device() {
	global $local_device;
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql="SELECT * FROM `device`";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
            $local_device = mysqli_fetch_assoc($result);
        }
    }
    return $local_device;
}
?>
