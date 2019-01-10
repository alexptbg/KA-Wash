<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
$limit = 50;
if (isset($_GET["page"])) { $page = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit; 
$w_ago = date("Y-m-d 00:00:00",strtotime('-1 week'));
$d_ago = date("Y-m-d 00:00:00",strtotime('-4 day'));
$logs = array();
$sql="SELECT * FROM `washstatus` WHERE `datetime` > '".$d_ago."' ORDER BY `id` DESC LIMIT ".$start_from.", ".$limit;
$result=$local->query($sql);
if($result === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
} else {
    if($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
			$logs[] = $row;
		}
    }
}
//pagination
$sqlp = "SELECT COUNT(id) AS COUNT FROM `washstatus` WHERE `datetime` > '".$d_ago."' ORDER BY `id` DESC";
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
                        <li class="active">
                            <a href="javascript:void(0)" class="material-ripple"><i class="material-icons">reorder</i><?=$k040?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li><a href="user_logs.php"><?=$k185?></a></li>
                                <li class="active"><a href="wash_status.php"><?=$k186?></a></li>
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
                            <i class="pe-7s-note2"></i>
                        </div>
                        <div class="header-title">
                            <h1><?=$k040?></h1>
                            <small><?=$k017?></small>
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="pe-7s-home"></i>&nbsp;<?=$k012?></a></li>
                                <li class="active"><?=$k040?></li>
                            </ol>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4><i class="fa fa-align-justify" aria-hidden="true"></i>&nbsp;<?=$k191?></h4>
                                        <div class="buttons fr">
                                            <?php if (($user_settings['level'] >= 50) && (!empty($logs))): ?>
                                        	<a type="button" class="btn btn-danger btn-xs btn-panel" id="del" href="wash_status_del.php?i=ok" data-remote="true" data-toggle="modal" data-target="#modal-n" data-backdrop="static" data-tag="<?=$lo08?>" data-class="modal-danger"><i class="fa fa-times themed-tooltip" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$lo14?>"></i></a>
                                        	<?php else: ?>
                                        	<button type="button" class="btn btn-danger btn-xs btn-panel themed-tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$lo14?>" disabled="disabled"><i class="fa fa-times themed-tooltip" aria-hidden="true"></i></button>
                                        	<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <?php if(!empty($logs)): ?>
                                    <div class="table-responsive">
                                        <table id="logs" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
											        <th><?=$lo02?></th>
											        <th><?=$lo03?></th>
											        <th><?=$k187?></th>
											        <th><?=$k188?></th>
                                                    <th><?=$s019?></th>
                                                    <th><?=$k112?></th>
                                                    <!--<th><?=$kl01?></th>-->
                                                    <th><?=$k189?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach($logs as $log) {
                                              	$today = date('Ymd');
												echo "
											    <tr>
												    <td>".$log['id']."</td>";
												    if (date('Ymd',strtotime($log['datetime'])) == $today) {
													    echo "<td><span class=\"text-success\">".$log['datetime']."</span></td>";
												    } else {
													    echo "<td>".$log['datetime']."</td>";
												    }

												    echo "
												    <td>".$log['washmachine']."</td>
												    <td>".$log['washprogram']."</td>
												    <td>".$log['washstep']."</td>";
												    if ($log['washprep1'] < 1) { $label_1 = "label-p0"; } else { $label_1 = "label-p1"; }
												    if ($log['washprep2'] < 1) { $label_2 = "label-p0"; } else { $label_2 = "label-p2"; }
												    if ($log['washprep3'] < 1) { $label_3 = "label-p0"; } else { $label_3 = "label-p3"; }
												    if ($log['washprep4'] < 1) { $label_4 = "label-p0"; } else { $label_4 = "label-p4"; }
												    if ($log['washprep5'] < 1) { $label_5 = "label-p0"; } else { $label_5 = "label-p5"; }
												    if ($log['washprep6'] < 1) { $label_6 = "label-p0"; } else { $label_6 = "label-p6"; }
												    if ($log['washprep7'] < 1) { $label_7 = "label-p0"; } else { $label_7 = "label-p7"; }
												    if ($log['washprep8'] < 1) { $label_8 = "label-p0"; } else { $label_8 = "label-p8"; }
												    echo "
												    <td>".
												      "<span class=\"label ".$label_1." themed-tooltip\" aria-hidden=\"true\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k113."&nbsp;1\">".$log['washprep1']."</span>&nbsp;".
												      "<span class=\"label ".$label_2." themed-tooltip\" aria-hidden=\"true\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k113."&nbsp;2\">".$log['washprep2']."</span>&nbsp;".
												      "<span class=\"label ".$label_3." themed-tooltip\" aria-hidden=\"true\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k113."&nbsp;3\">".$log['washprep3']."</span>&nbsp;".
												      "<span class=\"label ".$label_4." themed-tooltip\" aria-hidden=\"true\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k113."&nbsp;4\">".$log['washprep4']."</span>&nbsp;".
												      "<span class=\"label ".$label_5." themed-tooltip\" aria-hidden=\"true\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k113."&nbsp;5\">".$log['washprep5']."</span>&nbsp;".
												      "<span class=\"label ".$label_6." themed-tooltip\" aria-hidden=\"true\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k113."&nbsp;6\">".$log['washprep6']."</span>&nbsp;".
												      "<span class=\"label ".$label_7." themed-tooltip\" aria-hidden=\"true\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k113."&nbsp;7\">".$log['washprep7']."</span>&nbsp;".
												      "<span class=\"label ".$label_8." themed-tooltip\" aria-hidden=\"true\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k113."&nbsp;8\">".$log['washprep8']."</span>&nbsp;".
												    "</td>
												    <!--<td>".$log['washclients']."</td>-->";
												    $rfids = str_replace("rfid:","",$log['washrfids']);
												    $clients = explode(":",$rfids);
												    $c = 0;
												    echo "<td>";
												    foreach($clients as $client) {
														$client_name = get_card_client_name($client);
														$c++;
														echo "<span class=\"label label-p".$c." themed-tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$client_name."\">".$client."</span>&nbsp;";
													}
												    echo "
												    </td>
												</tr>";	
											}
                                            ?>
                                            </tbody>
									        <tfoot>
										        <tr>
											        <td><?=$lo02?></td>
											        <td><?=$lo03?></td>
											        <td><?=$k187?></td>
											        <td><?=$k188?></td>
                                                    <td><?=$s019?></td>
                                                    <td><?=$k112?></td>
                                                    <!--<td><?=$kl01?></td>-->
                                                    <td><?=$k189?></td>
										        </tr>
									        </tfoot>
                                        </table>
                                    </div>
