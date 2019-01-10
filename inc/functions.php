<?php
ini_set('error_reporting',E_ALL);
error_reporting(E_ALL);
ini_set('display_errors',true);
defined('start') or die('Direct access not allowed.');
function get_local_settings() {
	global $local_settings;
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql="SELECT * FROM `settings`";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
            $local_settings = mysqli_fetch_assoc($result);
        }
    }
    return $local_settings;
}
function check_username($username,$password,$appname,$lang) {
	$u = base64_decode($username);
	$p = md5(base64_decode($password));
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT `username` FROM `users` WHERE `username`='".$u."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows == 1) {
            check_password($u,$p,$appname,$lang);
        } else {
			//error username not valid
			$errnr = "1101";
			if ($lang == "bg") {
				$error = "Този потребителско име е невалидно.";
			} else {
				$error = "This username is invalid.";
			}
		    $location = "error.php?errnr=".$errnr."&error=".$error;
		    header("location:$location");	
		}
    }
}
function check_password($username,$password,$appname,$lang) {
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT `username`,`password` FROM `users` WHERE `username`='".$username."' AND `password`='".$password."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows == 1) {
            check_status($username,$password,$appname,$lang);
        } else {
			//error password not valid
	        $errnr = "1102";
			if ($lang == "bg") {
				$error = "Тази парола не е валидна за този потребителско име.";
			} else {
				$error = "This password is not valid for this username.";
			}
		    $location = "error.php?errnr=".$errnr."&error=".$error;
		    header("location:$location");	
		}
    }
}
function check_status($username,$password,$appname,$lang) {
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT `status` FROM `users` WHERE `username`='".$username."' and `password`='".$password."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows == 1) {
            while($row = $result->fetch_assoc()){
                $status = $row['status'];
            }
            if ($status == "Active") {
			    session_name($appname);
                session_start();
			    $_SESSION[$appname] = $appname;
                $_SESSION[$appname.'_username'] = $username;
			    $location = "success.php";
                header("location:$location");
            } elseif ($status == "Deactivated") {
	            $errnr = "1103";
			    if ($lang == "bg") {
				    $error = "Вашият достъп беше деактивиран от администратора на системата.";
			    } else {
				    $error = "Your access was deactivated by the system Administrator.";
			    }
		        $location = "error.php?errnr=".$errnr."&error=".$error;
		        header("location:$location");	
            } elseif ($status == "Pending") {
	            $errnr = "1104";
			    if ($lang == "bg") {
				    $error = "Достъпът ви чака активация от системния администратор.";
			    } else {
				    $error = "Your access is awaiting activation by the system Administrator.";
			    }
		        $location = "error.php?errnr=".$errnr."&error=".$error;
		        header("location:$location");	
            } else {
	            $errnr = "1001";
			    if ($lang == "bg") {
				    $error = "Неизвестна грешка.";
			    } else {
				    $error = "Unknown error.";
			    }
		        $location = "error.php?errnr=".$errnr."&error=".$error;
		        header("location:$location");	
		    }
        } else {
	        $errnr = "1001";
			if ($lang == "bg") {
			    $error = "Неизвестна грешка.";
			} else {
			    $error = "Unknown error.";
			}
		    $location = "error.php?errnr=".$errnr."&error=".$error;
		    header("location:$location");	
		}
    }
}
function update_login($username) {
	$updated = date('Y-m-d H:i:s');
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "UPDATE `users` SET `lastlogin`='".$updated."' WHERE `username`='".$username."'";
    $result=$local->query($sql);
    if($local->query($sql) === false) {
        trigger_error('Wrong SQL: ' .$sql.' Error: '.$local->error, E_USER_ERROR);
    } else {
        $affected_rows = $local->affected_rows;
    }
	$location = "index.php";
	header("location:$location");
}
function check_login($appname){
    if (session_status() == PHP_SESSION_NONE) {
		session_name($appname);
        session_start();
    }
    function check_loggedin($appname) {
		if(isset($_SESSION[$appname]) && ($_SESSION[$appname] != NULL)) {
			return TRUE;
        } else {
			return FALSE;
		}
    }
    if (check_loggedin($appname) == FALSE) {
    	session_start();
        session_destroy();
        $_SESSION[$appname] = NULL;
        unset($_COOKIE[$appname]);
		$location = "login.php";
	    header("location:$location");
    } else {
        header('Content-Type: text/html; charset=utf-8');
	    $user_settings = get_user_settings($_SESSION[$appname.'_username']);
		$_SESSION[$appname] = $appname;
    }
}
function get_user_settings($user) {
	global $user_settings;
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT * FROM `users` WHERE `username`='".$user."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
            $user_settings = mysqli_fetch_assoc($result);
        }
    }
    return $user_settings;
}
function check_username_before_insert($username) {
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql="SELECT `username` FROM `users` WHERE `username`='".$username."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        $c = $result->num_rows;
    }
    if ($c != NULL) { return TRUE; } else { return FALSE; }
}
function get_user($id,$username) {
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT * FROM `users` WHERE `id`='".$id."' AND `username`='".$username."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
            $user_settings = mysqli_fetch_assoc($result);
        }
    }
    return $user_settings;
}
function insert_log($username,$device,$filter,$action,$obs) {
	$datetime = date("Y-m-d H:i:s");
	$timestamp = time();
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
	$sql = "INSERT INTO `logs` (`datetime`,`timestamp`,`username`,`device`,`filter`, `action`,`obs`) 
		    VALUES ('".$datetime."', '".$timestamp."', '".$username."', '".$device."', '".$filter."', '".$action."', '".$obs."')";
    if($local->query($sql) === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        $last_inserted_id = $local->insert_id;
    }
}
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function check_company_before_insert($company_name,$ddc) {
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql="SELECT `company_name`,`ddc` FROM `clients` WHERE `company_name`='".$company_name."' AND `ddc`='".$ddc."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        $c = $result->num_rows;
    }
    if ($c != NULL) { return TRUE; } else { return FALSE; }
}
function check_person_before_insert($egn) {
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql="SELECT `egn` FROM `clients` WHERE `egn`='".$egn."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        $c = $result->num_rows;
    }
    if ($c != NULL) { return TRUE; } else { return FALSE; }
}
function check_company_before_update($id,$company_name,$ddc) {
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql="SELECT `company_name`,`ddc` FROM `clients` WHERE `company_name`='".$company_name."' AND `ddc`='".$ddc."' AND `id` NOT LIKE '".$id."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        $c = $result->num_rows;
    }
    if ($c != NULL) { return TRUE; } else { return FALSE; }
}
function check_person_before_update($id,$egn) {
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql="SELECT `egn` FROM `clients` WHERE `egn`='".$egn."' AND `id` NOT LIKE '".$id."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        $c = $result->num_rows;
    }
    if ($c != NULL) { return TRUE; } else { return FALSE; }
}
function get_oblast($lang,$id) {
	$oblast = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $local->set_charset("utf8");
    $sql="SELECT * FROM `oblasti` WHERE `oblast_id`='".$id."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
        $oblast = $id;
    } else {
        if($result->num_rows == 1) {
			$row = mysqli_fetch_assoc($result);
            $oblast = $row['oblast_name_'.$lang];
        }
    }
    return $oblast;
}
function get_obshtina($lang,$id) {
	$obshtina = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $local->set_charset("utf8");
    $sql="SELECT * FROM `obshtini` WHERE `obshtina_id`='".$id."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
        $obshtina = $id;
    } else {
        if($result->num_rows == 1) {
			$row = mysqli_fetch_assoc($result);
            $obshtina = $row['obshtina_name_'.$lang];
        }
    }
    return $obshtina;
}
function get_client($id) {
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT * FROM `clients` WHERE `id`='".$id."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
            $client_settings = mysqli_fetch_assoc($result);
        }
    }
    return $client_settings;
}
function get_client_card($id) {
	$card = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $local->set_charset("utf8");
    $sql="SELECT * FROM `clients` WHERE `id`='".$id."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
        $card = "0";
    } else {
        if($result->num_rows == 1) {
			$row = mysqli_fetch_assoc($result);
            $card = $row['card'];
        }
    }
    return $card;
}
function get_card_data($card) {
	$card_data = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT * FROM `clients` WHERE `card`='".$card."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
        $card_data = "NULL";
    } else {
        if($result->num_rows ==1) {
            $card_data = mysqli_fetch_assoc($result);
        }
    }
    return $card_data;
}
function get_card_client_name($card) {
	$client_name = "";
	$card_data = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT * FROM `clients` WHERE `card`='".$card."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
        $card_data = "NULL";
    } else {
        if($result->num_rows ==1) {
            $card_data = mysqli_fetch_assoc($result);
            if($card_data['type']=="person") {
		        $client_name = $card_data['name'];
	        } else {
		        $client_name = $card_data['company_name'];
	        }
        } else {
		    $client_name = "";
		}
    }
    return $client_name;
}
function check_client_card_before_insert($id,$card) {
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql="SELECT `card` FROM `clients` WHERE `card`='".$card."' AND `id` NOT LIKE '".$id."'";
    //$sql="SELECT `card` FROM `clients` WHERE `id`='".$id."' AND `card`='".$card."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        $c = $result->num_rows;
    }
    if ($c != NULL) { return TRUE; } else { return FALSE; }
}
function check_washlist_before_insert($name) {
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql="SELECT * FROM `washlist` WHERE `name`='".$name."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        $c = $result->num_rows;
    }
    if ($c != NULL) { return TRUE; } else { return FALSE; }
}
function get_wash($id) {
	$wash_settings = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT * FROM `washlist` WHERE `id`='".$id."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
            $wash_settings = mysqli_fetch_assoc($result);
        }
    }
    return $wash_settings;
}
function check_washlist_before_update($id,$name) {
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql="SELECT * FROM `washlist` WHERE `name`='".$name."' AND `id` NOT LIKE '".$id."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        $c = $result->num_rows;
    }
    if ($c != NULL) { return TRUE; } else { return FALSE; }
}
function get_counter($name) {
	$counter = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT * FROM `counters` WHERE `name`='".$name."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
            $counter = mysqli_fetch_assoc($result);
        }
    }
    return $counter;
}
function price_remove_tax($amount) {
	$value = 0;
	$value = ($amount/1.20);
	return number_format($value,2);
}
function price_calculate_tax_removed($amount,$cleaned) {
	$value = 0;
	$value = ($amount-$cleaned);
	return number_format($value,2);
}
function get_program_data($tableid,$progid) {
	$program_data = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT * FROM `washprograms".$tableid."` WHERE `id`='".$progid."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
        $program_data = "NULL";
    } else {
        if($result->num_rows ==1) {
            $program_data = mysqli_fetch_assoc($result);
        }
    }
    return $program_data;
}
function get_washmachine($id) {
	$washmachine = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT * FROM `washmachinesid` WHERE `id`='".$id."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
            $washmachine = mysqli_fetch_assoc($result);
        }
    }
    return $washmachine;
}
function get_washmachines() {
	$washmachines = array();
    $local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $local->set_charset("utf8");
    $sql="SELECT * FROM `washmachinesid` ORDER BY `id` ASC";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $washmachines[] = $row;
            }
        }
    }
    return $washmachines;	
}
function get_detergent($id) {
	$detergent = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT * FROM `washdetergents` WHERE `id`='".$id."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
            $detergent = mysqli_fetch_assoc($result);
        }
    }
    return $detergent;
}
function count_washmachines() {
	$count = 0;
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT `id` FROM `washmachinesid`";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows >=1) {
           $count = $result->num_rows;
        }
    }
	return $count;
}
function get_detergent_type($lang,$type) {
	$detergent_type = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT * FROM `washdetergentstypes` WHERE `type`='".$type."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
			$row = mysqli_fetch_assoc($result);
            $detergent_type = $row['name_'.$lang];
        }
    }
    return $detergent_type;
}
function get_service_name($id) {
	$service_name = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT * FROM `washlist` WHERE `id`='".$id."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
			$row = mysqli_fetch_assoc($result);
            $service_name = $row['name'];
        }
    }
    return $service_name;
}
function get_service_settings($id) {
	$service_settings = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT * FROM `washlist` WHERE `id`='".$id."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
			$row = mysqli_fetch_assoc($result);
            $service_settings = $row;
        }
    }
    return $service_settings;
}
function get_order_id($order_id,$client_id) {
    $local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $local->set_charset("utf8");
    $order = array();
    $sql="SELECT * FROM `orders` WHERE `order_id`='".$order_id."' AND `client_id`='".$client_id."'";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows==1) {
            $order = mysqli_fetch_assoc($result);
        }
    }
    return $order;
}
function get_raspi_addr() {
    $ip = "";
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "SELECT `ipaddr` FROM `raspi_status` ORDER BY `id` LIMIT 1";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows ==1) {
            $ip = mysqli_fetch_assoc($result);
        }
    }
    return $ip['ipaddr'];
}
function get_clients_in_wash_now($washmachine) {
	//$timed = date("Y-m-d H:i:s",strtotime("-480 minutes"));
	$timed = date("Y-m-d H:i:s",strtotime('today midnight'));
    $clients = "";
    $local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    $local->set_charset("utf8");
    $sql="SELECT `washrfids` FROM `washstatus` WHERE `washmachine`='".$washmachine."' AND `datetime` > '".$timed."' ORDER BY `id` DESC LIMIT 1";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
				if(($row['washrfids'] != "") && ($row['washrfids'] != " ") && !empty($row['washrfids'])) {
			        $clients = $row['washrfids'];
			    }
		    }
        } else {
		    $clients = "";	
		}
    }	
    return $clients;
}
function get_domain($domain) { 
    $domain = explode('/', str_replace('www.', '', str_replace('http://', '', $domain)));
    return $domain[0];
}
function generate_numbers($start, $count, $digits) {
   $result = array();
   for ($n = $start; $n < $start + $count; $n++) {
      $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
   }
   return $result;
}
function encrypt($string,$key) {
  $result = '';
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)+ord($keychar));
    $result.=$char;
  }
  return base64_encode($result);
}
function decrypt($string,$key) {
  $result = '';
  $string = base64_decode($string);
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)-ord($keychar));
    $result.=$char;
  }
  return $result;
}
class Base64 {
     private static $BinaryMap = array(
         'i', 'j', 'c', 'd', 'e', 'f', 'g', 'h', //  7
         'a', 'b', 'k', 'l', 'm', 'n', 'o', 'x', // 15
         'q', 'r', '9', 't', 'u', 'v', 'w', 'x', // 23
         'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', // 31
         'G', 'H', 'I', 'J', 'K', 'L', 'M', 'V', // 39
         'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'N', // 47
         'W', 'P', 'Y', 'Z', '0', '1', '2', '3', // 55
         '4', '5', '6', '7', '8', 'S', '+', '/', // 63 
         '=', //64
     );
     public function __construct() {}
     public function base64_encode($input) {
         $output = "";
         $chr1 = $chr2 = $chr3 = $enc1 = $enc2 = $enc3 = $enc4 = null;
         $i = 0;
         while($i < strlen($input)) {
             $chr1 = ord($input[$i++]);
             $chr2 = ord($input[$i++]);
             $chr3 = ord($input[$i++]);
             $enc1 = $chr1 >> 2;
             $enc2 = (($chr1 & 3) << 4) | ($chr2 >> 4);
             $enc3 = (($chr2 & 15) << 2) | ($chr3 >> 6);
             $enc4 = $chr3 & 63;
             if (is_nan($chr2)) {
                 $enc3 = $enc4 = 64;
             } else if (is_nan($chr3)) {
                 $enc4 = 64;
             }
             $output .=  self::$BinaryMap[$enc1]
                       . self::$BinaryMap[$enc2]
                       . self::$BinaryMap[$enc3]
                       . self::$BinaryMap[$enc4]; 
         }
         return $output;
     }
     public function utf8_encode($input) {
         $utftext = null;   
         for ($n = 0; $n < strlen($input); $n++) {
             $c = ord($input[$n]);
             if ($c < 128) {
                 $utftext .= chr($c);
             } else if (($c > 128) && ($c < 2048)) {
                 $utftext .= chr(($c >> 6) | 192);
                 $utftext .= chr(($c & 63) | 128);
             } else {
                 $utftext .= chr(($c >> 12) | 224);
                 $utftext .= chr((($c & 6) & 63) | 128);
                 $utftext .= chr(($c & 63) | 128);
             }
         }
         return $utftext;
     }
}
function lexy() {
	$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	$local->set_charset("utf8");
    $sql = "UPDATE `settings` SET `status`='0' WHERE `id`='0'";
    $result=$local->query($sql);
    if($local->query($sql) === false) {
        trigger_error('Wrong SQL: ' .$sql.' Error: '.$local->error, E_USER_ERROR);
    } else {
        $affected_rows = $local->affected_rows;
    }
}
function array2table($arr) {
    $count = count($arr);
    if($count > 0){
        reset($arr);
        $num = count(current($arr));
        echo "<div class=\"table-responsive\">\n
				<table class=\"table table-bordered table-hover table-striped table-condensed\">\n
					<thead>\n
						<tr>\n";
        foreach(current($arr) as $key => $value){
            echo "<th>";
            echo $key."&nbsp;";
            echo "</th>\n";  
        }  
        echo "</tr>\n</thead>\n<tbody>\n";
        while ($curr_row = current($arr)) {
            echo "<tr>\n";
            $col = 1;
            while (false !== ($curr_field = current($curr_row))) {
                echo "<td>";
                if ($curr_field instanceof DateTime) {
					echo $curr_field->format('Y-m-d H:i:s')."&nbsp;";
				} else {
					echo $curr_field."&nbsp;";
				}
                echo "</td>\n";
                next($curr_row);
                $col++;
            }
            while($col <= $num){
                echo "<td>&nbsp;</td>\n";
                $col++;      
            }
            echo "</tr>\n";
            next($arr);
        }
        echo "</tbody>\n";
        echo "</table>\n";
        echo "</div>\n";
    }
}
?>
