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
	$quantity = $_POST['quantity'];
    $detergent = get_detergent($id);
    $plus = ($detergent['quantity']+$quantity);
    $total = ($detergent['total']+$quantity);
    //continue
	if ( (!empty($pump)) ) {
		$errors = array();
		$i=0;

		if (empty($errors)) {
		$data = array();
		$sql = "UPDATE `washdetergents` SET `quantity`='".$plus."',`total`='".$total."' WHERE `id`='".$id."' AND `pump`='".$pump."'";
        
            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $ul024
                ];
				insert_log($user_settings['username'],get_client_ip(),"warning","ul025","(".$pump."|".$quantity.")");	
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
