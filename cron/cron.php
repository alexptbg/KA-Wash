<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
//washstatus standard is disabled
/*
$sql1="DELETE FROM `washstatus` WHERE `datetime` < DATE_SUB(NOW(), INTERVAL 7 DAY);";
if($local->query($sql1) === false) {
  trigger_error('Wrong SQL: '.$sql1.' Error: '.$local->error,E_USER_ERROR);
} else {
  $affected_rows = $local->affected_rows;
}
*/
//raspi status
$sql2="DELETE FROM `raspi_status` WHERE `datetime` < DATE_SUB(NOW(), INTERVAL 1 DAY);";
if($local->query($sql2) === false) {
  trigger_error('Wrong SQL: '.$sql2.' Error: '.$local->error,E_USER_ERROR);
} else {
  $affected_rows = $local->affected_rows;
}
echo $affected_rows;
?>
