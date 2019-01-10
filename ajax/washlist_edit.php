<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if((!empty($_POST)) && ($user_settings['level'] >= 20)) {
	$id = $_POST['id'];

	$name = $_POST['name'];
	$weight = $_POST['weight'];
	$unit = $_POST['unit'];
	$price = $_POST['price'];

    $check_wash = check_washlist_before_update($id,$name);

    //continue
	if ( (!empty($id)) ) {
		$errors = array();
		$i=0;
		if ($check_wash == TRUE) { 
            $errors[$i] = [
                "name" => "err",
                "errnr" => "4112",
                "error" => $wa17
            ];
            $i++;
		}
		$data = array();
		if (empty($errors)) {
			$sql="UPDATE `washlist` SET `name`='".$name."',`weight`='".$weight."',`unit`='".$unit."',`price`='".$price."' WHERE `id`='".$id."'";
            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $wa16
                ];
				insert_log($user_settings['username'],get_client_ip(),"warning","ul012","(".$name.")");	
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
