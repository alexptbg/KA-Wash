<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
$firma = array();
$sql="SELECT * FROM `settings_mycompany` WHERE `id`='".$company_id."'";
$result=$local->query($sql);
if($result === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
} else {
    if($result->num_rows==1) {
        $firma = mysqli_fetch_assoc($result);
    }
}
$logo_path=$_SERVER['DOCUMENT_ROOT']."/".$config['base_dir']."/logo/".$firma['logo'];
if (file_exists($logo_path)) {
    $logo_file="logo/".$firma['logo'];
} else {
    $logo_file="assets/dist/img/logo-not-".$lang.".png";
}
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
    <body>
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <nav class="navbar navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only"><?=$k001?></span>
                        <i class="material-icons" title="<?=$k001?>">apps</i>
                    </button>
                    <a class="navbar-brand" href="index.php">
                        <!--<img class="main-logo" src="<?=$config['base_url']?>/assets/dist/img/logo.png" id="bg" alt="logo" />-->
                        <span><?=$app?></span>
                    </a>
                </div>
                <div class="nav-container">
                    <!-- /.navbar-header -->
                    <ul class="nav navbar-nav hidden-xs">
                        <li><a id="fullscreen" class="themed-tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$k041?>" href="javascript:void(0)" title="<?=$k041?>">
                            <i class="material-icons">fullscreen</i>&nbsp;</a></li>
                    </ul>
                    <!-- right side -->
                    <ul class="nav navbar-top-links navbar-right">
                        <!-- /.Dropdown -->
                        <li class="dropdown themed-tooltip dropdown-lang" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$k014?>">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                                <?php if ($lang == "bg"): ?>
                                <i class="flag-icon flag-icon-24 flag-icon-bg"></i>
                                <?php else: ?>
                                <i class="flag-icon flag-icon-24 flag-icon-gb"></i>
                                <?php endif; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li class="rad-dropmenu-header"><?=$k018?></li>
                                <?php if ($lang == "bg"): ?>
                                <li><a href="?lang=en"><i class="flag-icon flag-icon-gb"></i>&nbsp;&nbsp;<?=$k004?></a></li>
                                <?php elseif ($lang == "en"): ?>
                                <li><a href="?lang=bg"><i class="flag-icon flag-icon-bg"></i>&nbsp;&nbsp;<?=$k005?></a></li>
                                <?php else: ?>
                                <li><a href="?lang=en"><i class="flag-icon flag-icon-gb"></i>&nbsp;&nbsp;<?=$k004?></a></li>
                                <?php endif; ?>
                            </ul><!-- /.dropdown-user -->
                        </li><!-- /.Dropdown -->
                        <!-- /.Dropdown -->
                        <li class="dropdown themed-tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$k002?>">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                                <i class="material-icons">warning</i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span></div>
                                <!--<i class="ti-announcement"></i>-->
                                <!--<i class="ti-angle-down"></i>-->
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <!--<li class="ui_popover_tooltip"></li>-->
                                <li class="rad-dropmenu-header"><?=$k002?></li>
                                <li>
                                    <a class="rad-content" href="#">
                                        <div class="pull-left"><i class="fa fa-html5 fa-2x color-red"></i>
                                        </div>
                                        <div class="rad-notification-body">
                                            <div class="lg-text">Introduction to fetch()</div>
                                            <div class="sm-text">The fetch API</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="rad-dropmenu-footer"><a href="#"><?=$k003?></a></li>
                            </ul>  <!-- /.dropdown-alerts -->
                            <!-- /.dropdown-alerts -->
                        </li>
                        <!-- /.Dropdown -->
                        <li class="dropdown themed-tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$k015?>">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                                <i class="material-icons">person</i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li class="rad-dropmenu-header"><?=$k015?></li>
                                <li><a href="#"><i class=ti-user></i>&nbsp;&nbsp;<?=$k006?></a></li>
                                <li><a href="#"><i class=ti-email></i>&nbsp;&nbsp;<?=$k002?></a></li>
                                <li><a href="#"><i class=ti-settings></i>&nbsp;&nbsp;<?=$k008?></a></li>
                                <li><a href="lock.php"><i class=ti-lock></i>&nbsp;&nbsp;<?=$k007?></a></li>
                                <li><a href="logout.php"><i class=ti-layout-sidebar-left></i>&nbsp;&nbsp;<?=$k010?></a></li>
                            </ul><!-- /.dropdown-user -->
                        </li><!-- /.Dropdown -->
                        <li class="log_out themed-tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$k010?>">
                            <a href="logout.php">
                                <i class="material-icons">power_settings_new</i>
                            </a>
                        </li><!-- /.Log out -->
                    </ul> <!-- /.navbar-top-links -->
                </div>
            </nav>
            <!-- /.Navigation -->
            <div class="sidebar" role="navigation">
                <div class="intro">
                    <p class="tac text-muted">
                        <?=$k038?>,&nbsp;<?=ucfirst($user_settings['firstname'])?>&nbsp;<?=ucfirst($user_settings['lastname'])?>
                    </p>
                    <p class="tac text-muted">
                        <span class="text-themed">[</span><small><?=$user_settings['username']?></small><span class="text-themed">]</span>
                        <span class="themed-tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$k039?>"><span class="text-themed">[</span><small><?=$user_settings['level']?></small><span class="text-themed">]</span></span>
                    </p>
                </div>
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="nav-heading"><span><?=$k011?>&nbsp;&nbsp;&nbsp;<strong>&not;</strong></span></li>
                        <li><a href="index.php" class="material-ripple"><i class="material-icons themed">home</i><?=$k012?></a></li>
                        <li><a href="clients.php" class="material-ripple"><i class="material-icons">people_outline</i><?=$k042?></a></li>
                        <li>
                            <a href="javascript:void(0)" class="material-ripple"><i class="material-icons">local_laundry_service</i><?=$k050?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li><a href="washorders.php"><?=$k129?></a></li>
                                <li><a href="washlist.php"><?=$k051?></a></li>
                            </ul>
                        </li>
                        <?php if($user_settings['level']>50): ?>
                        <li><a href="stats.php" class="material-ripple"><i class="material-icons">pie_chart</i><?=$k053?></a></li>
                        <?php endif; ?>
                        <li>
                            <a href="javascript:void(0)" class="material-ripple"><i class="material-icons">reorder</i><?=$k040?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li><a href="user_logs.php"><?=$k185?></a></li>
                                <li><a href="wash_status.php"><?=$k186?></a></li>
                                <li><a href="raspi_logs.php">RASPBERRY</a></li>
                            </ul>
                        </li>
                        <li class="nav-heading"><span><?=$k013?>&nbsp;&nbsp;&nbsp;<strong>&not;</strong></span></li>
                        <li>
                            <a href="javascript:void(0)" class="material-ripple"><i class="material-icons">local_laundry_service</i><?=$s016?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li><a href="settings_washing_machines.php"><?=$s026?></a></li>
                                <!--<li class="active"><a href="settings_laundry_programs.php"><?=$s017?></a></li>-->
                                <li class="has-sub"><a href="javascript:void(0)"><?=$s017?></a>
                                    <?php $washmachines = get_washmachines(); ?>
                                    <?php if(!empty($washmachines)): ?>
								    <ul class="nav collapse">
										<?php
										foreach($washmachines as $single) {
											echo "<li><a href=\"settings_laundry_programs.php?washid=".$single['number']."\"><span class=\"title\">".$k110." ".$single['number']."</span></a></li>";	
									    }
									    ?>
								    </ul>
                                    <?php endif; ?>
                                </li>
                                <li><a href="settings_detergents.php"><?=$k112?></a></li>
                            </ul>
                        </li>
                        <li><a href="settings_users.php" class="material-ripple"><i class="material-icons">people</i><?=$k019?></a></li>
                        <li><a href="settings_company.php" class="material-ripple"><i class="material-icons">business</i><?=$s001?></a></li>
                        <li class="active"><a href="settings_invoice.php" class="material-ripple"><i class="material-icons">insert_drive_file</i><?=$k060?></a></li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
                <div class="copyrights">
                    <p><?=$app?>&nbsp;<span><?=$version?>&nbsp;<small>r<?=$revision?></small></span></p>
                    <span><em class="zagmar">Za<span class="blued bolder">G</span>maR</em>&nbsp;&reg;&nbsp;<a href="http://ka-ex.net" target="_blank">KA-E<em class="colored">X&nbsp;</em></a>&nbsp;&copy;&nbsp;<script type="text/javascript">document.write(new Date().getFullYear())</script></span>
                </div>
            </div>
            <!-- /.Left Sidebar-->
            <!-- /.Navbar  Static Side -->
            <div class="control-sidebar-bg"></div>
            <!-- Page Content -->
            <div id="page-wrapper">
                <!-- main content -->
                <div class="content">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="header-icon">
                            <i class="pe-7s-file"></i>
                        </div>
                        <div class="header-title">
                            <h1><?=$k060?></h1>
                            <small><?=$k008?></small>
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="pe-7s-home"></i>&nbsp;<?=$k012?></a></li>
                                <li><?=$k008?></li>
                                <li class="active"><?=$k060?></li>
                            </ol>
                        </div>
                    </div> 
                    <!-- /. Content Header (Page header) -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;<?=$k059?></h4>
                                        <div class="buttons fr">
                                            <?php if ($user_settings['level'] >= 50): ?>
                                            <a type="button" class="btn btn-warning btn-xs btn-panel" id="edit" href="settings_invoice_counters_edit.php" data-remote="true" data-toggle="modal" data-target="#modal-lg" data-backdrop="static" data-tag="<?=$k202?>" data-class="modal-warning"><i class="fa fa-sticky-note themed-tooltip" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$k203?>"></i></a>
                                            
                                        	<a type="button" class="btn btn-danger btn-xs btn-panel" id="edit" href="settings_invoice_edit.php" data-remote="true" data-toggle="modal" data-target="#modal-lg" data-backdrop="static" data-tag="<?=$k062?>" data-class="modal-danger"><i class="fa fa-edit themed-tooltip" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$k061?>"></i></a>
                                        	<?php else: ?>
                                        	<button type="button" class="btn btn-warning btn-xs btn-panel themed-tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$k203?>" disabled="disabled"><i class="fa fa-sticky-note themed-tooltip" aria-hidden="true"></i></button>
                                        	
                                        	<button type="button" class="btn btn-danger btn-xs btn-panel themed-tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$k061?>" disabled="disabled"><i class="fa fa-edit themed-tooltip" aria-hidden="true"></i></button>
                                        	<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
								
								<?php if(!empty($firma)): ?>
                                <div class="panel-body">
                                    <div class="row" id="invoice">
                                        <div class="col-sm-4 empty-space">
                                            &nbsp;
                                        </div>
										<div class="col-sm-4 text-center">
                                            <h1 class="m-t-0">
												<?=$k073?>
											</h1>
                                            <h2 class="m-t-10">
												<?=$k074?>
											</h2>
                                            <h4 class="m-t-20">
												<?php $inv = str_pad(get_counter("invoice")['value'],get_counter("invoice")['depois'],"0",STR_PAD_LEFT);?>
												<?=$k076?>:&nbsp;<?php echo get_counter("invoice")['antes'].$inv; ?>
											</h4>
                                            <h4 class="m-t-0">
												<?=$kl34?>:&nbsp;<?=$today?>
											</h4>
                                            <h4 class="m-t-0">
												<?=$k077?>:&nbsp;<?=$tomorrow?>
											</h4>
										</div>
                                        <div class="col-sm-4 empty-space text-right">
											<?php if($firma['show_logo']=="yes"): ?>
                                            <img src="<?=$logo_file?>" alt="logo" class="mycompany-logo-invoice m-t-10" />
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-sm-5 invoice-border">
										    <div class="col-sm-30">
												<h5><?=$k078?>:&nbsp;</h5>
												<h5><?=$kl17?>:&nbsp;</h5>
												<h5><?=$kl16?>:&nbsp;</h5>
												<h5><?=$k080?>:&nbsp;</h5>
												<h5><?=$kl07?>:&nbsp;</h5>
												<h5><?=$kl22?>:&nbsp;</h5>
												<h5><?=$kl30?>:&nbsp;</h5>
											</div>
											<div class="col-sm-70">
												<h5>КА-ЕКС 96 ЕООД</h5>
												<h5>BG0123456789</h5>
												<h5>0123456789</h5>
												<h5>Гоце Делчев</h5>
												<h5>ул. 'Христо Ботев' 12</h5>
												<h5>Име и Фамилия</h5>
												<h5>0891234564</h5>
											</div>                                            
                                        </div>
                                        <div class="col-sm-2 empty-space">
                                            &nbsp;
                                        </div>
                                        <div class="col-sm-5 invoice-border text-right">
										    <div class="col-sm-30 tal">
												<h5><?=$k079?>:&nbsp;</h5>
												<h5><?=$kl17?>:&nbsp;</h5>
												<h5><?=$kl16?>:&nbsp;</h5>
												<?php if($firma['show_country']=="yes"): ?>
												<h5><?=$k091?>:&nbsp;</h5>
												<?php endif; ?>
												<h5><?=$k080?>:&nbsp;</h5>
												<?php if($firma['show_address']=="yes"): ?>
												<h5><?=$kl07?>:&nbsp;</h5>
												<?php endif; ?>
												<h5><?=$kl22?>:&nbsp;</h5>
												<?php if($firma['show_phone']=="yes"): ?>
												<h5><?=$kl30?>:&nbsp;</h5>
												<?php endif; ?>
												<?php if($firma['show_email']=="yes"): ?>
												<h5><?=$kl10?>:&nbsp;</h5>
												<?php endif; ?>
												<?php if($firma['show_website']=="yes"): ?>
												<h5><?=$kl55?>:&nbsp;</h5>
												<?php endif; ?>
											</div>
											<div class="col-sm-70 tal">
												<h5><?=$firma['name']?></h5>
												<h5><?=$firma['ddc']?></h5>
												<h5><?=$firma['eik']?></h5>
												<?php if($firma['show_country']=="yes"): ?>
												<h5><?=stripslashes($firma['country'])?></h5>
												<?php endif; ?>
												<h5><?=$firma['city']?></h5>
												<?php if($firma['show_address']=="yes"): ?>
												<h5><?=stripslashes($firma['address'])?></h5>
												<?php endif; ?>
												<h5><?=$firma['mol']?></h5>
												<?php if($firma['show_phone']=="yes"): ?>
												<h5><?=$firma['phone']?></h5>
												<?php endif; ?>
												<?php if($firma['show_email']=="yes"): ?>
												<h5><?=$firma['email']?></h5>
												<?php endif; ?>
												<?php if($firma['show_website']=="yes"): ?>
												<h5><?=$firma['website']?></h5>
												<?php endif; ?>
											</div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="table-responsive m-b-0 m-t-20">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><?=$k081?></th>
                                                    <th><?=$k082?></th>
                                                    <th><?=$k083?></th>
                                                    <th><?=$k084?></th>
                                                    <th><?=$k085?></th>
                                                    <th><?=$k086?></th>
                                                    <th><?=$k087?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>&nbsp;</td>
                                                    <td>Бяло с прах и омекотител</td>
                                                    <td>КГ</td>
                                                    <td>10</td>
                                                    <td><?php echo price_remove_tax("3.20");?></td>
                                                    <td><?php echo price_remove_tax("32.00");?></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>&nbsp;</td>
                                                    <td>Гладене на чаршафи</td>
                                                    <td>КГ</td>
                                                    <td>5</td>
                                                    <td><?php echo price_remove_tax("5.20");?></td>
                                                    <td><?php echo price_remove_tax("26.00");?></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>&nbsp;</td>
                                                    <td>Бяло с прах</td>
                                                    <td>Бр</td>
                                                    <td>6</td>
                                                    <td><?php echo price_remove_tax("2.50");?></td>
                                                    <td><?php echo price_remove_tax("15.00");?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row m-t-0">
                                        <div class="col-sm-7">
											<?php if($firma['show_bank']=="yes"): ?>
												<h5><?=$s007?>:&nbsp;<?=stripslashes($firma['bank'])?></h5>
												<h5><?=$s008?>:&nbsp;<?=$firma['iban']?></h5>
												<h5><?=$s010?>:&nbsp;<?=$firma['bic']?></h5>
												<h5><?=$s012?>:&nbsp;<?=stripslashes($firma['titular'])?></h5>
											<?php endif; ?>
										</div>
                                        <div class="col-sm-5 text-right">
										    <div class="col-sm-10">
											    <h4><?=$k088?>:&nbsp;</h4>
											    <h4><?=$k089?>;&nbsp;<?=$tax?>:&nbsp;</h4>
											    <h4><?=$k090?>:&nbsp;</h4>
											</div>
											<div class="col-sm-2 tar">
											   <h4><?php echo price_remove_tax("73.00"); ?></h4>
											   <h4><?php echo price_calculate_tax_removed("73.00",price_remove_tax("73.00")); ?></h4>
											   <h4>73.00</h4>
											</div>
										</div>
									</div>
                                    
                                </div>
                                <!--
                                <div class="panel-footer">
                                    <button type="button" id="btn" class="btn btn-primary fr" onclick="printDiv();"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;<?php echo $k153; ?></button>
                                </div>
                                -->
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /row -->                    
                </div> <!-- /.main content -->
            </div><!-- /#page-wrapper -->
            <!-- Modal large -->
            <div class="modal fade" id="modal-lg" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                            <h2 class="modal-title"></h2>
                        </div>
                        <div class="modal-body"></div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- Modal -->
            <div class="modal fade" id="modal-n" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                            <h2 class="modal-title"></h2>
                        </div>
                        <div class="modal-body"></div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- Modal small -->
            <div class="modal fade" id="modal-sm" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                            <h2 class="modal-title"></h2>
                        </div>
                        <div class="modal-body"></div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- Modals end -->
        </div><!-- /#wrapper -->
        <!-- START CORE PLUGINS -->
        <script type="text/javascript" src="assets/plugins/jQuery/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="assets/dist/js/jquery-migrate.min.js"></script>
        <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/plugins/metisMenu/metisMenu.min.js"></script>
        <script type="text/javascript" src="assets/plugins/lobipanel/lobipanel.min.js"></script>
        <script type="text/javascript" src="assets/plugins/animsition/js/animsition.min.js"></script>
        <script type="text/javascript" src="assets/plugins/fastclick/fastclick.min.js"></script>
        <script type="text/javascript" src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script type="text/javascript" src="assets/plugins/toastr/toastr.min.js"></script>
        <!-- STRAT PAGE LABEL PLUGINS -->
        <!-- modals-->
        <script type="text/javascript">
        $(function () {
            $("#modal-lg").on("show.bs.modal", function(e) {
                var link = $(e.relatedTarget);
                $(this).find(".modal-body").load(link.attr("href"));
                $(this).find("h2.modal-title").text(link.attr("data-tag"));
                $("#modal-lg").removeClass();
                $("#modal-lg").addClass("modal fade");
                $("#modal-lg").addClass(link.attr("data-class"));
            });
            $("#modal-n").on("show.bs.modal", function(e) {
                var link = $(e.relatedTarget);
                $(this).find(".modal-body").load(link.attr("href"));
                $(this).find("h2.modal-title").text(link.attr("data-tag"));
                $("#modal-n").removeClass();
                $("#modal-n").addClass("modal fade");
                $("#modal-n").addClass(link.attr("data-class"));
            });
            $("#modal-sm").on("show.bs.modal", function(e) {
                var link = $(e.relatedTarget);
                $(this).find(".modal-body").load(link.attr("href"));
                $(this).find("h2.modal-title").text(link.attr("data-tag"));
                $("#modal-sm").removeClass();
                $("#modal-sm").addClass("modal fade");
                $("#modal-sm").addClass(link.attr("data-class"));
            });
        });
        </script>
		<!-- validation -->
		<link rel="stylesheet" type="text/css" href="assets/plugins/validationEngine/jquery.validationEngine.css" />
		<script type="text/javascript" src="assets/plugins/validationEngine/jquery.validationEngine.js"></script>
		<script type="text/javascript" src="assets/plugins/validationEngine/jquery.validationEngine-<?=$lang?>.js"></script>
        <!-- START THEME LABEL SCRIPT -->
        <script type="text/javascript" src="assets/dist/js/app.js"></script>
        <!-- pdf -->
        <script type="text/javascript" src="assets/plugins/jspdf/jspdf.min.js"></script>
        <script type="text/javascript" src="assets/plugins/jspdf/plugins/from_html.js"></script>
        <script type="text/javascript" src="assets/plugins/jspdf/plugins/split_text_to_size.js"></script>
        <script type="text/javascript" src="assets/plugins/jspdf/plugins/standard_fonts_metrics.js"></script>
        <script type="text/javascript" src="assets/plugins/canvg.min.js"></script>
        <script type="text/javascript" src="assets/plugins/html2canvas.min.js"></script>
        <!-- print -->
        <!--
        <script type="text/javascript">
        function printDiv() {
            var divToPrint=document.getElementById('invoice');
            var newWin=window.open('','<?=$k059?>');
            newWin.document.open();
            newWin.document.write('<html><head><title><?=$k059?></title>');
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/base.css" type="text/css" />');
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/component_ui.css" type="text/css" />'); 
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/extend.css" type="text/css" />');
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/print.css" type="text/css" />');
            newWin.document.write('</head><body>');
            newWin.document.write(divToPrint.innerHTML);
            newWin.document.write('</body></html>');
            //newWin.document.close();
            //newWin.focus()
            //newWin.print();
            //setTimeout(function(){newWin.close();},10);
            return false;
        }
        </script>
        -->
    </body>
</html>
