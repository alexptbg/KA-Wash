<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
if(!empty($_GET)) {
    $client = get_client($_GET['id']);
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
                            <h1><?=$k130?></h1>
                            <small><?=$k050?></small>
                            <ol class="breadcrumb">
                                <li><a href="index.php"><i class="pe-7s-home"></i>&nbsp;<?=$k012?></a></li>
                                <li><?=$k050?></li>
                                <li class="active"><?=$k130?></li>
                            </ol>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel panel-bd">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4><i class="fa fa-align-justify" aria-hidden="true"></i>&nbsp;<?=$k131?>
                                            <?php
                                                if ($client['type'] == "company") {
													echo $client['company_name'];
												}
                                                if ($client['type'] == "person") {
													echo $client['name'];
												}
											?>
                                        </h4>
                                        <div class="buttons fr">
											<span id="reconnect"><i class="fa fa-link" aria-hidden="true"></i></span>
											<span id="kantara-status"><i class="fa fa-circle themed-tooltip" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=$k093?>"></i></span>
										</div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form id="forms" class="form-horizontal" method="post">
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$k133?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="order_id" id="order_id" value="<?=get_counter("order")['value']?>" readonly="readonly" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$k134?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="client_id" id="client_id" value="<?php echo $client['id']; ?>" readonly="readonly" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl38?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="card" id="card" value="<?php echo $client['card']; ?>" readonly="readonly" /> 
		</div> 
	</div>

    <div class="form-group">
		<label class="col-sm-4 control-label"><?=$k137?>:</label> 
	    <div class="col-sm-8">
			<HR>
			<div id="services_list"></div>
		</div>
	</div>
	
    <div class="form-group">
		<label class="col-sm-4 control-label">&nbsp;</label> 
	    <div class="col-sm-8">
	        <a class="btn btn-success fr" id="add_service" href="washorders_services_add.php?order_id=<?=get_counter("order")['value']?>" data-remote="true" data-toggle="modal" data-target="#modal-lg" data-backdrop="static" data-tag="<?=$k136?>" data-class="modal-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<?=$k136?></a>
		</div>
	</div>
	
	                                    <div class="form-group display-none">
		                                    <label class="col-sm-4 control-label"><?=$k212?>:</label> 
		                                    <div class="col-sm-8">
                                                <input type='text' class="form-control validate[required,custom[date],future[<?php echo $today;?>]]" id="datetimepicker-1" name="order_end_date" value="<?php echo $today; ?>" />
		                                    </div>
	                                    </div>
	                                    
	                                    <div class="form-group display-none">
		                                    <label class="col-sm-4 control-label"><?=$k236?>:</label> 
		                                    <div class="col-sm-8">
                                                <input type='text' class="form-control" id='obs' name="obs" />
		                                    </div>
	                                    </div>
	                                    
    <div class="form-group">
		<label class="col-sm-4 control-label">&nbsp;</label> 
	    <div class="col-sm-8">
			<HR>
			<div id="next_step"></div>
		</div>
	</div>
	
									</form>
									<button type="button" id="btn" class="btn btn-default" onclick="window.history.go(-1);">
													<i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;<?php echo $k234; ?></button>
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
        <script type="text/javascript" src="assets/plugins/moment/moment.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" />
        <script type="text/javascript" src="assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
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
        <script type="text/javascript">
        $(function () {
            if(jQuery().validationEngine) {
                $("#forms").validationEngine({promptPosition : "bottomLeft:10", showArrowOnRadioAndCheckbox: true});;
            }
            $("#datetimepicker-1").datetimepicker({
                format: 'YYYY-MM-DD'
            });
            jQuery.ajax({
                type: "POST",
                data: { "order_id" : "<?=get_counter("order")['value']?>" },
                url: "ajax/washorders_services_list.php",
                success: function(data){
			        if(!$.isEmptyObject(data[0])) {
			            var div = "";
			            var step = "";
			            div += '<div class="table-responsive"><table class="table table-bordered table-striped table-hover"><thead><tr><th><?php echo $wa38;?></th><th><?php echo $k135;?></th><th><?php echo $wa39;?></th><th><?php echo $wa37;?></th><th><?php echo $k047;?></th></tr></thead><tbody>';
                        jQuery.each(data, function (i,res){
					        console.log(res.id);
					        var no = i+1;
					        var uni = "";
					        if(res.order_unit == "kg") {
						        uni = "<?php echo $wa07; ?>";
					        }
					        if(res.order_unit == "un") {
						        uni = "<?php echo $wa27; ?>";
					        }
					        div += '<tr><td>'+no+'</td><td>'+res.order_service_name+'</td><td>'+uni+'</td><td>'+res.order_quantity+'</td><td><input type="hidden" name="services[]" id="services" value="'+res.order_service+'-'+res.order_unit+'-'+res.order_quantity+'" /><button type="button" class="btn btn-sm btn-danger"  onClick="del_confirm(\''+res.id+'\'); return false;"><i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $k227;?>"></i></button></td></tr>';
				        });
				        div += '</tbody></table></div>';
				        //step += '<button type="button" class="btn btn-default" id="go_back"><i class="fa fa-times-circle-o"></i>&nbsp;<?php echo $k020; ?></button>';
				        step += '<button type="submit" class="btn btn-primary fr" name="submit" id="submit"><i class="fa fa-arrow-right"></i>&nbsp;<?php echo $k143; ?></button>';
				        $("div#services_list").append(div);
				        $("div#next_step").append(step);
				        $(".display-none").css({"display": "block" });
			        }
                },
                error: function(jqXhr,textStatus,errorThrown){
                    console.log(errorThrown);
                }
            });
            jQuery("#forms").on('click', '#submit', function(e) {
                var valid = jQuery("#forms").validationEngine('validate');
                if (valid == true) {
		            e.preventDefault();
		            $("button#add_service").attr("disabled",true);
		            var order_id = jQuery("input[name='order_id']").val();
		            var client_id = jQuery("input[name='client_id']").val();
		            var card = jQuery("input[name='card']").val();
		            var order_end_date = jQuery("input[name='order_end_date']").val();
		            var obs = jQuery("input[name='obs']").val();
		            //var services = jQuery("input[name='services[]'").val();
                    var services = $('input[name^=services]').map(function(idx, elem) {
                        return $(elem).val();
                    }).get();
		            var datastr = 'order_id='+order_id+'&client_id='+client_id+'&card='+card+'&order_end_date='+order_end_date+'&obs='+obs+'&services='+services;
		            //console.log(datastr);
		            send(datastr);
	            }
	        });
        });
        function del_confirm(id) {
	        var answer = confirm("<?php echo $k030; ?>");
	        if (answer){ service_del(id); }
	        else{ alert("<?php echo $k141; ?>"); }
        }
        function service_del(id) {
			$("button#add_service").attr("disabled",true);
			console.log(id);
            $.ajax({
                type: "POST",
                data: { "order_id" : "<?=get_counter("order")['value']?>", "id" : id },
                url: "ajax/washorders_service_del.php",
                success: function(){
		            setTimeout(function(){
					    window.location.reload(true);
				    },200);
                }
            });
            return false;
        }
        function send(datastr) {
			//console.log(datastr);
			var order_id = '<?=get_counter("order")['value']?>';
			var client_id = '<?php echo $client['id']; ?>';
            jQuery.ajax({
                type: "POST",
                url: "ajax/washorders_add.php",
                data: datastr,
                success: function(data){
				    console.log(data);
				    if(data.name == "data") {
						var final_step = "washorders_view_order.php?order_id="+order_id+"&client_id="+client_id;
				        window.location.assign(final_step);
				    }
                },
                error: function(jqXhr,textStatus,errorThrown){
                    console.log(errorThrown);
                },
            });
            return false;
        }
        </script>
        <!-- START THEME LABEL SCRIPT -->
        <script type="text/javascript" src="assets/dist/js/app.js"></script>
    </body>
</html>
