<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
?>
<?php if((!empty($_GET)) && ($user_settings['level'] >= 50)): ?>
<form id="forms" class="form-horizontal" method="post">
    <div class="form-group">
        <label class="col-sm-12 control-label"><p class="text-danger fl"><strong><?=$lo10?>?</strong></p></label>
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
			    <button type="submit" class="btn btn-danger" name="submit" id="submit"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;<?=$lo08?></button>
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
		var confirm = jQuery("select#confirm").val();

        var datastr = 'confirm='+confirm;
        //console.log(datastr);
        send(datastr);
      } else {
      	e.preventDefault();
      }
    });
    function send(data) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/user_logs_del.php",
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
