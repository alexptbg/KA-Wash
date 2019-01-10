<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
if (!empty($_GET['set_master'])) {
    $set_master = $_GET['set_master'];
    //$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    if (!empty($set_master)) {
		$sql="UPDATE `settings` SET `master`='".$set_master."' WHERE `id`='1'";
        if($local->query($sql) === false) {
            trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
        } else {
            echo "Updated ".$local->affected_rows." resource.";
        }
	}
}
?>
