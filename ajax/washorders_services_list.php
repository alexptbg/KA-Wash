<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
//try
if(!empty($_POST)) {
	$order_id = $_POST['order_id'];
    $services_list = array();
    $local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $local->set_charset("utf8");
    $sql="SELECT * FROM `orders_temp` WHERE `order_id`='".$order_id."' ORDER BY `id` ASC";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
                $services_list[] = $row;
            }
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($services_list);
        }
    }
}
?>
