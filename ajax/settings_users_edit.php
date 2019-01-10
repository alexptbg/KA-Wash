<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if((!empty($_POST)) && ($user_settings['level'] >= 20) || (!empty($_POST)) && ($user_settings['level'] == 10) && ($_POST['username'] == $user_settings['username'])) {
	$id = $_POST['id'];
	$username = $_POST['username'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$access = $_POST['access'];
	$level = $_POST['level'];
	$status = $_POST['status'];
    //continue
	if ( (!empty($id)) && (!empty($username)) && (!empty($firstname)) && (!empty($lastname)) && (!empty($email)) && (!empty($phone)) && (!empty($level)) && (!empty($status)) ) {
		$data = array();
		if (empty($errors)) {
            $sql="UPDATE `users` SET `firstname`='".$firstname."',`lastname`='".$lastname."',`email`='".$email."',`phone`='".$phone."',`access`='".$access."',`level`='".$level."',`status`='".$status."' 
                  WHERE `id`='".$id."' AND `username`='".$username."'";
 
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $u049
                ];
                insert_log($user_settings['username'],get_client_ip(),"warning","ul003","(".$username.")");
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($data);
            }
		} else {
			$errors = array();
            $errors[0] = [
                "name" => "err",
                "errnr" => "1112",
                "error" => $u050
            ];
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
