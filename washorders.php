<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
$limit = 10;  
if (isset($_GET["page"])) { $page = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit; 
$orders = array();;
$sql="SELECT * FROM `orders` ORDER BY `id` DESC LIMIT ".$start_from.", ".$limit;
$result=$local->query($sql);
if($result === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
} else {
    if($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
			$orders[] = $row;
		}
    }
}
//pagination
$sqlp = "SELECT COUNT(id) AS COUNT FROM `orders`";
$resultp=$local->query($sqlp);
$rowp = mysqli_fetch_assoc($resultp);
$total_records = $rowp['COUNT'];
$total_pages = ceil($total_records/$limit); 
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
                        <li class="active">
                            <a href="javascript:void(0)" class="material-ripple"><i class="material-icons">local_laundry_service</i><?=$k050?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li class="active"><a href="washorders.php"><?=$k129?></a></li>
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
                            <h1><?=$k129?></h1>
                            <small><?=$k050?></small>
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="pe-7s-home"></i>&nbsp;<?=$k012?></a></li>
                                <li><?=$k050?></li>
                                <li class="active"><?=$k129?></li>
                            </ol>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4><i class="fa fa-align-justify" aria-hidden="true"></i>&nbsp;<?=$k129?></h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <?php if(!empty($orders)): ?>
                                            <?php
                                            foreach($orders as $order) {
												$client = get_client($order['client_id']);
												echo "
									<div class=\"table-responsive\">
                                        <table id=\"orders\" class=\"table table-bordered table-striped table-hover\">
											<caption><h3 class=\"colored m-t-10 m-b-10\">".$k150."&nbsp;#".$order['order_id']."<span class=\"fr\">".$order['date']."</span></h3></caption>
                                            <thead>
                                                <tr>
											        <th>$k027</th>
											        <th>$k057</th>
											        <th>$k151</th>
											        <th>$kl28</th>
											        <th>$k134</th>
                                                    <th>$k146</th>";
                                                    if($client['type']=="company") {
														echo "<th>".$kl16."</th>";
													}
													if($client['type']=="person") {
														echo "<th>".$kl21."</th>";
													}
                                                echo "
                                                    <th>$k235</th>
                                                    <th>$u014</th>
                                                    <th>$k047</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>".$order['order_id']."</td>
                                                    <td>".$order['date']."</td>
                                                    <td>".$order['added_by']."</td>
                                                    <td>";
                                                if ($client['type'] == "company") {
													echo "<span class=\"label label-success themed-tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$kl20."\"><i class=\"fa fa-industry\" aria-hidden=\"true\"></i></span>";
												}
                                                if ($client['type'] == "person") {
													echo "<span class=\"label label-primary themed-tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$kl19."\"><i class=\"fa fa-user\" aria-hidden=\"true\"></i></span>";
												}
                                                echo "
                                                    </td>
                                                    <td>".$order['client_id']."</td>";
                                                    if($client['type']=="company") {
														echo "
													<td>".$client['company_name']."</td>
													<td>".$client['eik']."</td>
													         ";
													}
													if($client['type']=="person") {
														echo "
													<td>".$client['name']."</td>
													<td>".$client['egn']."</td>
													         ";
													}
                                                echo "
                                                    <td>".$order['order_end_date']."</td>
                                                    <td>".$order['status']."</td>
                                                    <td style=\"width:130px;\">
                                                    <button type=\"button\" class=\"btn btn-sm btn-success themed-tooltip\" onClick=\"order_go('".$order['order_id']."','".$order['client_id']."'); return false;\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k157."\"><i class=\"fa fa-eye\"></i></button>
                                                    
                                                    <button type=\"button\" class=\"btn btn-sm btn-pink themed-tooltip\" onClick=\"order_edit('".$order['order_id']."','".$order['client_id']."'); return false;\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k213."\"><i class=\"fa fa-cog\"></i></button>
                                                    
                                                    <button type=\"button\" class=\"btn btn-sm btn-primary themed-tooltip\" onClick=\"order_invoice('".$order['order_id']."','".$order['client_id']."'); return false;\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k062."\"><i class=\"fa fa-file-text\"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td style=\"border:none;\">&nbsp;</td>
                                                    <td style=\"border:none;\">&nbsp;</td>
                                                    <td colspan=\"6\">";
                                                echo "
										<table id=\"services\" class=\"table table-bordered table-striped\"><thead><tr><th>".$wa38."</th><th>".$k135."</th><th>".$wa39."</th><th>".$wa37."</th></tr></thead>
										    <tbody>";
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
											echo "
											</tbody>
										</table>";
										if(!empty($order['obs'])){
											echo "
										<p class=\"text-info\">".$k236.":</p>
										<p style=\"width:99%;\">".$order['obs']."</p>
									        ";
									    }
										echo "
                                                    </td>
                                                    <td style=\"border:none;\">&nbsp;</td>
                                                    <td style=\"border:none;\">&nbsp;</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                               ";
                                           }
