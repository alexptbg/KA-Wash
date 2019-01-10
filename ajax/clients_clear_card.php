<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if((!empty($_POST)) && ($user_settings['level'] >= 50)) {
	$id = $_POST['id'];
	$confirm = $_POST['confirm'];
	$client = get_client($_POST['id']);
    //continue
	if ( (!empty($id)) ) {
		$data = array();
		if (empty($errors)) {
			$sql="UPDATE `clients` SET `card`='' WHERE `id`='".$id."'";
            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $k127
                ];
                if($client['type'] == "company") {
					insert_log($user_settings['username'],get_client_ip(),"danger","ul022","(".$client['card']."|".$client['company_name'].")");	
				}
				if($client['type'] == "person") {
				    insert_log($user_settings['username'],get_client_ip(),"danger","ul022","(".$client['card']."|".$client['name'].")");	
				}
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($data);
            }
		} else {
			$errors = array();
            $errors[0] = [
                "name" => "err",
                "errnr" => "2119",
                "error" => $k128
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
