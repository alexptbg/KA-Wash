<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
?>
<?php if((!empty($_GET)) && ($user_settings['level'] >= 20) ): ?>
<?php
if(!empty($_GET)) {
    $washmachine = get_washmachine($_GET['id']);
}
?>
<form id="forms" class="form-horizontal" method="post">
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k027?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required]" name="id" id="id" value="<?=$washmachine['id']?>" readonly="readonly" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k057?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="number" id="number" value="<?=$washmachine['number']?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k101?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required]" name="inv" id="inv" value="<?=$washmachine['inv']?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k102?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required]" name="name" id="name" value="<?=$washmachine['name']?>" />
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k103?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required]" name="brand" id="brand" value="<?=$washmachine['brand']?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k107?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required]" name="model" id="model" value="<?=$washmachine['model']?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$wa05?> (<?=$wa07?>):</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="kg" id="kg" value="<?=$washmachine['kg']?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k118?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="water_before" id="water_before" value="<?=$washmachine['water_before']?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k119?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="water_after" id="water_after" value="<?=$washmachine['water_after']?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k104?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required]" name="place" id="place" value="<?=$washmachine['place']?>" /> 
		</div> 
	</div>

	<div class="line-modal"></div>
	<div class="form-group">
	    <div class="col-sm-12">
			<div class="fr">
	            <button data-dismiss="modal" class="btn btn-default"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;<?=$k020?></button>
	            <button type="submit" class="btn btn-warning" name="submit" id="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;<?=$kl41?></button>
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
            $("#forms").validationEngine({promptPosition : "bottomLeft:10" });;
        }
    });
    jQuery("#forms").on('click', '#submit', function(e) {
      var valid = jQuery("#forms").validationEngine('validate');
      if (valid == true) {
      	//validated
      	e.preventDefault();
      	var id = jQuery("input[name='id']").val();
      	var number = jQuery("input[name='number']").val();
		var inv = jQuery("input[name='inv']").val();
		var name = jQuery("input[name='name']").val();
		var brand = jQuery("input[name='brand']").val();
		var model = jQuery("input[name='model']").val();
		var kg = jQuery("input[name='kg']").val();
		var water_before = jQuery("input[name='water_before']").val();
		var water_after = jQuery("input[name='water_after']").val();
		var place = jQuery("input[name='place']").val();

        var datastr = 'id='+id+'&number='+number+'&inv='+inv+'&name='+name+'&brand='+brand+'&model='+model+'&kg='+kg+'&water_before='+water_before+'&water_after='+water_after+'&place='+place;
        //console.log(datastr);
        send(datastr);
      } else {
      	e.preventDefault();
      }
    });
    function send(data) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/settings_washing_machines_edit.php",
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
