<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
//try
if(!empty($_POST)) {
	$order_id = $_POST['order_id'];
	$client_id = $_POST['client_id'];
	$check_id = $_POST['check_id'];	
    $sql="DELETE FROM `check_list` WHERE `id`='".$check_id."' AND `order_id`='".$order_id."' AND `client_id`='".$client_id."'";
    if($local->query($sql) === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
	    echo "OK";
	}
}
?>
