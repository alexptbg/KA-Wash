<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1" />
        <meta name="description" content="SYSTEM" />
        <meta name="keywords" content="SYSTEM" />
        <title>SYSTEM</title>
        <meta name="AUTHOR" content="ALEX SOARES | Алекс Соарес" />
        <meta name="GENERATOR" content="POWERED BY KA-EX" />
        <meta name="VERSION" content="1.0" />
        <meta name="CREATED" content="2017-10-01" />
        <!-- FEVICON AND TOUCH ICON -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/dist/img/ico/favicon.png" />
        <link rel="apple-touch-icon" type="image/x-icon" href="assets/dist/img/ico/apple-touch-icon-57-precomposed.png" />
        <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets/dist/img/ico/apple-touch-icon-72-precomposed.png" />
        <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets/dist/img/ico/apple-touch-icon-114-precomposed.png" />
        <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets/dist/img/ico/apple-touch-icon-144-precomposed.png" />
        <!-- STATRT GLOBAL MANDATORY STYLE -->
        <link rel="stylesheet" type="text/css" href="assets/dist/css/base.css" />
        <!-- START PAGE LABEL PLUGINS --> 
        <!-- START THEME LAYOUT STYLE -->
        <link rel="stylesheet" type="text/css" href="assets/dist/css/component_ui.css" />
        <link rel="stylesheet" type="text/css" href="assets/dist/css/skins/component_ui_black.css" />
        <link rel="stylesheet" type="text/css" href="assets/dist/css/custom.css" />
        <link rel="stylesheet" type="text/css" href="assets/dist/css/ka-ex.css" />
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
                        <span class="sr-only">Toggle navigation</span>
                        <i class="material-icons" title="Toggle navigation">apps</i>
                    </button>
                    <a class="navbar-brand" href="index.php"><img class="main-logo" src="assets/dist/img/logo.png" id="bg" alt="logo" /><!--<span>ProgramName</span>--></a>
                </div>
                <div class="nav-container">
                    <!-- /.navbar-header -->
                    <ul class="nav navbar-nav hidden-xs">
                        <li><a id="fullscreen" href="#" title="Toggle fullscreen"><i class="material-icons">fullscreen</i>&nbsp;</a></li>
                    </ul>
                    <!-- right side -->
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="material-icons">add_alert</i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span></div>
                                <!--<i class="ti-announcement"></i>-->
                                <!--<i class="ti-angle-down"></i>-->
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <!--<li class="ui_popover_tooltip"></li>-->
                                <li class="rad-dropmenu-header"><a href="#">Your Notifications</a></li>
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
                                <li class="rad-dropmenu-footer"><a href="#">See all notifications</a></li>
                            </ul>  <!-- /.dropdown-alerts -->
                            <!-- /.dropdown-alerts -->
                        </li>
                        <!-- /.Dropdown -->
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="material-icons">person</i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="profile.html"><i class="ti-user"></i>&nbsp; Profile</a></li>
                                <li><a href="mailbox.html"><i class="ti-email"></i>&nbsp; My Messages</a></li>
                                <li><a href="lockscreen.html"><i class="ti-lock"></i>&nbsp; Lock Screen</a></li>
                                <li><a href="#"><i class="ti-settings"></i>&nbsp; Settings</a></li>
                                <li><a href="login.html"><i class="ti-layout-sidebar-left"></i>&nbsp; Logout</a></li>
                            </ul><!-- /.dropdown-user -->
                        </li><!-- /.Dropdown -->
                        <li class="log_out">
                            <a href="logout.php">
                                <i class="material-icons">power_settings_new</i>
                            </a>
                        </li><!-- /.Log out -->
                    </ul> <!-- /.navbar-top-links -->
                </div>
            </nav>
            <!-- /.Navigation -->
            <div class="sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="nav-heading"><span>Main Navigation&nbsp;&nbsp;&nbsp;<strong>&not;</strong></span></li>
                        <li><a href="index.php" class="material-ripple"><i class="material-icons themed">home</i>Dashboard</a></li>
                        <li>
                            <a href="#" class="material-ripple"><i class="material-icons">bubble_chart</i>Charts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="charts_flot.html">Flot Chart</a></li>
                                <li><a href="charts_Js.html">Chart js</a></li>
                                <li><a href="charts_morris.html">Morris Charts</a></li>
                                <li><a href="charts_sparkline.html">Sparkline Charts</a></li>
                                <li><a href="charts_am.html">Am Charts</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
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
                        <div class=header-icon>
                            <i class=pe-7s-tools></i>
                        </div>
                        <div class=header-title>
                            <h1>PROGRAM NAME</h1>
                            <small>v1.0</small>
                            <ol class=breadcrumb>
                                <li><a href=index.php><i class=pe-7s-home></i> Home</a></li>
                                <li class=active>Dashboard</li>
                            </ol>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>This is page content</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <p>You can create here any grid layout you want. And any variation layout you imagine:) Check out main dashboard and other site. It use many different layout. </p>
                                </div>
                                <div class="panel-footer">
                                    This is standard panel footer
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.main content -->
            </div><!-- /#page-wrapper -->
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
        <!-- STRAT PAGE LABEL PLUGINS -->
        <!-- START THEME LABEL SCRIPT -->
        <script type="text/javascript" src="assets/dist/js/app.min.js" type="text/javascript"></script>
    </body>
</html>