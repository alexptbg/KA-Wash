<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
//try
if(!empty($_POST)) {
	$order_id = $_POST['order_id'];
	$id = $_POST['id'];
    $sql="DELETE FROM `orders_temp` WHERE `id`='".$id."'";
    if($local->query($sql) === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
	    echo "OK";
	}
}
?>
