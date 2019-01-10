<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
?>
<?php if((!empty($_GET)) && ($user_settings['level'] >= 20) || (!empty($_GET)) && ($user_settings['level'] == 10) && ($_GET['username'] == $user_settings['username'])): ?>
<?php
if(!empty($_GET)) {
    $user = get_user($_GET['id'],$_GET['username']);
}
?>
<form id="forms" class="form-horizontal" method="post">
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$k027?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="id" id="id" value="<?php echo $user['id']; ?>" readonly="readonly" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$u003?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="username" id="username" value="<?php echo $user['username']; ?>" readonly="readonly" />
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$u006?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="firstname" id="firstname" value="<?php echo $user['firstname']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$u007?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="lastname" id="lastname" value="<?php echo $user['lastname']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$u008?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="email" id="email" value="<?php echo $user['email']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$u009?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="phone" id="phone" value="<?php echo $user['phone']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
	    <label class="col-sm-4 control-label"><?=$u010?>:</label> 
		<div class="col-sm-8">
			<?php
			    if ($user['access'] == "0") { $access_name = $u011; }
			    if ($user['access'] == "1") { $access_name = $u012; }
			?>
		    <select class="form-control validate[required]" id="access" name="access">
				<option value="<?php echo $user['access']; ?>"><?php echo $access_name; ?></option>
				<?php if($user_settings['level'] >= 20): ?>
				<option></option>
				<?php if($user['username'] == "admin"): ?>
				<option value="1"><?=$u012?></option>
				<?php else: ?>
				<option value="0"><?=$u011?></option>
				<option value="1"><?=$u012?></option>
				<?php endif; ?>
				<?php endif; ?>
			</select>
		</div> 
	</div>
	<div class="form-group"> 
	    <label class="col-sm-4 control-label"><?=$u013?>:</label>
		<div class="col-sm-8"> 
		    <select class="form-control validate[required]" id="level" name="level">
				<option value="<?php echo $user['level']; ?>"><?php echo $user['level']; ?></option>
				<?php if($user_settings['level'] >= 20): ?>
				<option></option>
				<?php if($user['username'] == "admin"): ?>
				<option value="50">50</option>
				<?php else: ?>
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="20">20</option>
				<?php if ($user_settings['level'] > 20): ?>
				<option value="50">50</option>
				<?php endif; ?>
				<?php endif; ?>
				<?php endif; ?>
			</select>
		</div> 
	</div>
	<div class="form-group">
	    <label class="col-sm-4 control-label"><?=$u014?>:</label> 
		<div class="col-sm-8">
			<?php
			    if ($user['status'] == "Active") { $status_name = $u015; }
			    if ($user['status'] == "Deactivated") { $status_name = $u017; }
			?>
		    <select class="form-control validate[required]" id="status" name="status">
				<option value="<?php echo $user['status']; ?>"><?php echo $status_name; ?></option>
				<?php if($user_settings['level'] >= 20): ?>
				<option></option>
				<?php if($user['username'] == "admin"): ?>
				<option value="Active"><?=$u015?></option>
				<?php else: ?>
				<option value="Active"><?=$u015?></option>
				<option value="Deactivated"><?=$u017?></option>
				<?php endif; ?>
				<?php endif; ?>
			</select>
		</div> 
	</div>
	<div class="line-modal"></div>
	<div class="form-group">
	    <div class="col-sm-12">
			<div class="fr">
	            <button data-dismiss="modal" class="btn btn-default"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;<?=$k020?></button>
	            <button type="submit" class="btn btn-warning" name="submit" id="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;<?=$u048?></button>
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
      	var id = jQuery("input[name='id']").val();
		var username = jQuery("input[name='username']").val();
		var firstname = jQuery("input[name='firstname']").val();
		var lastname = jQuery("input[name='lastname']").val();
		var email = jQuery("input[name='email']").val();
		var phone = jQuery("input[name='phone']").val();
		var access = jQuery("select[name='access']").val();
		var level = jQuery("select[name='level']").val();
		var status = jQuery("select[name='status']").val();

        //build string data
        var datastr = 'id='+id+'&username='+username+'&firstname='+firstname+'&lastname='+lastname+'&email='+email+'&phone='+phone+'&access='+access+'&level='+level+'&status='+status;
        //console.log(datastr);
        send(datastr);
      } else {
      	e.preventDefault();
      }
    });
    function send(data) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/settings_users_edit.php",
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
