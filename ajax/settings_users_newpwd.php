<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if ($user_settings['level'] >= 50) {
//next
if(!empty($_POST)){
	$id = $_POST['id'];
	$username = $_POST['username'];
	$password = $_POST['password'];
    $confirm = $_POST['confirm'];
    //continue
	if ( (!empty($id)) && (!empty($username)) && (!empty($password)) && (!empty($confirm)) && ($confirm == "YES") ) {
		$data = array();
		if (empty($errors)) {
            $sql="UPDATE `users` SET `password`='".md5($password)."' WHERE `id`='".$id."' AND `username`='".$username."'";
 
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $u056
                ];
                insert_log($user_settings['username'],get_client_ip(),"danger","ul004","(".$username.")");
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($data);
            }
		} else {
			$errors = array();
            $errors[0] = [
                "name" => "err",
                "errnr" => "1112",
                "error" => $u057
            ];
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
