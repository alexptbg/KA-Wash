<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
//include($_SERVER['DOCUMENT_ROOT']."/".$config['base_dir']."/lang/clients.".$lang);
check_login($appname);
if ($user_settings['level'] >= 20) {
//next
if(!empty($_POST)){
	//$card = $_POST['card'];
	$type = $_POST['type'];
	$date = date("Y-m-d");
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
		$sql = "INSERT INTO `clients` (type,date,number,name,phone,email,region,municipal,grad_celo,address,company_name,mol,ddc,eik) 
                VALUES ('".$type."','".$date."','".$number."','".$name."','".$phone."','".$email."','".$region."','".$municipal."','".$grad_celo."','".addslashes($address)."','".$company_name."','".$mol."','".$ddc."','".$eik."')";
        $check_client = check_company_before_insert($company_name,$ddc);
	}
	if($type == "person") {
		$egn = $_POST['egn'];
		$sql = "INSERT INTO `clients` (type,date,number,name,phone,email,region,municipal,grad_celo,address,egn) 
                VALUES ('".$type."','".$date."','".$number."','".$name."','".$phone."','".$email."','".$region."','".$municipal."','".$grad_celo."','".addslashes($address)."','".$egn."')";
        $check_client = check_person_before_insert($egn);
	}
	
	
    //continue
	if ( (!empty($sql)) ) {
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
                    "msg" => $kl25
                ];
                if($type == "company") {
					insert_log($user_settings['username'],get_client_ip(),"primary","ul006","(".$company_name.")");	
				}
				if($type == "person") {
				    insert_log($user_settings['username'],get_client_ip(),"primary","ul006","(".$name.")");	
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
	echo $k025." (1)";
}
//end 
} else {
	echo "<p>".$k037."</p>";
}
?>
