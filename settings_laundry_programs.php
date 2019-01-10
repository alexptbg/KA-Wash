<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
$washid = "";
if(!empty($_GET)) {
	$washid = $_GET['washid'];
	$washmachine = get_washmachine($washid);
    $laundryprograms = array();
    $sql="SELECT * FROM `washprograms".$washid."` ORDER BY `id` ASC";
    $result=$local->query($sql);
    if($result === false) {
        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
    } else {
        if($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
		        $laundryprograms[] = $row;
	        }
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
                                <li><a href="?lang=en&washid=<?=$washid?>"><i class="flag-icon flag-icon-gb"></i>&nbsp;&nbsp;<?=$k004?></a></li>
                                <?php elseif ($lang == "en"): ?>
                                <li><a href="?lang=bg&washid=<?=$washid?>"><i class="flag-icon flag-icon-bg"></i>&nbsp;&nbsp;<?=$k005?></a></li>
                                <?php else: ?>
                                <li><a href="?lang=en&washid=<?=$washid?>"><i class="flag-icon flag-icon-gb"></i>&nbsp;&nbsp;<?=$k004?></a></li>
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
                        <li class="active">
                            <a href="javascript:void(0)" class="material-ripple"><i class="material-icons">local_laundry_service</i><?=$s016?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li><a href="settings_washing_machines.php"><?=$s026?></a></li>
                                <!--<li class="active"><a href="settings_laundry_programs.php"><?=$s017?></a></li>-->
                                <li class="active"><a href="javascript:void(0)"><?=$s017?></a>
                                    <?php $washmachines = get_washmachines(); ?>
                                    <?php if(!empty($washmachines)): ?>
								    <ul class="nav collapse">
										<?php
										$y=1;
										foreach($washmachines as $single) {
											if($y == $washid) {
												echo "<li class=\"active\"><a href=\"settings_laundry_programs.php?washid=".$single['number']."\"><span class=\"title\">".$k110." ".$single['number']."</span></a></li>";
											} else {
											    echo "<li><a href=\"settings_laundry_programs.php?washid=".$single['number']."\"><span class=\"title\">".$k110." ".$single['number']."</span></a></li>";	
											}
									        $y++;
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
                            <h1><?=$s017?></h1>
                            <small><?=$k008?></small>
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="pe-7s-home"></i>&nbsp;<?=$k012?></a></li>
                                <li><?=$k008?></li>
                                <li><?=$s016?></li>
                                <li class="active"><?=$s017?></li>
                            </ol>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4><i class="fa fa-align-justify" aria-hidden="true"></i>&nbsp;<?=$k110?>&nbsp;<?=$washid?></h4>
                                        <div class="buttons fr">
                                            <?php if ($user_settings['level'] >= 20): ?>
                                        	<!--<a type="button" class="btn btn-primary btn-xs btn-panel" id="del" href="washlist_add.php?i=ok" data-remote="true" data-toggle="modal" data-target="#modal-n" data-backdrop="static" data-tag="<?=$wa22?>" data-class="modal-primary"><i class="fa fa-plus themed-tooltip" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$wa22?>"></i></a>-->
                                        	<?php else: ?>
                                        	<!--
                                        	<button type="button" class="btn btn-primary btn-xs btn-panel themed-tooltip" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$wa22?>" disabled="disabled"><i class="fa fa-plus themed-tooltip" aria-hidden="true"></i></button>
                                        	-->
                                        	<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <?php if(!empty($laundryprograms)): ?>
                                    <h3 class="colored m-t-10 m-b-10"><?php echo $washmachine['number']." ".$washmachine['brand']." ".$washmachine['model']; ?></h3>
                                    <?php
                                    $x=1;
                                    foreach($laundryprograms as $program) {
                                        echo "
                                    <div class=\"table-responsive\">
                                        <table id=\"laundryprogram-".$x."\" class=\"table table-bordered table-striped table-condensed\" style=\"border-color:#ffffff;\">
                                            <thead>
                                                <tr>
											        <th><span class=\"colored\" style=\"text-transform:uppercase;font-weight:900\">".$program['name']."</span></th>
											        <th>".$s020."1</th>
											        <th>".$s020."2</th>
											        <th>".$s020."3</th>
											        <th>".$s020."4</th>
											        <th>".$s020."5</th>
											        <th>".$s020."6</th>
											        <th>".$s020."7</th>
											        <th>".$s020."8</th>
											        <th>".$s021."</th>
											        <th>".$s022."</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style=\"color:#FFFFFF;font-weight:700;\">".$s019."1</td>
                                                    <td>".$program['s1p1']."</td>
                                                    <td>".$program['s1p2']."</td>
                                                    <td>".$program['s1p3']."</td>
                                                    <td>".$program['s1p4']."</td>
                                                    <td>".$program['s1p5']."</td>
                                                    <td>".$program['s1p6']."</td>
                                                    <td>".$program['s1p7']."</td>
                                                    <td>".$program['s1p8']."</td>
                                                    <td>".$program['s1time']."</td>
                                                    <td>".$program['s1name']."</td>
                                                </tr>
                                                <tr>
                                                    <td style=\"color:#FFFFFF;font-weight:700;\">".$s019."2</td>
                                                    <td>".$program['s2p1']."</td>
                                                    <td>".$program['s2p2']."</td>
                                                    <td>".$program['s2p3']."</td>
                                                    <td>".$program['s2p4']."</td>
                                                    <td>".$program['s2p5']."</td>
                                                    <td>".$program['s2p6']."</td>
                                                    <td>".$program['s2p7']."</td>
                                                    <td>".$program['s2p8']."</td>
                                                    <td>".$program['s2time']."</td>
                                                    <td>".$program['s2name']."</td>
                                                </tr>
                                                <tr>
                                                    <td style=\"color:#FFFFFF;font-weight:700;\">".$s019."3</td>
                                                    <td>".$program['s3p1']."</td>
                                                    <td>".$program['s3p2']."</td>
                                                    <td>".$program['s3p3']."</td>
                                                    <td>".$program['s3p4']."</td>
                                                    <td>".$program['s3p5']."</td>
                                                    <td>".$program['s3p6']."</td>
                                                    <td>".$program['s3p7']."</td>
                                                    <td>".$program['s3p8']."</td>
                                                    <td>".$program['s3time']."</td>
                                                    <td>".$program['s3name']."</td>
                                                </tr>
                                                <tr>
                                                    <td style=\"color:#FFFFFF;font-weight:700;\">".$s019."4</td>
                                                    <td>".$program['s4p1']."</td>
                                                    <td>".$program['s4p2']."</td>
                                                    <td>".$program['s4p3']."</td>
                                                    <td>".$program['s4p4']."</td>
                                                    <td>".$program['s4p5']."</td>
                                                    <td>".$program['s4p6']."</td>
                                                    <td>".$program['s4p7']."</td>
                                                    <td>".$program['s4p8']."</td>
                                                    <td>".$program['s4time']."</td>
                                                    <td>".$program['s4name']."</td>
                                                </tr>
                                                <tr>
                                                    <td style=\"color:#FFFFFF;font-weight:700;\">".$s019."5</td>
                                                    <td>".$program['s5p1']."</td>
                                                    <td>".$program['s5p2']."</td>
                                                    <td>".$program['s5p3']."</td>
                                                    <td>".$program['s5p4']."</td>
                                                    <td>".$program['s5p5']."</td>
                                                    <td>".$program['s5p6']."</td>
                                                    <td>".$program['s5p7']."</td>
                                                    <td>".$program['s5p8']."</td>
                                                    <td>".$program['s5time']."</td>
                                                    <td>".$program['s5name']."</td>
                                                </tr>
                                                <tr>
                                                    <td style=\"color:#FFFFFF;font-weight:700;\">".$s019."6</td>
                                                    <td>".$program['s6p1']."</td>
                                                    <td>".$program['s6p2']."</td>
                                                    <td>".$program['s6p3']."</td>
                                                    <td>".$program['s6p4']."</td>
                                                    <td>".$program['s6p5']."</td>
                                                    <td>".$program['s6p6']."</td>
                                                    <td>".$program['s6p7']."</td>
                                                    <td>".$program['s6p8']."</td>
                                                    <td>".$program['s6time']."</td>
                                                    <td>".$program['s6name']."</td>
                                                </tr>
                                                <tr>
                                                    <td style=\"color:#FFFFFF;font-weight:700;\">".$s019."7</td>
                                                    <td>".$program['s7p1']."</td>
                                                    <td>".$program['s7p2']."</td>
                                                    <td>".$program['s7p3']."</td>
                                                    <td>".$program['s7p4']."</td>
                                                    <td>".$program['s7p5']."</td>
                                                    <td>".$program['s7p6']."</td>
                                                    <td>".$program['s7p7']."</td>
                                                    <td>".$program['s7p8']."</td>
                                                    <td>".$program['s7time']."</td>
                                                    <td>".$program['s7name']."</td>
                                                </tr>
                                                <tr>
                                                    <td style=\"color:#FFFFFF;font-weight:700;\">".$s019."8</td>
                                                    <td>".$program['s8p1']."</td>
                                                    <td>".$program['s8p2']."</td>
                                                    <td>".$program['s8p3']."</td>
                                                    <td>".$program['s8p4']."</td>
                                                    <td>".$program['s8p5']."</td>
                                                    <td>".$program['s8p6']."</td>
                                                    <td>".$program['s8p7']."</td>
                                                    <td>".$program['s8p8']."</td>
                                                    <td>".$program['s8time']."</td>
                                                    <td>".$program['s8name']."</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class=\"tar\" colspan=\"11\">";
                                                if ($user_settings['level'] >= 50) {
													echo "
													<a id=\"edit\" href=\"settings_laundry_programs_edit.php?tableid=".$washid."&progid=".$program['id']."\" data-remote=\"true\" data-toggle=\"modal\" data-target=\"#modal-lg\" data-backdrop=\"static\" data-tag=\"".$s024." ".$x."\" data-class=\"modal-warning\" class=\"btn btn-warning\"><i class=\"fa fa-edit themed-tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"".$s023."\">&nbsp;".$k108."&nbsp;".$program['id']."</i></a>
													";
												} else {
													echo "
													<button data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"".$s023."\" class=\"btn btn-warning themed-tooltip\" disabled=\"disabled\"><i class=\"fa fa-edit\"></i>&nbsp;".$k108."&nbsp;".$program['id']."</button>
													";
												}
                                                echo "
                                                    </td>
                                                <tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                        ";
                                    $x++;
									}
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
                <div class="modal-dialog modal-xlg80" role="document">
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
		<!-- validation -->
		<link rel="stylesheet" type="text/css" href="assets/plugins/validationEngine/jquery.validationEngine.css" />
		<script type="text/javascript" src="assets/plugins/validationEngine/jquery.validationEngine.js"></script>
		<script type="text/javascript" src="assets/plugins/validationEngine/jquery.validationEngine-<?=$lang?>.js"></script>
        <!-- START THEME LABEL SCRIPT -->
        <script type="text/javascript" src="assets/dist/js/app.js"></script>
    </body>
</html>
