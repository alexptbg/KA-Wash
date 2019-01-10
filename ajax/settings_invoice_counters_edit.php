<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if((!empty($_POST)) && ($user_settings['level'] >= 50)) {
	$invoice_id = "1";
	$invoice_value = $_POST['invoice_value'];
	$invoice_antes = $_POST['invoice_antes'];
	$invoice_depois = $_POST['invoice_depois'];
	$order_id = "2";
	$order_value = $_POST['order_value'];
	$order_antes = $_POST['order_antes'];
	$order_depois = $_POST['order_depois'];

    $confirm = $_POST['confirm'];
    //continue
	if (!empty($_POST)) {
		$errors = array();
        if ($confirm == "YES") {
			$sql1 = "UPDATE `counters` SET `value`='".$invoice_value."',`antes`='".$invoice_antes."',`depois`='".$invoice_depois."' WHERE `id`='".$invoice_id."' AND `name`='invoice'";
			
			$sql2 = "UPDATE `counters` SET `value`='".$order_value."',`antes`='".$order_antes."',`depois`='".$order_depois."' WHERE `id`='".$order_id."' AND `name`='order'";
			
            $local->set_charset("utf8");
            if($local->query($sql1) === false || $local->query($sql2) === false) {
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
