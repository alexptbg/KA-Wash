<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if ($user_settings['level'] >= 20) {
//next
if(!empty($_POST)){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$access = $_POST['access'];
	$level = $_POST['level'];
	$status = $_POST['status'];
	$check_username = check_username_before_insert($username);
    //continue
	if ( (!empty($username)) && (!empty($password)) && (!empty($firstname)) && (!empty($lastname)) && (!empty($email)) && (!empty($phone)) && (!empty($level)) && (!empty($status)) ) {
		$errors = array();
		$i=0;
		if ($check_username == TRUE) { 
            $errors[$i] = [
                "name" => "err",
                "errnr" => "1111",
                "error" => $u045
            ];
            $i++;
		}
		$data = array();
		if (empty($errors)) {
            $sql="INSERT INTO `users` (username,password,firstname,lastname,email,phone,access,level,status) 
                  VALUES ('".$username."','".md5($password)."','".$firstname."','".$lastname."','".$email."','".$phone."','".$access."','".$level."','".$status."')";
 
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $u046
                ];
                insert_log($user_settings['username'],get_client_ip(),"warning","ul002","(".$username.")");
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
	echo $k025." (1)";
}
//end 
} else {
	echo "<p>".$k037."</p>";
}
?>
