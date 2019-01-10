<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1" />
        <meta name="description" content="<?=$app?>" />
        <meta name="keywords" content="<?=$app?>" />
        <title><?=$app?></title>
        <meta name="author" content="ALEX SOARES | Алекс Соарес" />
        <meta name="generator" content="POWERED BY KA-EX" />
        <meta name="version" content="<?=$version?>" />
        <meta name="created" content="2018-05-01" />
        <meta name="language" content="<?=$lang_name?>" />
        <meta name="hash" content="<?=$hash?>" />
        <!-- FEVICON AND TOUCH ICON -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/dist/img/ico/favicon.png" />
        <link rel="apple-touch-icon" type="image/x-icon" href="assets/dist/img/ico/apple-touch-icon-57-precomposed.png" />
        <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets/dist/img/ico/apple-touch-icon-72-precomposed.png" />
        <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets/dist/img/ico/apple-touch-icon-114-precomposed.png" />
        <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets/dist/img/ico/apple-touch-icon-144-precomposed.png" />
        <!-- STATRT GLOBAL MANDATORY STYLE -->
        <link rel="stylesheet" type="text/css" href="assets/dist/css/base.css" />
        <!-- START PAGE LABEL PLUGINS --> 
        <link rel="stylesheet" type="text/css" href="assets/flag-icon/css/flag-icon.min.css" />
        <link rel="stylesheet" type="text/css" href="assets/plugins/toastr/toastr.min.css" />
        <!-- START THEME LAYOUT STYLE -->
        <link rel="stylesheet" type="text/css" href="assets/dist/css/component_ui.css" />
        <link rel="stylesheet" type="text/css" href="assets/dist/css/skins/black.css" />
        <link rel="stylesheet" type="text/css" href="assets/dist/css/extend.css" />
        <link rel="stylesheet" type="text/css" href="assets/dist/css/ka-ex.css" />
        <link rel="stylesheet" type="text/css" href="assets/dist/css/entypo.css" />
        <!--[if lt IE 9]>
            <script type="text/javascript" src="assets/dist/js/html5shiv.js"></script>
            <script type="text/javascript" src="assets/dist/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="has-particles">
        <!-- Particles -->
        <div id="particles-js"></div>
        <!-- /particles -->
        <!-- Content Wrapper -->
        <div class="login-wrapper has-particles">
            <div class="container-center">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="view-header-login">
                            <h2><strong><?=$app?></strong></h2>
                        </div>
                    </div>

                    <div class="panel-body">
                <form role="form" method="post" action="check.php" id="forms" class="text-center m-t-20">
                    <div class="user-thumb">
                        <img src="assets/dist/img/avatar.png" class="img-responsive img-circle img-thumbnail" alt="thumbnail" />
                    </div>
                    <div class="form-group">
                        <h3><?=$user_settings['firstname']?>&nbsp;<?=$user_settings['lastname']?></h3>
                        <p class="text-muted"><?=$k036?></p>
                        <div class="input-group m-t-20">
                            <input id="username" type="hidden" class="form-control validate[required]" name="username" value="<?=$user_settings['username']?>" />
                            <input id="password" type="password" class="form-control validate[required]" name="password" placeholder="<?=$l04?>" />
                            <i class="fa fa-key"></i>
                            <span class="input-group-btn"> 
                                <button class="btn btn-themed uppercase"><i class="fa fa-unlock-alt" aria-hidden="true"></i>&nbsp;&nbsp;<?=$k034?></button>
                            </span>
                        </div>
                    </div>
                    <div class="text-left">
                        <a href="logout.php" class="text-muted"><strong><?=$k035?>&nbsp;<?=$user_settings['firstname']?>&nbsp;<?=$user_settings['lastname']?>&nbsp;?</strong></a>
                    </div>
                </form>
                    </div>
                    <div class="panel-footer">
                        <div class="copyrights-login">
                            <p><?=$app?>&nbsp;<span><?=$version?>&nbsp;<small>r<?=$revision?></small></span></p>
                            <!--<span><a href="http://ka-ex.net" target="_blank">KA-E<em class="colored">X&nbsp;</em></a> &copy; <script type="text/javascript">document.write(new Date().getFullYear())</script></span>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--
        <div class="login-wrapper has-particles">
            <div class="lock-wrapper-page">
                <div class="text-center">
                    <a href="javascript:void(0)" class="logo-lock"><h2><strong><?=$app?></strong></h2></a>
                </div>
                
                <form role="form" method="post" action="check.php" id="forms" class="text-center m-t-20">
                    <div class="user-thumb">
                        <img src="assets/dist/img/avatar.png" class="img-responsive img-circle img-thumbnail" alt="thumbnail" />
                    </div>
                    <div class="form-group">
                        <h3><?=$user_settings['firstname']?>&nbsp;<?=$user_settings['lastname']?></h3>
                        <p class="text-muted"><?=$k036?></p>
                        <div class="input-group m-t-20">
                            <input id="username" type="hidden" class="form-control validate[required]" name="username" value="<?=$user_settings['username']?>" />
                            <input id="password" type="password" class="form-control validate[required]" name="password" placeholder="<?=$l04?>" />
                            <i class="fa fa-key"></i>
                            <span class="input-group-btn"> 
                                <button class="btn btn-themed uppercase"><i class="fa fa-unlock-alt" aria-hidden="true"></i>&nbsp;&nbsp;<?=$k034?></button>
                            </span>
                        </div>
                    </div>
                    <div class="text-left">
                        <a href="logout.php" class="text-muted"><strong><?=$k035?>&nbsp;<?=$user_settings['firstname']?>&nbsp;<?=$user_settings['lastname']?>&nbsp;?</strong></a>
                    </div>
                </form>
                
            </div>
        </div>
        -->
        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script type="text/javascript" src="assets/plugins/jQuery/jquery-1.12.4.min.js"></script>
        <!-- bootstrap js -->
        <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
        <!--Particles-->
        <script type="text/javascript" src="assets/plugins/particles/js/particles.js"></script>
        <script type="text/javascript" src="assets/plugins/particles/js/particles-script.js"></script>
        <!-- virtual keyboard-->
        <?php if ($virtual_keyboard == "1"): ?>
        <link type="text/css" rel="stylesheet" href="assets/dist/css/jquery.ml-keyboard.css" />
        <script type="text/javascript" src="assets/dist/js/jquery.ml-keyboard.min.js"></script>
		<script type="text/javascript">
		$(function() {
			$("#password").val("");
            $("input").mlKeyboard({layout: 'en_US', active_shift: false});
		});
		</script>
		<?php endif; ?>
		<!-- validation -->
		<link rel="stylesheet" type="text/css" href="assets/plugins/validationEngine/jquery.validationEngine.css" />
		<script type="text/javascript" src="assets/plugins/validationEngine/jquery.validationEngine.js"></script>
		<script type="text/javascript" src="assets/plugins/validationEngine/jquery.validationEngine-<?=$lang?>.js"></script>
		<script type="text/javascript">
        $(function () {
            if(jQuery().validationEngine) {
                $("#forms").validationEngine({promptPosition : "bottomLeft:6"});;
            }
            $(".login-wrapper").fadeIn("slow");
        });
        </script>
        <!-- this page -->
        <?php if ($virtual_keyboard == "0"): ?>
		<script type="text/javascript">
        $(function() {
            $('.lock-wrapper-page').css({
                'position' : 'absolute',
                'left' : '50%',
                'top' : '50%',
                'margin-left' : -$('.lock-wrapper-page').outerWidth()/2,
                'margin-top' : -$('.lock-wrapper-page').outerHeight()/2
            });
        });
        </script>
        <?php else: ?>
		<script type="text/javascript">
        $(function() {
            $('.lock-wrapper-page').css({
                'position' : 'absolute',
                'left' : '50%',
                'top' : '20%',
                'margin-left' : -$('.lock-wrapper-page').outerWidth()/2,
                'margin-top' : -$('.lock-wrapper-page').outerHeight()/5
            });
        });
        </script>
        <?php endif; ?>
    </body>
</html>
