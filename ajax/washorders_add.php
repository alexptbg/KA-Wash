<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if(!empty($_POST)){
	$added_by = $user_settings['username'];
	$order_id = $_POST['order_id'];
	$client_id = $_POST['client_id'];
	$card = $_POST['card'];
	$order_end_date = $_POST['order_end_date'];
	$obs = $_POST['obs'];
	$services = $_POST['services'];
	$status = "1"; //order is registered in the system
    //continue
	if ( (!empty($order_id)) && (!empty($client_id)) && (!empty($card)) && (!empty($services)) ) {
		
		$errors = array();
		$i=0;

		if (empty($errors)) {
		    $data = array();
		    $sql = "INSERT INTO `orders` (date,added_by,order_id,client_id,card,services,status,order_end_date,obs) 
		            VALUES ('".$now."','".$added_by."','".$order_id."','".$client_id."','".$card."','".$services."','".$status."','".$order_end_date."','".$obs."')";

            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $k144
                ];
                //update order_id/counter
                $update = "UPDATE `counters` SET `value`='".($order_id+1)."' WHERE `name`='order'";
                $local->query($update);
                //delete orders temp
                $del = "TRUNCATE TABLE `orders_temp`";
                $local->query($del);
                
                insert_log($user_settings['username'],get_client_ip(),"danger","ul023","(".$order_id."|".$client_id."|".$card.")");
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($data);
            }
		} else {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($errors);
		}
		
	}
} else {
	echo $k025." (1)";
}
?>
