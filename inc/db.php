<?php
defined('start') or die ('Direct access not allowed.');
//server
//define('DB_SERVER','127.0.0.1'); // set database host
define('DB_SERVER','');
define('DB_USER',''); // set database user
define('DB_PASS',''); // set database password
define('DB_NAME',''); // set database name

$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$local->set_charset("utf8");
/*
if ($local->connect_error) {
  trigger_error('Database connection failed: '.$local->connect_error,E_USER_ERROR);
}
if (!$local->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $local->error);
    exit();
} else {
    printf("Current character set: %s\n", $local->character_set_name());
}
*/
?>
