<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
if(!empty($_POST)){
	$order_id = $_POST['order_id'];
	$order_service = $_POST['order_service'];
	$order_service_name = get_service_name($order_service);
	$order_unit = $_POST['order_unit'];
	$order_quantity = $_POST['order_quantity'];
    //continue
	if ( (!empty($order_id)) && (!empty($order_service)) && (!empty($order_unit)) && (!empty($order_quantity)) ) {
		
		$errors = array();
		$i=0;

		if (empty($errors)) {
		$data = array();
		$sql = "INSERT INTO `orders_temp` (order_id,order_service,order_service_name,order_unit,order_quantity) VALUES ('".$order_id."','".$order_service."','".$order_service_name."','".$order_unit."','".$order_quantity."')";

            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $k140
                ];
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
