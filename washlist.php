<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
$washlist = array();
$sql="SELECT * FROM `washlist` ORDER BY `id` ASC";
$result=$local->query($sql);
if($result === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
} else {
    if($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
			$washlist[] = $row;
		}
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
                        <li class="active">
                            <a href="javascript:void(0)" class="material-ripple"><i class="material-icons">local_laundry_service</i><?=$k050?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li><a href="washorders.php"><?=$k129?></a></li>
                                <li class="active"><a href="washlist.php"><?=$k051?></a></li>
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
                            <h1><?=$k051?></h1>
                            <small><?=$k050?></small>
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="pe-7s-home"></i>&nbsp;<?=$k012?></a></li>
                                <li><?=$k050?></li>
                                <li class="active"><?=$k051?></li>
                            </ol>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4><i class="fa fa-align-justify" aria-hidden="true"></i>&nbsp;<?=$wa21?></h4>
                                        <div class="buttons fr">
                                            <?php if ($user_settings['level'] >= 20): ?>
                                        	<a type="button" class="btn btn-primary btn-xs btn-panel" id="del" href="washlist_add.php?i=ok" data-remote="true" data-toggle="modal" data-target="#modal-n" data-backdrop="static" data-tag="<?=$wa22?>" data-class="modal-primary"><i class="fa fa-plus themed-tooltip" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$wa22?>"></i></a>
                                        	<?php else: ?>
                                        	<button type="button" class="btn btn-primary btn-xs btn-panel themed-tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$wa22?>" disabled="disabled"><i class="fa fa-plus themed-tooltip" aria-hidden="true"></i></button>
                                        	<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <?php if(!empty($washlist)): ?>
                                    <div class="table-responsive">
                                        <table id="washlist" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
											        <th><?=$wa11?></th>
											        <th><?=$wa04?></th>
											        <th><?=$wa28?></th>
											        <th><?=$wa06?></th>
                                                    <th><?=$wa12?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach($washlist as $single) {
												echo "
											    <tr>
												    <td>".$single['id']."</td>
												    <td>".$single['name']."</td>
												    <td>";
												    if($single['unit']=="kg") {
													    echo $single['weight']." ".$wa07;	
													} else if($single['unit']=="un") {
													    echo number_format($single['weight'],0)." ".$wa27;	
													} else {
														echo $single['weight'];
													}
												    echo "</td>
												    <td>".number_format($single['price'],2)."</td>
												    <td>";
												    if ($user_settings['level'] >= 50) {
														echo "
                                                    <a id=\"edit\" href=\"washlist_edit.php?id=".$single['id']."\" data-remote=\"true\" data-toggle=\"modal\" data-target=\"#modal-n\" data-backdrop=\"static\" data-tag=\"".$wa23."\" data-class=\"modal-warning\" class=\"btn btn-warning btn-sm\"><i class=\"fa fa-edit themed-tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"".$wa23."\"></i></a>
                                                    
                                                    <a id=\"remove\" href=\"washlist_remove.php?id=".$single['id']."\" data-remote=\"true\" data-toggle=\"modal\" data-target=\"#modal-n\" data-backdrop=\"static\" data-tag=\"".$wa24."\" data-class=\"modal-danger\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-trash themed-tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"".$wa24."\"></i></a>";
												    } else if ($user_settings['level'] == 20) {
														echo "
                                                    <a id=\"edit\" href=\"washlist_edit.php?id=".$single['id']."\" data-remote=\"true\" data-toggle=\"modal\" data-target=\"#modal-n\" data-backdrop=\"static\" data-tag=\"".$wa13."\" data-class=\"modal-warning\" class=\"btn btn-warning btn-sm\"><i class=\"fa fa-edit themed-tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"".$wa23."\"></i></a>
                                                    
                                                    <button data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"".$wa24."\" class=\"btn btn-danger btn-sm themed-tooltip\" disabled=\"disabled\"><i class=\"fa fa-trash\"></i></button>";
													} else {
														echo "
													<button data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"".$wa23."\" class=\"btn btn-warning btn-sm themed-tooltip\" disabled=\"disabled\"><i class=\"fa fa-edit\"></i></button>
													
													<button data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"".$wa24."\" class=\"btn btn-danger btn-sm themed-tooltip\" disabled=\"disabled\"><i class=\"fa fa-trash\"></i></button>";
													}
												echo "
												    </td>
												</tr>";	
											}
                                            ?>
                                            </tbody>
									        <tfoot>
										        <tr>
											        <td><?=$wa11?></td>
											        <td><?=$wa04?></td>
											        <td><?=$wa28?></td>
											        <td><?=$wa06?></td>
                                                    <td><?=$wa12?></td>
										        </tr>
									        </tfoot>
                                        </table>
                                    </div>
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
        $(function () {
            if(jQuery().dataTable) {
                $.extend(true,$.fn.dataTable.defaults, {
                    "language": {
                        "buttons": {
                            copyTitle: '<?=$dt041?>',
                            copySuccess: {
                                _: '%d <?=$dt042?>',
                                1: '1 <?=$dt043?>'
                            }
                        }
                    }           
                });
                if($("#washlist").length > 0) { 
	                $("#washlist").DataTable({
		                dom: '<"html5buttons" B>lTfgitp',
		                buttons: [
			            {
				            extend: 'copyHtml5',
				            text: '<?=$dt023?>',
				            exportOptions: {
					            columns: [ 0, 1, 2, 3 ]
				            },
				            title: '<?=$app?> - <?=$wa21?>'
			            },
			            {
				            extend: 'excelHtml5',
				            exportOptions: {
					            columns: [ 0, 1, 2, 3 ]
				            },
				            title: '<?=$app?> - <?=$wa21?>'
			            },
			            {
				            extend: 'pdfHtml5',
				            exportOptions: {
					            columns: [ 0, 1, 2, 3 ]
				            },
                            customize: function(doc) {
                                doc.defaultStyle.fontSize = 8;
                            },
                            title: '<?=$app?> - <?=$wa21?>'
			            },
			            {    
			                extend: 'print',
			                orientation: 'landscape',
			                text: '<?=$dt024?>',
				            exportOptions: {
					            columns: [ 0, 1, 2, 3 ]
				            }
			            }
		                ],
                        "aoColumns": [
				            { "bSearchable": false, "bSortable": true },
				            { "bSearchable": true, "bSortable": true },
				            { "bSearchable": true, "bSortable": true },
				            { "bSearchable": true, "bSortable": true },
				            { "bSearchable": false, "bSortable": false }
                        ],
		                "aaSorting": [[ 0, "desc" ]],
				        "iDisplayLength": 25,
				        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "<?=$dt026?>"]],
		                "oLanguage": {
			                "sLengthMenu": "<?=$dt027?> _MENU_ <?=$dt028?>.",
			                "sSearch": "<?=$dt029?>: ",
			                "sZeroRecords": "<?=$dt030?>.",
			                "sInfo": "<?=$dt031?> _START_ <?=$dt032?> _END_ <?=$dt033?> _TOTAL_ <?=$dt034?>.",
			                "sInfoEmpty": "<?=$dt031?> 0 <?=$dt032?> 0 <?=$dt034?>.",
			                "sInfoFiltered": "(<?=$dt035?> _MAX_ <?=$dt036?>)",
                            "oPaginate": {
                                "sFirst":    "<?=$dt037?>",
                                "sPrevious": "<?=$dt038?>",
                                "sNext":     "<?=$dt039?>",
                                "sLast":     "<?=$dt040?>"
                            }
                        }
                    });
                }
            }
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
