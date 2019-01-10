<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
if(!empty($_GET)) {
	$order_id = $_GET['order_id'];
	$client_id = $_GET['client_id'];
	$client = get_client($client_id);
}
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
//order
$order_options = array();
$sql="SELECT * FROM `counters` WHERE `id`='2' AND `name`='order'";
$result=$local->query($sql);
if($result === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
} else {
        if($result->num_rows==1) {
            $order_options = mysqli_fetch_assoc($result);
        }
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
        <!-- lAUNdry icons -->
        <link rel="stylesheet" type="text/css" href="assets/laundry/css/pe-laundry-icons.css" />
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
                        <li><a href="settings_invoice.php" class="material-ripple"><i class="material-icons">insert_drive_file</i><?=$k060?></a></li>
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
                            <i class="pe-ly-tumble-dry"></i>
                        </div>
                        <div class="header-title">
                            <h1><?=$k150?></h1>
                            <small><?=$k050?></small>
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="pe-7s-home"></i>&nbsp;<?=$k012?></a></li>
                                <li><?=$k050?></li>
                                <li class="active"><?=$k150?></li>
                            </ol>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4><i class="fa fa-align-justify" aria-hidden="true"></i>&nbsp;<?=$k133?>&nbsp;#<?=$order_id?></h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive" id="printx">
									  <div class="space20">
										<table id="order" class="table">
											<tbody>
												<?php if($firma['order_show_logo']=="yes"): ?>
												<tr>
                                                    <td class="tac" colspan="2" style="border:none;">
                                                        <img src="<?=$logo_file?>" alt="logo" class="mycompany-logo-invoice m-t-10" />
													</td>
												</tr>
												<?php endif; ?>
												<tr>
												    <td style="width:50%;border:none;"><h3><?=$k146?></h3></td>
												    <td style="width:50%;border:none;"><h3><?=$k145?></h3></td>
												</tr>
												<tr>
													<td>
														<?php if($client['type']=="person"): ?>
														<h5><strong><?=$k146?>:&nbsp;</strong><?=$client['name']?></h5>
														<?php endif; ?>
														<?php if($client['type']=="company"): ?>
														<h5><strong><?=$k146?>:&nbsp;</strong><?=$client['company_name']?></h5>
														<?php endif; ?>
													</td>
													<td>
														<h5><strong><?=$k145?>:&nbsp;</strong><?=$firma['name']?></h5>
													</td>
												</tr>
												<tr>
													<td style="border:none;">
														<h5><strong><?=$k080?>:&nbsp;</strong><?=$client['grad_celo']?></h5>
													</td>
													<td style="border:none;">
														<h5><strong><?=$k080?>:&nbsp;</strong><?=$firma['city']?></h5>
													</td>
												</tr>
												<tr>
													<td style="border:none;">
														<h5><strong><?=$kl07?>:&nbsp;</strong><?=stripslashes($client['address'])?></h5>
													</td>
													<td style="border:none;">
														<h5><strong><?=$kl07?>:&nbsp;</strong><?=stripslashes($firma['address'])?></h5>
													</td>
												</tr>	
												<tr>
													<td style="border:none;">
														<?php if($client['type']=="person"): ?>
														<h5><strong><?=$kl21?>:&nbsp;</strong><?=$client['egn']?></h5>
														<?php endif; ?>
														<?php if($client['type']=="company"): ?>
														<h5><strong><?=$kl16?>:&nbsp;</strong><?=$client['eik']?></h5>
														<?php endif; ?>
													</td>
													<td style="border:none;">
														<h5><strong><?=$kl16?>:&nbsp;</strong><?=$firma['eik']?></h5>
													</td>
												</tr>	
												<tr>
													<td style="border:none;">
														<?php if($client['type']=="person"): ?>
														<h5><strong><?=$kl17?>:&nbsp;</strong><?=$client['egn']?>&nbsp;</h5>
														<?php endif; ?>
														<?php if($client['type']=="company"): ?>
														<h5><strong><?=$kl17?>:&nbsp;</strong><?=$client['ddc']?></h5>
														<?php endif; ?>
													</td>
													<td style="border:none;">
														<h5><strong><?=$kl17?>:&nbsp;</strong><?=$firma['ddc']?></h5>
													</td>
												</tr>
												<tr>
													<td style="border:none;">
														<?php if($client['type']=="person"): ?>
														<h5><strong><?=$k102?>:&nbsp;</strong><?=$client['name']?></h5>
														<?php endif; ?>
														<?php if($client['type']=="company"): ?>
														<h5><strong><?=$kl22?>:&nbsp;</strong><?=$client['mol']?></h5>
														<?php endif; ?>
													</td>
													<td style="border:none;">
														<h5><strong><?=$kl22?>:&nbsp;</strong><?=$firma['mol']?></h5>
													</td>
												</tr>
												<tr>
													<td style="border:none;">
														<h5><strong><?=$kl09?>:&nbsp;</strong><?=stripslashes($client['phone'])?></h5>
													</td>
													<td style="border:none;">
														<h5><strong><?=$kl09?>:&nbsp;</strong><?=stripslashes($firma['phone'])?></h5>
													</td>
												</tr>	
												<tr><td style="border:none;">&nbsp;</td><td style="border:none;">&nbsp;</td></tr>
												<tr>
													<td>
			                                            <?php $ord = str_pad($order_id,$order_options['depois'],"0",STR_PAD_LEFT);?>
			                                            
													    <h3><?=$k148?>:&nbsp;<?php echo $order_options['antes'].$ord; ?></h3>
													</td>
													<td>
													    <h3><?=$k149?>:&nbsp;<?=$order['date']?></h3>
													</td>
												</tr>
												<tr>
													<td colspan="2">
														<br/>
														
										<table id="services" class="table table-bordered table-striped"><thead><tr><th><?php echo $wa38;?></th><th><?php echo $k135;?></th><th><?php echo $wa39;?></th><th><?php echo $wa37;?></th></tr></thead>
										    <tbody>
											<?php
											$services = explode(",",$order['services']);
											$e = 1;
											foreach($services as $service) {
											    $ex = explode("-",$service);
											    echo "
											    <tr>
											        <td>".$e."</td>
											        <td>".get_service_name($ex[0])."</td>
											        <td>";
											        if ($ex[1] == "kg") { echo $wa07; }
											        if ($ex[1] == "un") { echo $wa27; }
											    echo "
											        </td>
											        <td>".$ex[2]."</td>
											    </tr>
											    ";
											    $e++;
											}
											?>

											</tbody>
										</table>
														
													</td>
												</tr>
												<tr><td style="border:none;">&nbsp;</td><td style="border:none;">&nbsp;</td></tr>
												<tr><td style="border:none;">&nbsp;</td><td style="border:none;">&nbsp;</td></tr>
											    <tr>
											        <td style="border:none;"><h4><?=$k146?>:</h4></td>
											        <td style="border:none;"><h4><?=$k145?>:</h4></td>
											    </tr>
											    <tr><td style="border:none;">&nbsp;</td><td style="border:none;">&nbsp;</td></tr>
											    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
											<tbody>
										</table>
                                      </div>
									</div>
									<!--
									<button type="button" id="btn" class="btn btn-default" onclick="window.history.go(-1);"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;<?php echo $k233; ?></button>
									-->
									<button type="button" id="btn" class="btn btn-primary fr" onclick="printDiv();"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;<?php echo $k153; ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <!-- print -->
        <script type="text/javascript">
        function printDiv() {
            var divToPrint=document.getElementById('printx');
            var newWin=window.open('','<?php echo $order['date']."-".$k132."-".$order_id;?>');
            newWin.document.open();
            newWin.document.write('<!DOCTYPE html><html><head><title><?php echo $order['date']."-".$k132."-".$order_id;?></title>');
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/base.css" type="text/css" />');
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/component_ui.css" type="text/css" />'); 
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/extend.css" type="text/css" />');
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/receipt.css" type="text/css" />');
            newWin.document.write('</head><body>');
            newWin.document.write(divToPrint.innerHTML);
            newWin.document.write('<br/><br/><p><span style="padding-left:30px;"><?=$k180?>&nbsp;<strong><?=$app?>&nbsp;<?=$version?></strong><span>&nbsp;<small>r<?=$revision?></small></span>&nbsp;-&nbsp;<?=$kaweb?></span></p>');
            newWin.document.write('</body></html>');
            newWin.document.close();
            newWin.focus();
            newWin.print();
            setTimeout(function(){newWin.close();},10);
            return false;
        }
        </script>
        <!-- START THEME LABEL SCRIPT -->
        <script type="text/javascript" src="assets/dist/js/app.js"></script>
    </body>
</html>
