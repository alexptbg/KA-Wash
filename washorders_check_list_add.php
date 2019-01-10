<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
if (!empty($_GET)) {
    $order_id = $_GET['order_id'];
    $client_id = $_GET['client_id'];
}
?>
<form id="forms" class="form-horizontal" method="post">
	<!--
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$k081?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="nr" id="nr" value="" /> 
		</div> 
	</div>
    -->
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$k216?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="item" id="item" value="" /> 
		</div> 
	</div>
	
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$k218?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="art_in" id="art_in" value="" /> 
		</div> 
	</div>

	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$k219?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="art_out" id="art_out" value="" /> 
		</div> 
	</div>

	<div class="line-modal"></div>
	<div class="form-group">
	    <div class="col-sm-12">
			<div class="fr">
	            <button data-dismiss="modal" class="btn btn-default"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;<?=$k020?></button>
	            <button type="submit" class="btn btn-primary" name="submit" id="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;<?=$wa08?></button>
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
                $("#forms").validationEngine({promptPosition : "bottomLeft:10", showArrowOnRadioAndCheckbox: true});;
            }
    jQuery("#forms").on('click', '#submit', function(e) {
      var valid = jQuery("#forms").validationEngine('validate');
      if (valid == true) {
      	//validated
      	e.preventDefault();
		var order_id = "<?php echo $order_id; ?>";
		var client_id = "<?php echo $client_id; ?>";
		
		//var nr = jQuery("input[name='nr']").val();
		var item = jQuery("input[name='item']").val();
		var art_in = jQuery("input[name='art_in']").val();
		var art_out = jQuery("input[name='art_out']").val();

        //var datastr = 'order_id='+order_id+'&client_id='+client_id+'&nr='+nr+'&item='+item+'&art_in='+art_in+'&art_out='+art_out;
        var datastr = 'order_id='+order_id+'&client_id='+client_id+'&item='+item+'&art_in='+art_in+'&art_out='+art_out;
        //console.log(datastr);
        send(datastr);
      } else {
      	e.preventDefault();
      }
    });
    function send(data) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/washorders_check_list_add.php",
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
				    },500);
				}
            },
            error: function(jqXhr,textStatus,errorThrown){
                console.log(errorThrown);
            },
        });
        return false;
    }
});
</script>
