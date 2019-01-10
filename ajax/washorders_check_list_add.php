<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
if(!empty($_POST)){
	$order_id = $_POST['order_id'];
	$client_id = $_POST['client_id'];

	$nr = "1";
	$item = $_POST['item'];
	$art_in = $_POST['art_in'];
	$art_out = $_POST['art_out'];

    //continue
	if ( (!empty($order_id)) && (!empty($client_id)) ) {
		
		$errors = array();
		$i=0;

		if (empty($errors)) {
		$data = array();
		$sql = "INSERT INTO `check_list` (order_id,client_id,nr,item,art_in,art_out) VALUES ('".$order_id."','".$client_id."','".$nr."','".$item."','".$art_in."','".$art_out."')";
        //$sql = "INSERT INTO `check_list` (order_id,client_id,item,art_in,art_out) VALUES ('".$order_id."','".$client_id."','".$item."','".$art_in."','".$art_out."')";
        
            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $k221
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