//pagination
$pageLink = "<ul class=\"pagination fr\">";
if ($page >= 2) {
	$pageLink .= "<li><a href=\"washorders.php?page=1\">".$k182."</a></li>";
    $pageLink .= "<li><a href=\"washorders.php?page=".($page-1)."\"><i class=\"icon-left-open-mini\"></i></a></li>";
}
if ($total_pages > 1) {
    for ($i=1; $i<=$total_pages; $i++) {
	    if ($i == $page) {
            $pageLink .= "<li class=\"active disabled\"><a href=\"javascript:void(0)\">".$i."</a></li>";
        } else {
		    $pageLink .= "<li><a href=\"washorders.php?page=".$i."\">".$i."</a></li>";
	    }
    };
}
if ($page < $total_pages) {
	$pageLink .= "<li><a href=\"washorders.php?page=".($page+1)."\"><i class=\"icon-right-open-mini\"></i></a></li>";
	$pageLink .= "<li><a href=\"washorders.php?page=".$total_pages."\">".$k183."</a></li>";
}
echo $pageLink."</ul>";  
                                           ?>
                                           
                                    <?php else: ?>
                                    <div class="alert alert-info m-t-20" role="alert">
										<strong><?=$k044?></strong>
									</div>
                                    <?php endif; ?>
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
        <!-- datatables -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/datatables/css/jquery.dataTables.css" />
        <link type="text/css" rel="stylesheet" href="assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" />
        <script type="text/javascript" src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="assets/plugins/datatables/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="assets/plugins/datatables/js/jszip.min.js"></script>
        <script type="text/javascript" src="assets/plugins/datatables/js/pdfmake.min.js"></script>
        <script type="text/javascript" src="assets/plugins/datatables/js/vfs_fonts.js"></script>
        <script type="text/javascript" src="assets/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="assets/plugins/datatables/extensions/Buttons/js/buttons.print.min.js"></script>
        <script type="text/javascript">
        function order_go(order_id,client_id) {
			var view_order = "washorders_view_order.php?order_id="+order_id+"&client_id="+client_id;
			window.location.assign(view_order);
		}
        function order_edit(order_id,client_id) {
			var view_order = "washorders_edit_order.php?order_id="+order_id+"&client_id="+client_id;
			window.location.assign(view_order);
		}
        function order_invoice(order_id,client_id) {
			var invoice_order = "washorders_invoice_order_options.php?order_id="+order_id+"&client_id="+client_id;
			window.location.assign(invoice_order);
		}
        </script>
		<!-- validation -->
		<link rel="stylesheet" type="text/css" href="assets/plugins/validationEngine/jquery.validationEngine.css" />
		<script type="text/javascript" src="assets/plugins/validationEngine/jquery.validationEngine.js"></script>
		<script type="text/javascript" src="assets/plugins/validationEngine/jquery.validationEngine-<?=$lang?>.js"></script>
        <!-- START THEME LABEL SCRIPT -->
        <script type="text/javascript" src="assets/dist/js/app.js"></script>
    </body>
</html>
