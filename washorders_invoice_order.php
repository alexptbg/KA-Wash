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
$invoice_options = array();
$sql="SELECT * FROM `invoices` WHERE `order_id`='".$order_id."' AND `client_id`='".$client_id."'";
$result=$local->query($sql);
if($result === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
} else {
    if($result->num_rows==1) {
        $invoice_options = mysqli_fetch_assoc($result);
    } else {
	}
}
//echo $invoice_exists ? 'true' : 'false';
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
                            <h1><?=$k160?></h1>
                            <small><?=$k050?></small>
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="pe-7s-home"></i>&nbsp;<?=$k012?></a></li>
                                <li><?=$k050?></li>
                                <li class="active"><?=$k160?></li>
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
										<table id="invoice_order" class="table">
											<tbody>
												<tr>
													<td style="border:none;" class="td1">
														<h1 class="original"><?=$k162?></h1>
													</td>
                                                    <td class="tar td1" style="border:none;">
														<?php if($firma['show_logo']=="yes"): ?>
                                                        <img src="<?=$logo_file?>" alt="logo" class="mycompany-logo-invoice m-t-10" />
                                                        <?php endif; ?>
													</td>
												</tr>
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
														<?php if($firma['show_address']=="yes"): ?>
														<h5><strong><?=$kl07?>:&nbsp;</strong><?=stripslashes($firma['address'])?></h5>
														<?php endif; ?>
														<!--
														<?php if($firma['show_country']!="yes"): ?>
														<h5 style="margin-top:15px;"><strong><?=$k091?>:&nbsp;</strong><?=stripslashes($firma['country'])?></h5>
														<?php endif; ?>
														-->
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
												<?php if($firma['show_email']=="yes"): ?>
												<tr>
													<td style="border:none;">
														<h5>&nbsp;</h5>
													</td>
													<td style="border:none;">
														<h5><strong><?=$kl10?>:&nbsp;</strong><?=stripslashes($firma['email'])?></h5>
													</td>
												</tr>	
												<?php endif; ?>
												<?php if($firma['show_website']=="yes"): ?>
												<tr>
													<td style="border:none;">
														<h5>&nbsp;</h5>
													</td>
													<td style="border:none;">
														<h5><strong><?=$kl55?>:&nbsp;</strong><?=stripslashes($firma['website'])?></h5>
													</td>
												</tr>	
												<?php endif; ?>

												<tr>
													<br/>
													<td>
													    <h2 class="inv"><?=$k158?></h3>
													</td>
													<td>
													    <table id="top" class="table table-bordered">
															<tbody>
																<tr>
																	<td style="border-bottom:none;width:25%;"><strong><?=$k081?>:</strong></td>
																	<td style="border-bottom:none;width:25%;"><strong><?=$k149?>:</strong></td>
																	<td style="border-bottom:none;width:49%;"><strong><?=$k163?>:</strong></td>
																</tr>
																<tr>
																	<td style="border-top:none;">
																		<?php
																		echo get_counter("invoice")['antes'].str_pad($invoice_options['invoice_nr'],get_counter("invoice")['depois'],"0",STR_PAD_LEFT);
																		?>
																	</td>
																	<td style="border-top:none;"><?=$today?></td>
																	<td style="border-top:none;"><?php echo $invoice_options['due_date'];?></td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td style="border:none;" colspan="2">
														
										<table id="services" class="table table-striped"><thead><tr><th><?php echo $wa38;?></th><th><?php echo $k135;?></th><th style="text-align:right;"><?php echo $wa39;?></th><th style="text-align:right;"><?php echo $wa37;?></th><th style="text-align:right;"><?php echo $k164;?></th><th style="text-align:right;"><?php echo $k166;?></th></tr></thead>
										    <tbody>
											<?php
											$services = explode(",",$order['services']);
											$e = 1;
											$all_prices_no_vat = array();
											$all_prices_with_vat = array();
											$sum_prices = 0;
											$vat_value = ($firma['vat_value']/100)+1;
											foreach($services as $service) {
											    $ex = explode("-",$service);
											    $service_settings = get_service_settings($ex[0]);
											    echo "
											    <tr>
											        <td style=\"border-left:1px solid #222222;border-bottom:1px solid #222222;\">".$e."</td>
											        <td style=\"border-left:1px solid #222222;border-bottom:1px solid #222222;\">".$service_settings['name']."</td>
											        <td class=\"tar\" style=\"border-left:1px solid #222222;border-bottom:1px solid #222222;\">";
											        if ($ex[1] == "kg") { echo $wa07; }
											        if ($ex[1] == "un") { echo $wa27; }
											    echo "
											        </td>
											        <td class=\"tar\" style=\"border-left:1px solid #222222;border-bottom:1px solid #222222;\">".$ex[2]."</td>
											        <td class=\"tar\" style=\"border-left:1px solid #222222;border-bottom:1px solid #222222;\">".number_format(($service_settings['price']/$vat_value),3,'.','')."&nbsp;".$k165.".</td>";
											        $price_minus_vat = number_format((($ex[2]*$service_settings['price'])/$vat_value),2,'.','');
											        $price_total = number_format(($ex[2]*$service_settings['price']),3,'.','');
											        $all_prices_no_vat[] = $price_minus_vat;
											        $all_prices_with_vat[] = $price_total;
											    echo "
											        <td class=\"tar\" style=\"border-left:1px solid #222222;border-bottom:1px solid #222222;border-right:1px solid #222222;\">".$price_minus_vat."&nbsp;".$k165.".</td>";
											    echo "
											    </tr>
											    ";
											    $e++;
											}
											$total_without_vat = number_format(array_sum($all_prices_no_vat),2,'.','');
											$total_with_vat = number_format(array_sum($all_prices_with_vat),2,'.','');
											?>
												<tr class="head_help">
													<td colspan="4" style="border-bottom:none;"></td>
													<td style="text-align:right;"><strong><?php echo $k167; ?>:</strong></td>
													<td style="text-align:right;"><strong><?php echo $total_without_vat."&nbsp;".$k165;?>.</strong></td>
												</tr>
												<tr class="head_help">
													<td colspan="4" style="border-top:none;"></td>
													<td style="text-align:right;"><strong><?php echo $firma['vat_value']."%&nbsp;".$k168;?>:</strong></td>
													<td style="text-align:right;"><strong><?php echo ($total_with_vat-$total_without_vat)."&nbsp;".$k165;?>.</strong></td>
												</tr>
												<tr class="head_help">
													<td colspan="4" style="border-top:none;"></td>
													<td style="text-align:right;"><strong><?php echo $k169;?></strong></td>
													<td style="text-align:right;"><strong><?php echo $total_with_vat."&nbsp;".$k165; ?></strong></td>
												</tr>
											</tbody>
										</table>
													</td>
												</tr>

                                                <tr>
													<td>
											<?php if($firma['show_bank']=="yes"): ?>
												<p><strong><?=$s007?>:</strong>&nbsp;<?=stripslashes($firma['bank'])?></p>
												<p><strong><?=$s008?>:</strong>&nbsp;<?=$firma['iban']?></p>
												<p><strong><?=$s010?>:</strong>&nbsp;<?=$firma['bic']?></p>
												<p><strong><?=$s012?>:</strong>&nbsp;<?=stripslashes($firma['titular'])?></p>
											<?php endif; ?>
													</td>
													<td>
												<p><strong><?=$k178?>:</strong>&nbsp;<?=$firma['city']?></p>
												<p><strong><?=$k174?>:</strong>&nbsp;<?php echo ${'p00'.$invoice_options['payment_method']};?></p>
												<p><strong><?=$k177?>:</strong>&nbsp;<?php echo $today;?></p>
												<p><strong><?=$k175?>:</strong>&nbsp;<?=$k176?></p>
													</td>
												<tr>
											    <tr>
											        <td style="border:none;"><h4><?=$k170?>:</h4></td>
											        <td style="border:none;"><h4><?=$k145?>:</h4></td>
											    </tr>
											<tbody>
										</table>
                                      </div>
									</div>
									<!--
									<button type="button" id="btn" class="btn btn-default" onclick="window.history.go(-1);"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;<?php echo $k233; ?></button>
									-->
									<button type="button" id="btn" class="btn btn-primary fr" onclick="printDiv('<?=$k179?>');"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;<?php echo $k153."&nbsp;".$k179; ?></button>
									<button type="button" id="btn" class="btn btn-primary fr" onclick="printDiv('<?=$k162?>');"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;<?php echo $k153."&nbsp;".$k162; ?></button>
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
		<!-- validation -->
		<link rel="stylesheet" type="text/css" href="assets/plugins/validationEngine/jquery.validationEngine.css" />
		<script type="text/javascript" src="assets/plugins/validationEngine/jquery.validationEngine.js"></script>
		<script type="text/javascript" src="assets/plugins/validationEngine/jquery.validationEngine-<?=$lang?>.js"></script>
        <!-- print -->
        <script type="text/javascript">
        function printDiv(ori) {
            var divToPrint=document.getElementById('printx');
            var newWin=window.open('','<?php echo $order['date']."-".$k132."-".$order_id;?>');
            newWin.document.open();
            newWin.document.write('<!DOCTYPE html><html><head><title><?php echo $order['date']."-".$k132."-".$order_id;?></title>');
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/base.css" type="text/css" />');
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/component_ui.css" type="text/css" />'); 
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/extend.css" type="text/css" />');
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/invoice.css" type="text/css" />');
            newWin.document.write('<script type="text/javascript" src="assets/plugins/jQuery/jquery-1.12.4.min.js"><\/script>');
            newWin.document.write('</head><body>');
            newWin.document.write(divToPrint.innerHTML);
            newWin.document.write(''+
                '<script type="text\/javascript">'+
                '$(function () {'+
                    '$("h1.original").text("'+ori+'");'+
                '});'+
                '<\/script>'+
            '');
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
