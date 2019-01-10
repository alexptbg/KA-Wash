<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if((!empty($_POST)) && ($user_settings['level'] >= 50)) {
	$c_id = $_POST['id'];
	$show_logo = $_POST['show_logo'];
	$show_address = $_POST['show_address'];
	$show_country = $_POST['show_country'];
	$show_phone = $_POST['show_phone'];
	$show_email = $_POST['show_email'];
	$show_website = $_POST['show_website'];
	$show_bank = $_POST['show_bank'];

    $confirm = $_POST['confirm'];
    //continue
	if (!empty($_POST)) {
		$errors = array();
        if ($confirm == "YES") {
			$sql="UPDATE `settings_mycompany` SET `show_address`='".$show_address."',`show_country`='".$show_country."',`show_phone`='".$show_phone."',`show_email`='".$show_email."',`show_website`='".$show_website."',`show_logo`='".$show_logo."',`show_bank`='".$show_bank."' WHERE `id`='".$c_id."'";
            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
                $i=0;
                $errors[$i] = [
                    "name" => "err",
                    "errnr" => "6201",
                    "error" => $k070
                ];
                $i++;
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $k071
                ];
				insert_log($user_settings['username'],get_client_ip(),"danger","k072","");	
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
