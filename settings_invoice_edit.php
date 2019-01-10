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
$logo_path=$_SERVER['DOCUMENT_ROOT']."/".$config['base_dir']."/logo/".$firma['logo'];
if (file_exists($logo_path)) {
    $logo_file=$config['base_url']."/logo/".$firma['logo'];
} else {
    $logo_file=$config['base_url']."/assets/dist/img/logo-not-".$lang.".png";
}
?>
<?php if($user_settings['level'] >= 50): ?>
<form id="forms" class="form-horizontal" method="post">
	<div class="form-group">
		<label class="col-sm-5 control-label"><?=$k064?>:</label> 
		<div class="col-sm-3"> 
            <div class="radio radio-inline">
                <input type="radio" id="inlineRadio1" value="no" name="show_logo" <?php if (isset($firma['show_logo']) && $firma['show_logo']=="no") echo "checked";?> />
                <label for="inlineRadio1">&nbsp;<?=$k029?>&nbsp;</label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="inlineRadio2" value="yes" name="show_logo" <?php if (isset($firma['show_logo']) && $firma['show_logo']=="yes") echo "checked";?> />
                <label for="inlineRadio2">&nbsp;<?=$k028?>&nbsp;</label>
            </div>
		</div>
		<div class="col-sm-4"> 
			<img src="<?=$logo_file?>" alt="logo" class="mycompany-logo-edit" />
		</div>
	</div>	
    <div class="line-modal-invoice"></div>
	<div class="form-group">
		<label class="col-sm-5 control-label"><?=$k063?>:</label> 
		<div class="col-sm-3"> 
            <div class="radio radio-inline">
                <input type="radio" id="inlineRadio3" value="no" name="show_address" <?php if (isset($firma['show_address']) && $firma['show_address']=="no") echo "checked";?> />
                <label for="inlineRadio3">&nbsp;<?=$k029?>&nbsp;</label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="inlineRadio4" value="yes" name="show_address" <?php if (isset($firma['show_address']) && $firma['show_address']=="yes") echo "checked";?> />
                <label for="inlineRadio4">&nbsp;<?=$k028?>&nbsp;</label>
            </div>
		</div> 
		<div class="col-sm-4"> 
			<p class="m-t-8"><strong><?=stripslashes($firma['address'])?></strong></p>
		</div>
	</div>
	<div class="line-modal-invoice"></div>
	<div class="form-group">
		<label class="col-sm-5 control-label"><?=$k065?>:</label> 
		<div class="col-sm-3"> 
            <div class="radio radio-inline">
                <input type="radio" id="inlineRadio5" value="no" name="show_country" <?php if (isset($firma['show_country']) && $firma['show_country']=="no") echo "checked";?> />
                <label for="inlineRadio5">&nbsp;<?=$k029?>&nbsp;</label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="inlineRadio6" value="yes" name="show_country" <?php if (isset($firma['show_country']) && $firma['show_country']=="yes") echo "checked";?> />
                <label for="inlineRadio6">&nbsp;<?=$k028?>&nbsp;</label>
            </div>
		</div> 
		<div class="col-sm-4"> 
			<p class="m-t-8"><strong><?=stripslashes($firma['country'])?></strong></p>
		</div>
	</div>
	<div class="line-modal-invoice"></div>
	<div class="form-group">
		<label class="col-sm-5 control-label"><?=$k066?>:</label> 
		<div class="col-sm-3"> 
            <div class="radio radio-inline">
                <input type="radio" id="inlineRadio7" value="no" name="show_phone" <?php if (isset($firma['show_phone']) && $firma['show_phone']=="no") echo "checked";?> />
                <label for="inlineRadio7">&nbsp;<?=$k029?>&nbsp;</label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="inlineRadio8" value="yes" name="show_phone" <?php if (isset($firma['show_phone']) && $firma['show_phone']=="yes") echo "checked";?> />
                <label for="inlineRadio8">&nbsp;<?=$k028?>&nbsp;</label>
            </div>
		</div> 
		<div class="col-sm-4"> 
			<p class="m-t-8"><strong><?=stripslashes($firma['phone'])?></strong></p>
		</div>
	</div>
	<div class="line-modal-invoice"></div>
	<div class="form-group">
		<label class="col-sm-5 control-label"><?=$k067?>:</label> 
		<div class="col-sm-3"> 
            <div class="radio radio-inline">
                <input type="radio" id="inlineRadio9" value="no" name="show_email" <?php if (isset($firma['show_email']) && $firma['show_email']=="no") echo "checked";?> />
                <label for="inlineRadio9">&nbsp;<?=$k029?>&nbsp;</label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="inlineRadio10" value="yes" name="show_email" <?php if (isset($firma['show_email']) && $firma['show_email']=="yes") echo "checked";?> />
                <label for="inlineRadio10">&nbsp;<?=$k028?>&nbsp;</label>
            </div>
		</div> 
		<div class="col-sm-4"> 
			<p class="m-t-8"><strong><?=stripslashes($firma['email'])?></strong></p>
		</div>
	</div>
	<div class="line-modal-invoice"></div>
	<div class="form-group">
		<label class="col-sm-5 control-label"><?=$k068?>:</label> 
		<div class="col-sm-3"> 
            <div class="radio radio-inline">
                <input type="radio" id="inlineRadio11" value="no" name="show_website" <?php if (isset($firma['show_website']) && $firma['show_website']=="no") echo "checked";?> />
                <label for="inlineRadio11">&nbsp;<?=$k029?>&nbsp;</label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="inlineRadio12" value="yes" name="show_website" <?php if (isset($firma['show_website']) && $firma['show_website']=="yes") echo "checked";?> />
                <label for="inlineRadio12">&nbsp;<?=$k028?>&nbsp;</label>
            </div>
		</div> 
		<div class="col-sm-4"> 
			<p class="m-t-8"><strong><?=stripslashes($firma['website'])?></strong></p>
		</div>
	</div>
	<div class="line-modal-invoice"></div>
	<div class="form-group">
		<label class="col-sm-5 control-label"><?=$k069?>:</label> 
		<div class="col-sm-3"> 
            <div class="radio radio-inline">
                <input type="radio" id="inlineRadio13" value="no" name="show_bank" <?php if (isset($firma['show_bank']) && $firma['show_bank']=="no") echo "checked";?> />
                <label for="inlineRadio13">&nbsp;<?=$k029?>&nbsp;</label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="inlineRadio14" value="yes" name="show_bank" <?php if (isset($firma['show_bank']) && $firma['show_bank']=="yes") echo "checked";?> />
                <label for="inlineRadio14">&nbsp;<?=$k028?>&nbsp;</label>
            </div>
		</div> 
		<div class="col-sm-4"> 
			<p class="m-t-8"><strong><?=stripslashes($firma['bank'])?></strong></p>
			<p class="m-t-0"><strong>&nbsp;<?=stripslashes($firma['iban'])?></strong></p>
			<p class="m-t-0"><strong>&nbsp;<?=stripslashes($firma['bic'])?></strong></p>
			<p class="m-t-0"><strong>&nbsp;<?=stripslashes($firma['titular'])?></strong></p>
		</div>
	</div>
	<div class="line-modal-invoice"></div>
	
	<div class="form-group"> 
	    <label class="col-sm-5 control-label"><?=$k030?>:</label> 
		<div class="col-sm-7"> 
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
      	var show_logo = $('input[name=show_logo]:checked', '#forms').val();
		var show_address = $('input[name=show_address]:checked', '#forms').val();
        var show_country = $('input[name=show_country]:checked', '#forms').val();
        var show_phone = $('input[name=show_phone]:checked', '#forms').val();
        var show_email = $('input[name=show_email]:checked', '#forms').val();
        var show_website = $('input[name=show_website]:checked', '#forms').val();
        var show_bank = $('input[name=show_logo]:checked', '#forms').val();

		var confirm = jQuery("select#confirm").val();
        //build string data
        var datastr = 'id='+id+'&show_logo='+show_logo+'&show_address='+show_address+'&show_country='+show_country+'&show_phone='+show_phone+'&show_email='+show_email+'&show_website='+show_website+'&show_bank='+show_bank+'&confirm='+confirm;
        //console.log(datastr);
        send(datastr);
      } else {
      	e.preventDefault();
      }
    });
    function send(data) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/settings_invoice_edit.php",
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
</script>
<?php else: ?>
<p><?php echo $k037; ?></p>
<?php endif; ?>
