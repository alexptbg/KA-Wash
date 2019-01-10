<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
//check_login($local_settings['appname']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1" />
        <meta name="description" content="SYSTEM" />
        <meta name="keywords" content="SYSTEM" />
        <title>SYSTEM</title>
        <meta name="AUTHOR" content="ALEX SOARES | Алекс Соарес" />
        <meta name="GENERATOR" content="POWERED BY KA-EX" />
        <meta name="VERSION" content="1.0" />
        <meta name="CREATED" content="2017-10-01" />
        <!-- FEVICON AND TOUCH ICON -->
        <link rel="shortcut icon" type="image/x-icon" href="<?=$config['base_url']?>/assets/dist/img/ico/favicon.png" />
        <link rel="apple-touch-icon" type="image/x-icon" href="<?=$config['base_url']?>/assets/dist/img/ico/apple-touch-icon-57-precomposed.png" />
        <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?=$config['base_url']?>/assets/dist/img/ico/apple-touch-icon-72-precomposed.png" />
        <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?=$config['base_url']?>/assets/dist/img/ico/apple-touch-icon-114-precomposed.png" />
        <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?=$config['base_url']?>/assets/dist/img/ico/apple-touch-icon-144-precomposed.png" />
        <!-- STATRT GLOBAL MANDATORY STYLE -->
        <link rel="stylesheet" type="text/css" href="<?=$config['base_url']?>/assets/dist/css/base.css" />
        <!-- START PAGE LABEL PLUGINS --> 
        <!-- START THEME LAYOUT STYLE -->
        <link rel="stylesheet" type="text/css" href="<?=$config['base_url']?>/assets/dist/css/component_ui.css" />
        <link rel="stylesheet" type="text/css" href="<?=$config['base_url']?>/assets/dist/css/skins/component_ui_black.css" />
        <link rel="stylesheet" type="text/css" href="<?=$config['base_url']?>/assets/dist/css/custom.css" />
        <link rel="stylesheet" type="text/css" href="<?=$config['base_url']?>/assets/dist/css/ka-ex.css" />
        <!--[if lt IE 9]>
            <script type="text/javascript" src="<?=$config['base_url']?>/assets/dist/js/html5shiv.js"></script>
            <script type="text/javascript" src="<?=$config['base_url']?>/assets/dist/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="middle-box2 text-center">
            <div class="row">
                <div class="col-sm-12">
                    <div class="error-text2"><h1>403</h1></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="error-desc2">
                        <p>You don't have permission to access this URL on this server.<br/>
                            We apologize. You can go back to main page: </p>
                        <a href="<?=$config['base_url']?>/index.php" class="btn btn-success" style="color:#000;">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="<?=$config['base_url']?>/assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- bootstrap js-->
        <script src="<?=$config['base_url']?>/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>