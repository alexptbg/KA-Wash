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
    $raspip = preg_replace('/\s+/','',get_raspi_addr());
    //$raspip = "localhost";
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
		<label class="col-sm-5 control-label"><?=$k122?> (<?=$k242?>):</label> 
		<div class="col-sm-7"> 
			<!--<input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="quantity" id="quantity" value="" />-->
			<input type="text" class="form-control validate[required,custom[number]]" name="quantity" id="quantity" value="" />
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
      	var pump = jQuery("input[name='pump']").val();
		//var quantity = jQuery("input[name='quantity']").val();
        var quant = jQuery("input[name='quantity']").val();
        var quantity = quant*1000;
        var datastr = 'id='+id+'&pump='+pump+'&quantity='+quantity;
        //console.log(datastr);
        send(datastr,pump,quantity);
      } else {
      	e.preventDefault();
      }
    });
    function send(data,pump,quantity) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/settings_detergents_plus.php",
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
                    //send update to controller
                    var datastr = 'z:'+pump+',q:'+quantity;
                    var ip = "<?php echo $raspip; ?>";
                    var socket = io.connect('http://'+ip+':3003');
                    socket.on('connected', function(){
                        console.log("Socket Connected");
                    });
                    socket.emit("cmd", datastr);
                    socket.on('sent',function(datax) {
                        console.log(datax);
                        socket.disconnect();
                    });
                    //reload
		            setTimeout(function(){
					    jQuery("#modal-n").modal("hide");
					    window.location.reload(true);
				    },1200);
				}
            },
            error: function(jqXhr,textStatus,errorThrown){
                console.log(errorThrown);
            }
        });
        return false;
    }
</script>
<?php else: ?>
<p><?php echo $k037; ?></p>
<?php endif; ?>
