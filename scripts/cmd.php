<?php
error_reporting(0);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
if (!empty($_GET)) {
    $CMD = $_GET['CMD'];
    switch ($CMD) {
        case "reboot":
            echo "Reboot";
            //$val=shell_exec("/var/www/html/scripts/reboot.sh 2>&1");
            //header('Content-Type: application/json; charset=utf-8');
            //echo json_encode($val);
            break;
        case "nothing":
            echo "nothing";
            break;
        default:
            echo "Empty";
    }
} else {
    echo "error-1";	
}
?>
