<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
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
//print_r($firma);
?>
<?php if($user_settings['level'] >= 50): ?>
<form id="forms" class="form-horizontal" method="post">
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$s003?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="name" id="name" value="<?php echo $firma['name']; ?>" />
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl07?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="address" id="address" value="<?php echo stripslashes(htmlentities($firma['address'])); ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl13?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="postcode" id="postcode" value="<?php echo $firma['postcode']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl14?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="city" id="city" value="<?php echo $firma['city']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl54?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="country" id="country" value="<?php echo $firma['country']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl09?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required,custom[number]]" name="phone" id="phone" value="<?php echo $firma['phone']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl10?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required,custom[email]]" name="email" id="email" value="<?php echo $firma['email']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl55?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control" name="website" id="website" value="<?php echo $firma['website']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl56?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="mol" id="mol" value="<?php echo $firma['mol']; ?>" /> 
		</div> 
	</div>
	
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl16?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="eik" id="eik" value="<?php echo $firma['eik']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl17?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="ddc" id="ddc" value="<?php echo $firma['ddc']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$s007?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control" name="bank" id="bank" value="<?php echo stripslashes(htmlentities($firma['bank'])); ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$s008?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control" name="iban" id="iban" value="<?php echo $firma['iban']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$s010?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control" name="bic" id="bic" value="<?php echo $firma['bic']; ?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$s012?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control" name="titular" id="titular" value="<?php echo stripslashes(htmlentities($firma['titular'])); ?>" /> 
		</div> 
	</div>

	
	<div class="form-group"> 
	    <label class="col-sm-4 control-label"><?=$k030?>:</label> 
		<div class="col-sm-8"> 
		    <select class="form-control validate[required]" name="confirm" id="confirm"> 
			    <option></option> 
			    <option value="NO"><?=$k029?></option>
			    <option value="NO"><?=$k029?></option>
			    <option value="NO"><?=$k029?></option>
			    <option value="NO"><?=$k029?></option>
			    <option value="YES"><?=$k028?></option>
			    <option value="NO"><?=$k029?></option>
			    <option value="NO"><?=$k029?></option>
			</select>
	    </div> 
	</div>
	<div class="line-modal"></div>
	<div class="form-group">
	    <div class="col-sm-12">
			<div class="fr">
	            <button data-dismiss="modal" class="btn btn-default"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;<?=$k020?></button>
			    <button type="submit" class="btn btn-danger" name="submit" id="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;<?=$kl58?></button>
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
        $("button#submit").attr("disabled",true);
        $("select#confirm").change(function() {
            if($("select#confirm").val().length > 0 && $("select#confirm").val() == "YES") {
		        $("button#submit").removeAttr("disabled");
            } else {
                $("button#submit").attr("disabled",true);
            }
        });
    });
    jQuery("#forms").on('click', '#submit', function(e) {
      var valid = jQuery("#forms").validationEngine('validate');
      if (valid == true) {
      	//validated
      	e.preventDefault();
      	var id = "<?=$company_id?>";
		var name = jQuery("input[name='name']").val();
		var address = jQuery("input[name='address']").val();
		var postcode = jQuery("input[name='postcode']").val();
		var city = jQuery("input[name='city']").val();
		var country = jQuery("input[name='country']").val();
		var phone = jQuery("input[name='phone']").val();
		var email = jQuery("input[name='email']").val();
		var website = jQuery("input[name='website']").val();
		var mol = jQuery("input[name='mol']").val();
		var eik = jQuery("input[name='eik']").val();
        var ddc = jQuery("input[name='ddc']").val();
        var bank = jQuery("input[name='bank']").val();
        var iban = jQuery("input[name='iban']").val();
        var bic = jQuery("input[name='bic']").val();
        var titular = jQuery("input[name='titular']").val();

		var confirm = jQuery("select#confirm").val();
        //build string data
        var datastr = 'id='+id+'&name='+name+'&address='+addslashes(address)+'&postcode='+postcode+'&city='+city+'&country='+country+'&phone='+phone+'&email='+email+'&website='+website+'&mol='+mol+'&eik='+eik+'&ddc='+ddc+'&bank='+addslashes(bank)+'&iban='+iban+'&bic='+bic+'&titular='+addslashes(titular)+'&confirm='+confirm;
        //console.log(datastr);
        send(datastr);
      } else {
      	e.preventDefault();
      }
    });
    function send(data) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/settings_company_edit.php",
            data: data,
            success: function(data){
				//console.log(data);
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
				    },1200);
				}
            },
            error: function(jqXhr,textStatus,errorThrown){
                console.log(errorThrown);
            },
        });
        return false;
    }
    function addslashes(str) {
        str = str.replace(/\\/g, '\\\\');
        str = str.replace(/\'/g, '\\\'');
        str = str.replace(/\"/g, '\\"');
        str = str.replace(/\0/g, '\\0');
        return str;
    }
    function stripslashes(str) {
        str = str.replace(/\\'/g, '\'');
        str = str.replace(/\\"/g, '"');
        str = str.replace(/\\0/g, '\0');
        str = str.replace(/\\\\/g, '\\');
        return str;
    }
</script>
<?php else: ?>
<p><?php echo $k037; ?></p>
<?php endif; ?>
