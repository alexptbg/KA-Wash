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
		<label class="col-sm-5 control-label"><?=$wa04?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required]" name="name" id="name" /> 
		</div> 
	</div>
	<div class="form-group"> 
	    <label class="col-sm-5 control-label"><?=$wa28?>:</label>
		<div class="col-sm-4"> 
		    <select class="form-control validate[required]" id="unit" name="unit">
				<option></option>
				<option value="kg"><?=$wa07?></option>
				<option value="un"><?=$wa26?></option>
			</select>
		</div> 
		<div class="col-sm-3"> 
		    <select class="form-control validate[required]" id="weight" name="weight">
				<option></option>
			</select>
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$wa06?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required,custom[number]]" name="price" id="price" /> 
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
        $("select#unit").on("change",function() {
			var unit = jQuery("select[name='unit']").val();
			if(unit=="kg"){
				$("select#weight").html('<option><?=$k045?>...</option><option value="0.5">0.5&nbsp;<?=$wa07?></option><option value="1.0">1.0&nbsp;<?=$wa07?></option><option value="1.5">1.5&nbsp;<?=$wa07?></option><option value="2.0">2.0&nbsp;<?=$wa07?></option><option value="2.5">2.5&nbsp;<?=$wa07?></option><option value="3.0">3.0&nbsp;<?=$wa07?></option><option value="3.5">3.5&nbsp;<?=$wa07?></option><option value="4.0">4.0&nbsp;<?=$wa07?></option><option value="4.5">4.5&nbsp;<?=$wa07?></option><option value="5.0">5.0&nbsp;<?=$wa07?></option><option value="7.5">7.5&nbsp;<?=$wa07?></option><option value="10.0">10.0&nbsp;<?=$wa07?></option><option value="20.0">20.0&nbsp;<?=$wa07?></option>');
			} else if(unit=="un"){
				$("select#weight").html('<option><?=$k045?>...</option><option value="1.0">1&nbsp;<?=$wa26?></option><option value="2.0">2&nbsp;<?=$wa25?></option><option value="3.0">3&nbsp;<?=$wa25?></option><option value="4.0">4&nbsp;<?=$wa25?></option><option value="5.0">5&nbsp;<?=$wa25?></option><option value="6.0">6&nbsp;<?=$wa25?></option><option value="7.0">7&nbsp;<?=$wa25?></option><option value="8.0">8&nbsp;<?=$wa25?></option><option value="9.0">9&nbsp;<?=$wa25?></option><option value="10.0">10&nbsp;<?=$wa25?></option><option value="20.0">20&nbsp;<?=$wa25?></option><option value="50.0">50&nbsp;<?=$wa25?></option>');
			} else {
				//$("select#weight").html('<option><?=$k045?>...</option><option value="1.0">1&nbsp;<?=$wa26?></option><option value="2.0">2&nbsp;<?=$wa25?></option><option value="3.0">3&nbsp;<?=$wa25?></option><option value="4.0">4&nbsp;<?=$wa25?></option><option value="5.0">5&nbsp;<?=$wa25?></option><option value="6.0">6&nbsp;<?=$wa25?></option><option value="7.0">7&nbsp;<?=$wa25?></option><option value="8.0">8&nbsp;<?=$wa25?></option><option value="9.0">9&nbsp;<?=$wa25?></option><option value="10.0">10&nbsp;<?=$wa25?></option><option value="20.0">20&nbsp;<?=$wa25?></option><option value="50.0">50&nbsp;<?=$wa25?></option>');
				$("select#weight").html('<option><?=$k045?>...</option>');
			}
		});
    });
    jQuery("#forms").on('click', '#submit', function(e) {
      var valid = jQuery("#forms").validationEngine('validate');
      if (valid == true) {
      	//validated
      	e.preventDefault();
		var name = jQuery("input[name='name']").val();
		var un = jQuery("select[name='unit']").val();
		var weight = jQuery("select[name='weight']").val();
		var price = jQuery("input[name='price']").val();
        
        var datastr = 'name='+name+'&weight='+weight+'&unit='+un+'&price='+price;
        //console.log(datastr);
        send(datastr);
      } else {
      	e.preventDefault();
      }
    });
    function send(data) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/washlist_add.php",
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
