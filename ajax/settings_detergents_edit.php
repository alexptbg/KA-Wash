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
	$pump = $_POST['pump'];
	$inv = $_POST['inv'];
	$name = $_POST['name'];
	$brand = $_POST['brand'];
	$model = $_POST['model'];
	$type = $_POST['type'];
	$calibration = $_POST['calibration'];
	$pwm = $_POST['pwm'];
	//$quantity = $_POST['quantity'];
	//$total = $_POST['total'];

    //continue
	if ( (!empty($pump)) ) {
		$errors = array();
		$i=0;

		if (empty($errors)) {
		$data = array();
		//$sql = "UPDATE `washdetergents` SET `pump`='".$pump."',`inv`='".$inv."',`name`='".$name."',`brand`='".$brand."',`model`='".$model."',`type`='".$type."',`calibration`='".$calibration."',`pwm`='".$pwm."',`quantity`='".$quantity."',`total`='".$total."' WHERE `id`='".$id."'";
        $sql = "UPDATE `washdetergents` SET `pump`='".$pump."',`inv`='".$inv."',`name`='".$name."',`brand`='".$brand."',`model`='".$model."',`type`='".$type."',`calibration`='".$calibration."',`pwm`='".$pwm."' WHERE `id`='".$id."'";
        
            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $wa36
                ];
				insert_log($user_settings['username'],get_client_ip(),"warning","ul021","(".$pump."|".$inv."|".$brand."|".$model.")");	
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
