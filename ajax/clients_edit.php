<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if((!empty($_POST)) && ($user_settings['level'] >= 20)) {
	$id = $_POST['id'];
	
	$type = $_POST['type'];
	$number = $_POST['number'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$region = $_POST['region'];
	$municipal = $_POST['municipal'];
	$grad_celo = $_POST['grad_celo'];
	$address = $_POST['address'];
	
	if($type == "company") {
		$company_name = $_POST['company_name'];
		$mol = $_POST['mol'];
		$ddc = $_POST['ddc'];
		$eik = $_POST['eik'];
		$sql="UPDATE `clients` SET `type`='".$type."',`number`='".$number."',`name`='".$name."',`phone`='".$phone."',`email`='".$email."',`region`='".$region."',`municipal`='".$municipal."',`grad_celo`='".$grad_celo."',`address`='".addslashes($address)."',`company_name`='".$company_name."',`mol`='".$mol."',`ddc`='".$ddc."',`eik`='".$eik."' WHERE `id`='".$id."'";
		$check_client = check_company_before_update($id,$company_name,$ddc);
	}
	if($type == "person") {
		$egn = $_POST['egn'];
		$sql="UPDATE `clients` SET `type`='".$type."',`number`='".$number."',`name`='".$name."',`phone`='".$phone."',`email`='".$email."',`region`='".$region."',`municipal`='".$municipal."',`grad_celo`='".$grad_celo."',`address`='".addslashes($address)."',`egn`='".$egn."' WHERE `id`='".$id."'";
		$check_client = check_person_before_update($id,$egn);
	}

    //continue
	if ( (!empty($id)) ) {
		$errors = array();
		$i=0;
		if ($check_client == TRUE) { 
            $errors[$i] = [
                "name" => "err",
                "errnr" => "2111",
                "error" => $kl24
            ];
            $i++;
		}
		$data = array();
		if (empty($errors)) {
            $local->set_charset("utf8");
            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $kl42
                ];
                if($type == "company") {
					insert_log($user_settings['username'],get_client_ip(),"warning","ul007","(".$company_name.")");	
				}
				if($type == "person") {
				    insert_log($user_settings['username'],get_client_ip(),"warning","ul007","(".$name.")");	
				}
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
