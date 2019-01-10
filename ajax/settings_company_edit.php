<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if((!empty($_POST)) && ($user_settings['level'] >= 50)) {
	$c_id = $_POST['id'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$postcode = $_POST['postcode'];
	$city = $_POST['city'];
	$country = $_POST['country'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$website = $_POST['website'];
	$mol = $_POST['mol'];
	$eik = $_POST['eik'];
	$ddc = $_POST['ddc'];
	$bank = $_POST['bank'];
	$iban = $_POST['iban'];
	$bic = $_POST['bic'];
	$titular = $_POST['titular'];
    $confirm = $_POST['confirm'];
    //continue
	if ($confirm == "YES") {
        if (!empty($name)) {
			$sql="UPDATE `settings_mycompany` SET `name`='".$name."',`address`='".addslashes($address)."',`postcode`='".$postcode."',`city`='".$city."',`country`='".$country."',`phone`='".$phone."',`email`='".$email."',`website`='".$website."',`mol`='".$mol."',`eik`='".$eik."',`ddc`='".$ddc."',`bank`='".addslashes($bank)."',`iban`='".$iban."',`bic`='".$bic."',`titular`='".addslashes($titular)."' WHERE `id`='".$c_id."'";
            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
                $i=0;
                $errors[$i] = [
                    "name" => "err",
                    "errnr" => "5001",
                    "error" => $wa29
                ];
                $i++;
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $wa30
                ];
				insert_log($user_settings['username'],get_client_ip(),"danger","ul014","");	
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
