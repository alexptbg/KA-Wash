<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if((!empty($_POST)) && ($user_settings['level'] >= 20)) {
	$id = $_POST['id'];
	$card = $_POST['card'];
	//$client = get_client($_POST['id']);
    //continue
	if ( (!empty($card)) ) {
        $check = check_client_card_before_insert($id,$card);
        if($check == TRUE) {
			//rfid card exists in another client
		    echo "NOOK";
		} else {
		    echo "OK";	
		}
	} else {
	    echo $k025." (2)";
	}
} else {
	echo "<p>".$k037."</p>";
}
?>
