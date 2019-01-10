<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
$lang = $_POST['lang'];
$oblast_id = $_POST['oblast_id'];
//try
$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$local->set_charset("utf8");
$sql="SELECT * FROM `obshtini` WHERE `obshtina_oblast`='".$oblast_id."' ORDER BY `obshtina_id` ASC";
$result=$local->query($sql);
if($result === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
} else {
    if($result->num_rows > 0) {
        echo "<option>".$k045."...</option>";
        while($row = mysqli_fetch_assoc($result)) {
			echo "<option value=\"".$row['obshtina_id']."\">".$row['obshtina_name_'.$lang]."</option>";
		}
    }
}
?>
