<?php
//sudo chmod u+s /sbin/reboot
$val=shell_exec("/var/www/html/sys/scripts/kantara_restart.sh 2>&1");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($val);
?>
