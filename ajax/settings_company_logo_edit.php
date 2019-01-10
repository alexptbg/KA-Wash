<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
$confirm = "NO";
if((!empty($_FILES)) && ($user_settings['level'] >= 50)) {
    if(isset($_FILES['image'])){
        $errors = array();
        $i=0;
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $ext = explode('.',$_FILES['image']['name']);
        $file_ext = strtolower($ext[1]);
        //$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
        $expensions = array("jpeg","jpg","png");
      
        if(in_array($file_ext,$expensions)=== false){
            $errors[$i] = [
                "name" => "err",
                "errnr" => "6001",
                "error" => $s013
            ];
            $i++;
        }
        if($file_size > 1048576) {
            $errors[$i] = [
                "name" => "err",
                "errnr" => "6002",
                "error" => $s014
            ];
            $i++;
        }
        $logo_name = "logo.".$file_ext;
        if(empty($errors)==true) {
            if(move_uploaded_file($file_tmp,"../logo/".$logo_name)) {
		        //echo "Success";
		        $confirm = "YES"; 
		        
                //continue
	            if ($confirm == "YES") {
			        $sql="UPDATE `settings_mycompany` SET `logo`='".$logo_name."' WHERE `id`='".$company_id."'";
                    $local->set_charset("utf8");
                    if($local->query($sql) === false) {
                        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
                    } else {
                        $data = [
                            "name" => "data",
                            "msg" => $s015
                        ];
                        //echo "OK";
				        insert_log($user_settings['username'],get_client_ip(),"danger","ul015","");	
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($data);
	                }
	            }
	
		    }
        } else {
            //print_r($errors);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($errors);
        }
    }
} else {
	echo "<p>".$k037."</p>";
}
?>
