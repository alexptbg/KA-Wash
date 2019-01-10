<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if ($user_settings['level'] >= 20) {
//next
if(!empty($_POST)){
	$order_id = $_POST['order_id'];
	$client_id = $_POST['client_id'];
	$card = $_POST['card'];
	$invoice_nr = $_POST['invoice_nr'];
	$payment_method = $_POST['payment_method'];
	$due_date = $_POST['due_date'];

    //continue
	if ( (!empty($order_id)) && (!empty($client_id)) ) {
		$errors = array();
		$i=0;

		if (empty($errors)) {
		$data = array();
		$sql = "INSERT INTO `invoices` (date,added_by,order_id,client_id,card,invoice_nr,payment_method,due_date) 
		        VALUES ('".$today."','".$user_settings['username']."','".$order_id."','".$client_id."','".$card."','".$invoice_nr."','".$payment_method."','".$due_date."')";

            if($local->query($sql) === false) {
                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
            } else {
                $data = [
                    "name" => "data",
                    "msg" => $wa41
                ];
                //update order_id/counter
                $update = "UPDATE `counters` SET `value`='".($invoice_nr+1)."' WHERE `name`='invoice'";
                $local->query($update);
				insert_log($user_settings['username'],get_client_ip(),"warning","ul028","(".$invoice_nr.")");	
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
