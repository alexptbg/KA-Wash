<?php
//error_reporting(0);
defined('start') or die('Direct access not allowed.');
$local_settings = get_local_settings();
$appname = $local_settings['appname'];
$appname_en = $local_settings['appname_en'];
$appname_bg = $local_settings['appname_bg'];
$initlang = $local_settings['init_lang'];
$charset = $local_settings['charset'];
$today = date($local_settings['dateformat']);
$yesterday = date($local_settings['dateformat'],time()-60*60*24);
$tomorrow = date($local_settings['dateformat'],time()+60*60*24);
$now = date($local_settings['dateformat']." ".$local_settings['timeformat_php']);
$timestamp = time();
$php_date_format = $local_settings['dateformat'];
$php_time_format = $local_settings['timeformat_php'];
$php_date_time_format = $local_settings['dateformat']." ".$local_settings['timeformat_php'];
$melka = date($local_settings['dateformat']);
$master = $local_settings['master'];
$timezone = $local_settings['timezone'];
$version = $local_settings['version'];
$revision = $local_settings['revision'];
$salt = $local_settings['salt'];
$status = $local_settings['status'];
$city_en = $local_settings['city_en'];
$city_bg = $local_settings['city_bg'];
$virtual_keyboard = $local_settings['virtual_keyboard'];
$company_id = "0";
$tax = "20%";
$alexya = decrypt($local_settings['serial'],$salt);
session_start();  
if(isset($_GET["lang"])) {
    if(isset($_SESSION[$local_settings['appname'].'_language'])) { unset($_SESSION[$local_settings['appname'].'_language']); } 
	$lang = isset($_GET["lang"]) ? $_GET["lang"] : "$initlang";
	$_SESSION[$local_settings['appname'].'_language'] = isset($_GET["lang"]) ? $_GET["lang"] : "$initlang";
}
if (!isset($_GET["lang"])) {
    if(isset($_SESSION[$local_settings['appname'].'_language'])) {
	    $lang = $_SESSION[$local_settings['appname'].'_language'];
	}
    else {
		$lang = isset($_GET["lang"]) ? $_GET["lang"] : "$initlang";
		$_SESSION[$local_settings['appname'].'_language'] = $lang;
	}	
}
$config['domain'] = "localhost";
$config['base_dir'] = "sys";
$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
//$config['base_url'] .= "://".$_SERVER['HTTP_X_FORWARDED_SERVER'];
//windows//$config['base_url'] .= "s://".$config['domain']."/".$config['base_dir'];
$config['base_url'] .= "://".$config['domain']."/".$config['base_dir'];
include($_SERVER['DOCUMENT_ROOT']."/".$config['base_dir']."/lang/lang.php");
include($_SERVER['DOCUMENT_ROOT']."/".$config['base_dir']."/lang/".$lang.".lang");
$language = country($lang);
$chars = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
$len = 16;
$output = '';
for ($x = 0; $x < $len; $x++)
$output .= $chars[array_rand($chars)];
$hash = $output;
$app = ${'appname_'.$lang};
$city = ${'city_'.$lang};
$cache = 1;//days
if($alexya > $melka) {
    header("Content-Type: text/html; ".$charset."");
    header('Expires: '.gmdate('D, d M Y H:i:s',time()+(60*60*24*$cache)).' GMT');
} else {
    lexy();	
}
$prep_alarm_ora = "4000";
$prep_alarm_red = "2000";
?>
