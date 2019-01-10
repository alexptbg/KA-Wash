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
    $detergent = get_detergent($_GET['id']);
}
?>
<form id="forms" class="form-horizontal" method="post">
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k027?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required]" name="id" id="id" value="<?=$detergent['id']?>" readonly="readonly" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k113?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required]" name="pump" id="pump" value="<?=$detergent['pump']?>" readonly="readonly" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k101?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required]" name="inv" id="inv" value="<?=$detergent['inv']?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k102?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required]" name="name" id="name" value="<?=$detergent['name']?>" />
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k103?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required]" name="brand" id="brand" value="<?=$detergent['brand']?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k107?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required]" name="model" id="model" value="<?=$detergent['model']?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$kl28?>:</label> 
		<div class="col-sm-7"> 
		    <select class="form-control validate[required]" id="type" name="type">
				<option value="<?php echo $detergent['type']; ?>"><?php echo get_detergent_type($lang,$detergent['type']); ?></option>
				<option></option>
                <?php
                $sql="SELECT * FROM `washdetergentstypes` ORDER BY `id` ASC";
                $result=$local->query($sql);
                if($result === false) {
                    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
                } else {
                    if($result->num_rows > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
			                echo "<option value=\"".$row['type']."\">".$row['name_'.$lang]."</option>";
		                }
                    }
                }
                ?>
			</select>
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k120?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="calibration" id="calibration" value="<?=$detergent['calibration']?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k121?> (0%&nbsp;-&nbsp;100%):</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer],min[0],max[100]]" name="pwm" id="pwm" value="<?=$detergent['pwm']?>" /> 
		</div> 
	</div>
	<!--
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k122?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="quantity" id="quantity" value="<?=$detergent['quantity']?>" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$k123?>:</label> 
		<div class="col-sm-7"> 
			<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="total" id="total" value="<?=$detergent['total']?>" /> 
		</div> 
	</div>
	-->
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
      	var pump = jQuery("input[name='pump']").val();
		var inv = jQuery("input[name='inv']").val();
		var name = jQuery("input[name='name']").val();
		var brand = jQuery("input[name='brand']").val();
		var model = jQuery("input[name='model']").val();
		var type = jQuery("select[name='type']").val();
		var calibration = jQuery("input[name='calibration']").val();
		var pwm = jQuery("input[name='pwm']").val();
		//var quantity = jQuery("input[name='quantity']").val();
		//var total = jQuery("input[name='total']").val();
        
        //var datastr = 'id='+id+'&pump='+pump+'&inv='+inv+'&name='+name+'&brand='+brand+'&model='+model+'&type='+type+'&calibration='+calibration+'&pwm='+pwm+'&quantity='+quantity+'&total='+total;
        var datastr = 'id='+id+'&pump='+pump+'&inv='+inv+'&name='+name+'&brand='+brand+'&model='+model+'&type='+type+'&calibration='+calibration+'&pwm='+pwm;
        //console.log(datastr);
        send(datastr);
      } else {
      	e.preventDefault();
      }
    });
    function send(data) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/settings_detergents_edit.php",
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
