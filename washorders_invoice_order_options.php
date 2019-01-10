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
//get actual invoice number
$a_invoice_nr = get_counter("invoice")['value'];
//check if invoice exists already
$invoice_options = array();
$invoice_exists = false;
$sql="SELECT * FROM `invoices` WHERE `order_id`='".$order_id."' AND `client_id`='".$client_id."'";
$result=$local->query($sql);
if($result === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
} else {
    if($result->num_rows==1) {
		$invoice_exists = true;
        $invoice_options = mysqli_fetch_assoc($result);
    } else {
		$invoice_exists = false;
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
                                <div class="panel-body white-text">
									<?php if($client['type']=="person"): ?>
									<p><strong><?=$k146?>:&nbsp;</strong><?=$client['name']?></p>
									<?php endif; ?>
									<?php if($client['type']=="company"): ?>
									<p><strong><?=$k146?>:&nbsp;</strong><?=$client['company_name']?></p>
									<?php endif; ?>
									<p><strong><?=$k080?>:&nbsp;</strong><?=$client['grad_celo']?></p>
									<p><strong><?=$kl07?>:&nbsp;</strong><?=stripslashes($client['address'])?><p>
									<?php if($client['type']=="person"): ?>
									<p><strong><?=$kl21?>:&nbsp;</strong><?=$client['egn']?></p>
									<?php endif; ?>
									<?php if($client['type']=="company"): ?>
									<p><strong><?=$kl16?>:&nbsp;</strong><?=$client['eik']?></p>
									<p><strong><?=$kl17?>:&nbsp;</strong><?=$client['ddc']?></p>
									<p><strong><?=$kl22?>:&nbsp;</strong><?=$client['mol']?></p>
									<?php endif; ?>
									<p><strong><?=$kl09?>:&nbsp;</strong><?=stripslashes($client['phone'])?></p>
									<p><?=$k149?>:&nbsp;<?=$order['date']?></p>
				                    <!-- services list -->
                                    <div class="table-responsive">
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
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row end -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;<?=$k205?></h4>
                                    </div>
                                </div>
                                <div class="panel-body white-text">
									
                                    <form id="forms" class="form-horizontal" method="post">
                                        <!--
	                                    <div class="form-group">
		                                    <label class="col-sm-6 control-label"><?=$k211?>:</label> 
		                                    <div class="col-sm-6"> 
		                                        <select class="form-control validate[required]" id="order_status" name="order_status">
				                                    <option value="<?php echo $order['status']; ?>"><?php echo ${'o00'.$order['status']}; ?></option>
				                                    <option></option>
				                                    <option value="1"><?php echo $o001; ?></option>
				                                    <option value="2"><?php echo $o002; ?></option>
				                                    <option value="3"><?php echo $o003; ?></option>
				                                    <option value="4"><?php echo $o004; ?></option>
			                                    </select>
		                                    </div>
	                                    </div>
	                                    -->
	                                    <?php if ($invoice_exists==true): ?>
	                                    <div class="form-group">
		                                    <label class="col-sm-6 control-label"><?=$k159?>:</label> 
		                                    <div class="col-sm-6"> 
                                                <input type='text' class="form-control validate[required]" id="invoice_number" name="invoice_nr" value="<?php echo $invoice_options['invoice_nr'];?>" />
		                                    </div>
	                                    </div>
	                                    
	                                    <div class="form-group">
		                                    <label class="col-sm-6 control-label"><?=$k174?>:</label> 
		                                    <div class="col-sm-6">
		                                        <select class="form-control validate[required]" id="payment" name="payment_method">
													<option value="<?php echo $invoice_options['payment_method'];?>"><?php echo ${'p00'.$invoice_options['payment_method']};?></option>
				                                    <option></option>
				                                    <option value="1"><?php echo $p001; ?></option>
				                                    <option value="2"><?php echo $p002; ?></option>
			                                    </select>
		                                    </div>
	                                    </div>
	                                    
	                                    <div class="form-group">
		                                    <label class="col-sm-6 control-label"><?=$k232?>:</label> 
		                                    <div class="col-sm-6"> 
                                                <input type='text' class="form-control validate[required,custom[date],future[<?php echo $today;?>]]" id="datetimepicker-1" name="due_date" value="<?php echo $invoice_options['due_date'];?>" />
		                                    </div>
	                                    </div>
	                                    
	                                    <?php else: ?>
	                                   
	                                    <div class="form-group">
		                                    <label class="col-sm-6 control-label"><?=$k159?>:</label> 
		                                    <div class="col-sm-6"> 
                                                <input type='text' class="form-control validate[required]" id="invoice_number" name="invoice_nr" value="<?php echo $a_invoice_nr; ?>" />
		                                    </div>
	                                    </div>
	                                    
	                                    <div class="form-group">
		                                    <label class="col-sm-6 control-label"><?=$k174?>:</label> 
		                                    <div class="col-sm-6">
		                                        <select class="form-control validate[required]" id="payment" name="payment_method">
				                                    <option></option>
				                                    <option value="1"><?php echo $p001; ?></option>
				                                    <option value="2"><?php echo $p002; ?></option>
			                                    </select>
		                                    </div>
	                                    </div>
	                                    
	                                    <div class="form-group">
		                                    <label class="col-sm-6 control-label"><?=$k232?>:</label> 
		                                    <div class="col-sm-6"> 
                                                <input type='text' class="form-control validate[required]" id="datetimepicker-1" name="due_date" value="<?php echo $tomorrow; ?>" />
		                                    </div>
	                                    </div>
	                                    
	                                    <?php endif; ?>
	                                    <div class="line-modal"></div>
	                                    
	                                    <div class="form-group">
	                                        <div class="col-sm-12">
												<button type="button" id="btn" class="btn btn-default" onclick="window.history.go(-1);">
													<i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;<?php echo $k234; ?></button>
			                                    <button type="submit" class="btn btn-primary fr" name="submit" id="submit">
													<i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;<?=$k237?></button>
		                                    </div>
	                                    </div>
	                                    
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row end -->
                
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
        <script type="text/javascript" src="assets/plugins/moment/moment.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" />
        <script type="text/javascript" src="assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript">
        $(function () {
            $("#datetimepicker-1").datetimepicker({
                format: 'YYYY-MM-DD'
            });
        });
        </script>
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
		<?php if ($invoice_exists==true): ?>
        <script type="text/javascript">
        $(function () {
            if(jQuery().validationEngine) {
                $("#forms").validationEngine({promptPosition : "bottomLeft:10", showArrowOnRadioAndCheckbox: true});;
            }
            jQuery("#forms").on('click', '#submit', function(e) {
                var valid = jQuery("#forms").validationEngine('validate');
                if (valid == true) {
		            e.preventDefault();
		            var invoice_id = "<?php echo $invoice_options['id']; ?>";
		            var order_id = "<?php echo $order_id; ?>";
		            var client_id = "<?php echo $client_id; ?>";
		            var card = "<?php echo $client['card']; ?>";
		            var invoice_nr = jQuery("input[name='invoice_nr']").val();
		            var payment_method = jQuery("select[name='payment_method']").val();
		            var due_date = jQuery("input[name='due_date']").val();
		            $("button#submit").attr("disabled",true);
		            var datastr = 'invoice_id='+invoice_id+'&order_id='+order_id+'&client_id='+client_id+'&card='+card+'&invoice_nr='+invoice_nr+'&payment_method='+payment_method+'&due_date='+due_date;
		            //console.log(datastr);
		            send(datastr);
	            }
	        });
        });
        function send(datastr) {
			console.log(datastr);
            jQuery.ajax({
                type: "POST",
                url: "ajax/washorders_invoice_order_options_update.php",
                data: datastr,
                success: function(data){
				    console.log(data);
				    if(data.name == "data") {
		                var order_id = "<?php echo $order_id; ?>";
		                var client_id = "<?php echo $client_id; ?>";
			            var invoice_path = "washorders_invoice_order.php?order_id="+order_id+"&client_id="+client_id;
			            window.location.assign(invoice_path);
				    }
                },
                error: function(jqXhr,textStatus,errorThrown){
                    console.log(errorThrown);
                },
            });
            return false;
        }
        </script>
		<?php else: ?>
        <script type="text/javascript">
        $(function () {
            if(jQuery().validationEngine) {
                $("#forms").validationEngine({promptPosition : "bottomLeft:10", showArrowOnRadioAndCheckbox: true});;
            }
            jQuery("#forms").on('click', '#submit', function(e) {
                var valid = jQuery("#forms").validationEngine('validate');
                if (valid == true) {
		            e.preventDefault();
		            var order_id = "<?php echo $order_id; ?>";
		            var client_id = "<?php echo $client_id; ?>";
		            var card = "<?php echo $client['card']; ?>";
		            var invoice_nr = jQuery("input[name='invoice_nr']").val();
		            var payment_method = jQuery("select[name='payment_method']").val();
		            var due_date = jQuery("input[name='due_date']").val();
		            $("button#submit").attr("disabled",true);
		            var datastr = 'order_id='+order_id+'&client_id='+client_id+'&card='+card+'&invoice_nr='+invoice_nr+'&payment_method='+payment_method+'&due_date='+due_date;
		            //console.log(datastr);
		            send(datastr);
	            }
	        });
        });
        function send(datastr) {
			console.log(datastr);
            jQuery.ajax({
                type: "POST",
                url: "ajax/washorders_invoice_order_options.php",
                data: datastr,
                success: function(data){
				    console.log(data);
				    if(data.name == "data") {
		                var order_id = "<?php echo $order_id; ?>";
		                var client_id = "<?php echo $client_id; ?>";
			            var invoice_path = "washorders_invoice_order.php?order_id="+order_id+"&client_id="+client_id;
			            window.location.assign(invoice_path);
				    }
                },
                error: function(jqXhr,textStatus,errorThrown){
                    console.log(errorThrown);
                },
            });
            return false;
        }
        </script>
        <?php endif; ?>
        <!-- START THEME LABEL SCRIPT -->
        <script type="text/javascript" src="assets/dist/js/app.js"></script>
    </body>
</html>
