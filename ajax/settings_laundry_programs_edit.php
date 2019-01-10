<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if((!empty($_POST)) && ($user_settings['level'] >= 50)) {
	$tableid = $_POST['tableid'];
	$progid = $_POST['progid'];
	$confirm = $_POST['confirm'];
	
	$s1p1 = $_POST['s1p1'];
	$s1p2 = $_POST['s1p2'];
	$s1p3 = $_POST['s1p3'];
	$s1p4 = $_POST['s1p4'];
	$s1p5 = $_POST['s1p5'];
	$s1p6 = $_POST['s1p6'];
	$s1p7 = $_POST['s1p7'];
	$s1p8 = $_POST['s1p8'];
	$s1time = $_POST['s1time'];
	$s1name = $_POST['s1name'];
	$s2p1 = $_POST['s2p1'];
	$s2p2 = $_POST['s2p2'];
	$s2p3 = $_POST['s2p3'];
	$s2p4 = $_POST['s2p4'];
	$s2p5 = $_POST['s2p5'];
	$s2p6 = $_POST['s2p6'];
	$s2p7 = $_POST['s2p7'];
	$s2p8 = $_POST['s2p8'];
	$s2time = $_POST['s2time'];
	$s2name = $_POST['s2name'];
	$s3p1 = $_POST['s3p1'];
	$s3p2 = $_POST['s3p2'];
	$s3p3 = $_POST['s3p3'];
	$s3p4 = $_POST['s3p4'];
	$s3p5 = $_POST['s3p5'];
	$s3p6 = $_POST['s3p6'];
	$s3p7 = $_POST['s3p7'];
	$s3p8 = $_POST['s3p8'];
	$s3time = $_POST['s3time'];
	$s3name = $_POST['s3name'];
	$s4p1 = $_POST['s4p1'];
	$s4p2 = $_POST['s4p2'];
	$s4p3 = $_POST['s4p3'];
	$s4p4 = $_POST['s4p4'];
	$s4p5 = $_POST['s4p5'];
	$s4p6 = $_POST['s4p6'];
	$s4p7 = $_POST['s4p7'];
	$s4p8 = $_POST['s4p8'];
	$s4time = $_POST['s4time'];
	$s4name = $_POST['s4name'];
	$s5p1 = $_POST['s5p1'];
	$s5p2 = $_POST['s5p2'];
	$s5p3 = $_POST['s5p3'];
	$s5p4 = $_POST['s5p4'];
	$s5p5 = $_POST['s5p5'];
	$s5p6 = $_POST['s5p6'];
	$s5p7 = $_POST['s5p7'];
	$s5p8 = $_POST['s5p8'];
	$s5time = $_POST['s5time'];
	$s5name = $_POST['s5name'];
	$s6p1 = $_POST['s6p1'];
	$s6p2 = $_POST['s6p2'];
	$s6p3 = $_POST['s6p3'];
	$s6p4 = $_POST['s6p4'];
	$s6p5 = $_POST['s6p5'];
	$s6p6 = $_POST['s6p6'];
	$s6p7 = $_POST['s6p7'];
	$s6p8 = $_POST['s6p8'];
	$s6time = $_POST['s6time'];
	$s6name = $_POST['s6name'];
	$s7p1 = $_POST['s7p1'];
	$s7p2 = $_POST['s7p2'];
	$s7p3 = $_POST['s7p3'];
	$s7p4 = $_POST['s7p4'];
	$s7p5 = $_POST['s7p5'];
	$s7p6 = $_POST['s7p6'];
	$s7p7 = $_POST['s7p7'];
	$s7p8 = $_POST['s7p8'];
	$s7time = $_POST['s7time'];
	$s7name = $_POST['s7name'];
	$s8p1 = $_POST['s8p1'];
	$s8p2 = $_POST['s8p2'];
	$s8p3 = $_POST['s8p3'];
	$s8p4 = $_POST['s8p4'];
	$s8p5 = $_POST['s8p5'];
	$s8p6 = $_POST['s8p6'];
	$s8p7 = $_POST['s8p7'];
	$s8p8 = $_POST['s8p8'];
	$s8time = $_POST['s8time'];
	$s8name = $_POST['s8name'];
	
	if ( (!empty($progid)) && (!empty($confirm)) && ($confirm == "YES") ) {
		
	$sql="UPDATE `washprograms".$tableid."` SET `s1p1`='".$s1p1."',`s1p2`='".$s1p2."',`s1p3`='".$s1p3."',`s1p4`='".$s1p4."',`s1p5`='".$s1p5."',`s1p6`='".$s1p6."',`s1p7`='".$s1p7."',`s1p8`='".$s1p8."',`s1time`='".$s1time."',`s1name`='".$s1name."',`s2p1`='".$s2p1."',`s2p2`='".$s2p2."',`s2p3`='".$s2p3."',`s2p4`='".$s2p4."',`s2p5`='".$s2p5."',`s2p6`='".$s2p6."',`s2p7`='".$s2p7."',`s2p8`='".$s2p8."',`s2time`='".$s2time."',`s2name`='".$s2name."',`s3p1`='".$s3p1."',`s3p2`='".$s3p2."',`s3p3`='".$s3p3."',`s3p4`='".$s3p4."',`s3p5`='".$s3p5."',`s3p6`='".$s3p6."',`s3p7`='".$s3p7."',`s3p8`='".$s3p8."',`s3time`='".$s3time."',`s3name`='".$s3name."',`s4p1`='".$s4p1."',`s4p2`='".$s4p2."',`s4p3`='".$s4p3."',`s4p4`='".$s4p4."',`s4p5`='".$s4p5."',`s4p6`='".$s4p6."',`s4p7`='".$s4p7."',`s4p8`='".$s4p8."',`s4time`='".$s4time."',`s4name`='".$s4name."',`s5p1`='".$s5p1."',`s5p2`='".$s5p2."',`s5p3`='".$s5p3."',`s5p4`='".$s5p4."',`s5p5`='".$s5p5."',`s5p6`='".$s5p6."',`s5p7`='".$s5p7."',`s5p8`='".$s5p8."',`s5time`='".$s5time."',`s5name`='".$s5name."',`s6p1`='".$s6p1."',`s6p2`='".$s6p2."',`s6p3`='".$s6p3."',`s6p4`='".$s6p4."',`s1p6`='".$s6p5."',`s6p6`='".$s6p6."',`s6p7`='".$s6p7."',`s6p8`='".$s6p8."',`s6time`='".$s6time."',`s6name`='".$s6name."',`s7p1`='".$s7p1."',`s7p2`='".$s7p2."',`s7p3`='".$s7p3."',`s7p4`='".$s7p4."',`s7p5`='".$s7p5."',`s7p6`='".$s7p6."',`s7p7`='".$s7p7."',`s7p8`='".$s7p8."',`s7time`='".$s7time."',`s7name`='".$s7name."',`s8p1`='".$s8p1."',`s8p2`='".$s8p2."',`s8p3`='".$s8p3."',`s8p4`='".$s8p4."',`s8p5`='".$s8p5."',`s8p6`='".$s8p6."',`s8p7`='".$s8p7."',`s8p8`='".$s8p8."',`s8time`='".$s8time."',`s8name`='".$s8name."' WHERE `id`='".$progid."'";

    //continue
		$errors = array();
		$data = array();
		if (empty($errors)) {
            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $s025
                ];
				insert_log($user_settings['username'],get_client_ip(),"danger","ul016","(".$tableid."/".$progid.")");	
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($data);
            }
		} else {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($errors);
		}
	} else {
	    echo $k025." (2)";
	}
} else {
	echo "<p>".$k037."</p>";
}
?>
