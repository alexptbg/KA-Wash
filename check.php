<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
$myusername=base64_encode($_POST['username']);
$mypassword=base64_encode($_POST['password']);
ob_start();
check_username($myusername,$mypassword,$local_settings['appname'],$lang);
?>