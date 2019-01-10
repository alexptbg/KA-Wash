<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
?>
<?php if ($user_settings['level'] >= 20): ?>
<form id="forms" class="form-horizontal" method="post">
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$u003?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="username" id="username" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$u004?>:</label> 
		<div class="col-sm-8"> 
			<input class="form-control validate[required,minSize[4]]" maxlength="32" type="password" name="password" id="password" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$u005?>:</label> 
		<div class="col-sm-8"> 
			<input class="form-control validate[required,equals[password]]" maxlength="32" type="password" name="password2" id="password2" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$u006?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="firstname" id="firstname" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$u007?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="lastname" id="lastname" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$u008?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="email" id="email" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$u009?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="phone" id="phone" /> 
		</div> 
	</div>
	<div class="form-group"> 
	    <label class="col-sm-4 control-label"><?=$u010?>:</label> 
		<div class="col-sm-8"> 
		    <select class="form-control validate[required]" id="access" name="access"> 
				<option></option>
				<option value="0"><?=$u011?></option>
				<option value="1"><?=$u012?></option>
			</select>
		</div> 
	</div>
	<div class="form-group"> 
	    <label class="col-sm-4 control-label"><?=$u013?>:</label> 
		<div class="col-sm-8"> 
		    <select class="form-control validate[required]" id="level" name="level"> 
				<option></option>
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="20">20</option>
				<?php if ($user_settings['level'] > 20): ?>
				<option value="50">50</option>
				<?php endif; ?>
			</select>
		</div> 
	</div>
	<div class="form-group"> 
	    <label class="col-sm-4 control-label"><?=$u014?>:</label> 
		<div class="col-sm-8"> 
		    <select class="form-control validate[required]" id="status" name="status"> 
				<option></option>
				<?php if ($user_settings['level'] > 20): ?>
				<option value="Active"><?=$u015?></option>
				<?php endif; ?>
				<option value="Pending"><?=$u016?></option>
				<?php if ($user_settings['level'] > 20): ?>
				<option value="Deactivated"><?=$u017?></option>
				<?php endif; ?>
			</select>
		</div> 
	</div>
	<div class="line-modal"></div>
	<div class="form-group">
	    <div class="col-sm-12">
			<div class="fr">
	            <button data-dismiss="modal" class="btn btn-default"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;<?=$k020?></button>
	            <button type="submit" class="btn btn-primary" name="submit" id="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;<?=$u018?></button>
			</div>
		</div>
	</div>
</form>
<div id="success">
    <div class="alert alert-success" role="alert"><span id="ok"></span></div>
</div>
<div id="error">
    <div class="alert alert-danger" role="alert"><span id="err"></span></div>
</div>
<!-- virtual keyboard-->
<?php if ($virtual_keyboard == "1"): ?>
<link type="text/css" rel="stylesheet" href="assets/dist/css/jquery.ml-keyboard.css" />
<script type="text/javascript" src="assets/dist/js/jquery.ml-keyboard.min.js"></script>
<script type="text/javascript">
$(function() {
    $("input").mlKeyboard({layout: 'en_US', active_shift: false});
});
</script>
<?php endif; ?>
<script type="text/javascript">
    $(function () {
        if(jQuery().validationEngine) {
            $("#forms").validationEngine({promptPosition : "bottomLeft:10"});;
        }
    });
    jQuery("#forms").on('click', '#submit', function(e) {
      var valid = jQuery("#forms").validationEngine('validate');
      if (valid == true) {
      	//validated
      	e.preventDefault();
		var username = jQuery("input[name='username']").val();
		var password = jQuery("input[name='password2']").val();
		var firstname = jQuery("input[name='firstname']").val();
		var lastname = jQuery("input[name='lastname']").val();
		var email = jQuery("input[name='email']").val();
		var phone = jQuery("input[name='phone']").val();
		var access = jQuery("select[name='access']").val();
		var level = jQuery("select[name='level']").val();
		var status = jQuery("select[name='status']").val();
        //build string data
        var datastr = 'username='+username+'&password='+password+'&firstname='+firstname+'&lastname='+lastname+'&email='+email+'&phone='+phone+'&access='+access+'&level='+level+'&status='+status;
        //console.log(datastr);
        send(datastr);
      } else {
      	e.preventDefault();
      }
    });
    function send(data) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/settings_users_add.php",
            data: data,
            success: function(data){
				console.log(data);
				jQuery("#error").hide();
				if (data[0]) {
				    if(data[0].name == "err") {
					    jQuery("span#err").html("<strong><?=$k026?> "+data[0].errnr+"</strong> -> "+data[0].error);
                        jQuery("#error").show();
                    }
			    }
				if(data.name == "data") {
                    jQuery("#forms").hide();
                    jQuery("span#ok").html("<strong><?=$k021?></strong> -> "+data.msg);
                    jQuery("#success").show();
		            setTimeout(function(){
					    jQuery("#modal-n").modal("hide");
					    window.location.reload(true);
				    },1500);
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
<p><?php echo $k037; ?></p>
<?php endif; ?>
