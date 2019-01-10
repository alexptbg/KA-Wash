<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
unset($_SESSION[$local_settings['appname']]);
unset($_COOKIE[$local_settings['appname']]);
setcookie($_COOKIE[$local_settings['appname']], false, time() - 3600);
$_SESSION = array();
session_start();
session_unset();
session_destroy(); 
$location = "login.php";
header("location:$location");
?>