<?php
//pagination
$pageLink = "<ul class=\"pagination fr\">";
if ($page >= 2) {
	$pageLink .= "<li><a href=\"wash_status.php?page=1\">".$k182."</a></li>";
    $pageLink .= "<li><a href=\"wash_status.php?page=".($page-1)."\"><i class=\"icon-left-open-mini\"></i></a></li>";
}
if ($total_pages > 1) {
    for ($i=1; $i<=$total_pages; $i++) {
	    if ($i == $page) {
            $pageLink .= "<li class=\"active disabled\"><a href=\"javascript:void(0)\">".$i."</a></li>";
        } else {
		    $pageLink .= "<li><a href=\"wash_status.php?page=".$i."\">".$i."</a></li>";
	    }
    };
}
if ($page < $total_pages) {
	$pageLink .= "<li><a href=\"wash_status.php.php?page=".($page+1)."\"><i class=\"icon-right-open-mini\"></i></a></li>";
	$pageLink .= "<li><a href=\"wash_status.php.php?page=".$total_pages."\">".$k183."</a></li>";
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
		<!-- validation -->
		<link rel="stylesheet" type="text/css" href="assets/plugins/validationEngine/jquery.validationEngine.css" />
		<script type="text/javascript" src="assets/plugins/validationEngine/jquery.validationEngine.js"></script>
		<script type="text/javascript" src="assets/plugins/validationEngine/jquery.validationEngine-<?=$lang?>.js"></script>
        <!-- START THEME LABEL SCRIPT -->
        <script type="text/javascript" src="assets/dist/js/app.js"></script>
    </body>
</html>
