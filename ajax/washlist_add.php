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
	//$card = $_POST['card'];
	$name = $_POST['name'];
	$weight = $_POST['weight'];
	$unit = $_POST['unit'];
	$price = $_POST['price'];
    $check_washlist = check_washlist_before_insert($name);
    //continue
	if ( (!empty($name)) ) {
		$errors = array();
		$i=0;
		if ($check_washlist == TRUE) { 
            $errors[$i] = [
                "name" => "err",
                "errnr" => "3111",
                "error" => $wa10
            ];
            $i++;
		}
		if (empty($errors)) {
		$data = array();
		$sql = "INSERT INTO `washlist` (name,weight,unit,price) VALUES ('".$name."','".$weight."','".$unit."','".$price."')";

            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $wa09
                ];
				insert_log($user_settings['username'],get_client_ip(),"warning","ul011","(".$name.")");	
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
