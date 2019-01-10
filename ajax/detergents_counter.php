<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
$data = array();
$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$local->set_charset("utf8");
for ($i = 1; $i <= 8; $i++) {
    $sql="SELECT `quantity` FROM `washdetergents` WHERE `pump`='".$i."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
			    $data["prep".$i] = number_format(($row['quantity']/1000),3,'.','');
		    }
        }
    }
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>
