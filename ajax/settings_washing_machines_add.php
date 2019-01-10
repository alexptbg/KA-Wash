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
		$sql = "INSERT INTO `washmachinesid` (number,inv,name,brand,model,kg,water_before,water_after,place) VALUES ('".$number."','".$inv."','".$name."','".$brand."','".$model."','".$kg."','".$water_before."','".$water_after."','".$place."')";

            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $wa31
                ];
				insert_log($user_settings['username'],get_client_ip(),"primary","ul017","(".$inv.")");	
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
