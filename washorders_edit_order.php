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
	//client data
	$client = get_client($client_id);
}
//order data
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
//company data
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
                                        <h4><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;<?=$k213?></h4>
                                    </div>
                                </div>
                                <div class="panel-body white-text">
                                        <?php
                                            $sql="SELECT * FROM `check_list` WHERE `order_id`='".$order_id."' AND `client_id`='".$client_id."'";
                                            $result=$local->query($sql);
                                            $show_print_button = false;
                                            if($result === false) {
                                                trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
                                            } else {
                                                if($result->num_rows > 0) {
													$show_print_button = true;
													echo "
													<div class=\"table-responsive\" id=\"printx\">
													    <h4 class=\"uppercase display-none\"><span class=\"fl\">".$kl34.": <span class=\"dotted-underline\">&nbsp;&nbsp;".$today."&nbsp;&nbsp;</span></span><span class=\"fr\">".$k222.": <span class=\"dotted-underline\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></h4>
													    <h4 class=\"uppercase display-none\">&nbsp;</h4>
													    <table id=\"services\" class=\"table table-bordered table-striped\">
													        <!--<caption class=\"table-caption\"></caption>-->
													        <thead>
													            <tr>
													                <th>".$k081."</th>
													                <th>".$k216."</th>
													                <th>".$k218."&nbsp;(".$k229.")</th>
													                <th>".$k219."&nbsp;(".$k229.")</th>
													                <th>".$k228.":</th>
													                <th>".$k047."</th>
													            </tr>
													        </thead>
													        <tbody>
													";
													$c=1;
                                                    while($row = mysqli_fetch_assoc($result)) {
			                                            echo "
			                                                    <tr>
			                                                        <td>".$c."</td>
			                                                        <td>".$row['item']."</td>
			                                                        <td>".$row['art_in']."</td>
			                                                        <td>".$row['art_out']."</td>
			                                                        <td>&nbsp;</td>
			                                                        <td>
			                                                        <button type=\"button\" class=\"btn btn-sm btn-danger themed-tooltip\" onClick=\"del_confirm('".$order_id."','".$client_id."','".$row['id']."'); return false;\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k226."\"><i class=\"fa fa-trash\"></i></button>
			                                                        </td>
			                                                    </tr>
			                                            ";
			                                            $c++;
		                                            }
		                                            echo "
		                                                    </tbody>
		                                                </table>
		                                                <div class=\"clearfix space20\"></div>
		                                                <h4 class=\"display-none\"><span class=\"fl\" style=\"width:50%;\">".$k230.":&nbsp;<span class=\"dotted-underline\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span class=\"fl\">".$k231.":<span class=\"dotted-underline\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></h4>
		                                                <div class=\"clearfix space20\"></div>
		                                                <h4 class=\"display-none\"><span class=\"fl\" style=\"width:50%;\">".$k223.":</span><span class=\"fl\">".$k223.":</span></h4>
		                                                <div class=\"clearfix space20\"></div>
		                                            </div>
		                                            <div class=\"clearfix space20\"></div>
		                                            ";
                                                } else {
													$show_print_button = false;
												    echo "
                                    <div class=\"alert alert-info m-t-20\" role=\"alert\">
										<strong>".$k044."</strong>
									</div>
												    ";
												}
                                            }
                                        ?>
												<button type="button" id="btn" class="btn btn-default fl" onclick="window.history.go(-1);">
													<i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;<?php echo $k233; ?></button>
													
	        <a class="btn btn-primary fr" id="add_check" href="washorders_check_list_add.php?order_id=<?=$order_id?>&client_id=<?=$client_id?>" data-remote="true" data-toggle="modal" data-target="#modal-lg" data-backdrop="static" data-tag="<?=$k214?>" data-class="modal-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<?=$k214?></a>
	        
	        <?php if ($show_print_button == true) { echo "<button type=\"button\" id=\"btn\" class=\"btn btn-success fr\" onclick=\"printDiv();\"><i class=\"fa fa-print\" aria-hidden=\"true\"></i>&nbsp;".$k153."&nbsp;".$k213."</button>"; } ?>
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
        <script type="text/javascript">
        function del_confirm(order_id,client_id,check_id) {
	        var answer = confirm("<?php echo $k030; ?>");
	        if (answer){ check_list_del(order_id,client_id,check_id); }
	        else{ alert("<?php echo $k224; ?>"); }
        }
        function check_list_del(order_id,client_id,check_id) {
            $.ajax({
                type: "POST",
                data: { "order_id" : order_id, "client_id" : client_id, "check_id" : check_id },
                url: "ajax/washorders_check_list_del.php",
                success: function(){
		            setTimeout(function(){
					    window.location.reload(true);
				    },200);
                }
            });
            return false;
        }
        </script>
        <script type="text/javascript">
        function printDiv(ori) {
			var document_title = "<?php echo $k213.' „'.$firma['name'].'” '; ?>";
            var divToPrint=document.getElementById('printx');
            var newWin=window.open('','<?php echo $order['date']."-".$k132."-".$order_id;?>');
            newWin.document.open();
            newWin.document.write('<!DOCTYPE html><html><head><title><?php echo $order['date']."-".$k132."-".$order_id;?></title>');
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/base.css" type="text/css" />');
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/component_ui.css" type="text/css" />'); 
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/extend.css" type="text/css" />');
            newWin.document.write('<link rel="stylesheet" href="assets/dist/css/checklist.css" type="text/css" />');
            newWin.document.write('<script type="text/javascript" src="assets/plugins/jQuery/jquery-1.12.4.min.js"><\/script>');
            newWin.document.write('</head><body>');
            newWin.document.write(''+
                '<style>.display-none{display:block;}</style>'+
                '<h1 style="text-transform:uppercase;text-align:center;">'+document_title+'</h1><br/><br/><br/>'+
            '');
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
    </body>
</html>
