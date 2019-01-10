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
    $confirm = $_POST['confirm'];
    
	if ( (!empty($confirm)) && ($confirm == "YES") ) {
        $data = array();
        if (empty($errors)) {
            $sql="TRUNCATE TABLE `washstatus`";
 
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $lo16
                ];
                insert_log($user_settings['username'],get_client_ip(),"danger","lo15","");
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($data);
            }
        } else {
			$errors = array();
            $errors[0] = [
                "name" => "err",
                "errnr" => "1114",
                "error" => $lo12
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
