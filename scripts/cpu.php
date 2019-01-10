<?php
define('start',TRUE);
error_reporting(0);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
$cpu = shell_exec("cat /sys/class/thermal/thermal_zone0/temp");
$cpu_temp = number_format($cpu/1000,1);
$cpu_temp = number_format($cpu_temp-$cpufix,1);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($cpu_temp);
?>
