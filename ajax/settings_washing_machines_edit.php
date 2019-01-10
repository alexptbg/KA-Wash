<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if ($user_settings['level'] >= 20) {
//next
if(!empty($_POST)){
	$id = $_POST['id'];
	$number = $_POST['number'];
	$inv = $_POST['inv'];
	$name = $_POST['name'];
	$brand = $_POST['brand'];
	$model = $_POST['model'];
	$kg = $_POST['kg'];
	$water_before = $_POST['water_before'];
	$water_after = $_POST['water_after'];
	$place = $_POST['place'];
    
    //continue
	if ( (!empty($name)) ) {
		$errors = array();
		$i=0;

		if (empty($errors)) {
		$data = array();
		$sql = "UPDATE `washmachinesid` SET `number`='".$number."',`inv`='".$inv."',`name`='".$name."',`brand`='".$brand."',`model`='".$model."',`kg`='".$kg."',`water_before`='".$water_before."',`water_after`='".$water_after."',`place`='".$place."' WHERE `id`='".$id."'";

            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $wa34
                ];
				insert_log($user_settings['username'],get_client_ip(),"warning","ul018","(".$inv."|".$brand."|".$model.")");	
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($data);
            }
		} else {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($errors);
		}
	} else {
	    echo $k025." (2)";
	}
} else {
	echo $k025." (1)";
}
//end 
} else {
	echo "<p>".$k037."</p>";
}
?>
