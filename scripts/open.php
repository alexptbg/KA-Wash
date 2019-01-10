<?php
error_reporting(0);
$open = shell_exec("/var/www/html/scripts/open.sh");
if(!empty($open)){
    echo $open;	
}
?>
