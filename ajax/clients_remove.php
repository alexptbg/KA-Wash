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
    $confirm = $_POST['confirm'];
    
	if ( (!empty($id)) && (!empty($confirm)) && ($confirm == "YES") ) {
		$client = get_client($_POST['id']);
        $data = array();
        if (empty($errors)) {
            $sql="DELETE FROM `clients` WHERE `id`='".$id."'";
 
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $kl53
                ];
                if($client['type'] == "company") {
					insert_log($user_settings['username'],get_client_ip(),"danger","ul009","(".$client['company_name'].")");	
				}
				if($client['type'] == "person") {
				    insert_log($user_settings['username'],get_client_ip(),"danger","ul009","(".$client['name'].")");	
				}
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($data);
            }
        } else {
			$errors = array();
            $errors[0] = [
                "name" => "err",
                "errnr" => "1113",
                "error" => $ul010
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
