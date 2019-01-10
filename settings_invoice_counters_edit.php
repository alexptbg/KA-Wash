<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
//invoice
$invoice = array();
$sql="SELECT * FROM `counters` WHERE `id`='1' AND `name`='invoice'";
$result=$local->query($sql);
if($result === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
} else {
        if($result->num_rows==1) {
            $invoice = mysqli_fetch_assoc($result);
        }
}
//order
$order = array();
$sql="SELECT * FROM `counters` WHERE `id`='2' AND `name`='order'";
$result=$local->query($sql);
if($result === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
} else {
        if($result->num_rows==1) {
            $order = mysqli_fetch_assoc($result);
        }
}
?>
<?php if($user_settings['level'] >= 50): ?>
<form id="forms" class="form-horizontal" method="post">
	<div class="form-group">
        <label class="col-sm-12 control-label"><p class="text-danger fl"><strong><?=$k205?></strong></p></label>
    </div>
	<div class="form-group">
		<label class="col-sm-6 control-label"><?=$k206?>:</label> 
		<div class="col-sm-6"> 
            <input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="invoice_value" id="invoice_value" value="<?php echo $invoice['value']; ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-6 control-label"><?=$k207?>:</label> 
		<div class="col-sm-6"> 
            <input type="text" class="form-control validate[required]" name="invoice_antes" id="invoice_antes" value="<?php echo $invoice['antes']; ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-6 control-label"><?=$k208?>:</label> 
		<div class="col-sm-6"> 
		    <select class="form-control validate[required]" id="invoice_depois" name="invoice_depois">
				<option value="<?php echo $invoice['depois']; ?>"><?php echo $invoice['depois']; ?></option>
				<option></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
			</select>
		</div>
	</div>
	<div class="form-group">
        <label class="col-sm-6 control-label"><p class="text-danger fl"><strong><?=$k209?></strong></p></label>
		<div class="col-sm-6">
			<?php $inv = str_pad($invoice['value'],$invoice['depois'],"0",STR_PAD_LEFT);?>
            <h5 id="invoice_preview"><?php echo $invoice['antes'].$inv; ?></h5>
		</div>
    </div>
	<div class="line-modal-invoice"></div>
	<div class="form-group">
        <label class="col-sm-12 control-label"><p class="text-danger fl"><strong><?=$k204?></strong></p></label>
    </div>
	<div class="form-group">
		<label class="col-sm-6 control-label"><?=$k206?>:</label> 
		<div class="col-sm-6"> 
            <input type="text" class="form-control validate[required,custom[onlyNnumbers],custom[integer]]" name="order_value" id="order_value" value="<?php echo $order['value']; ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-6 control-label"><?=$k207?>:</label> 
		<div class="col-sm-6"> 
            <input type="text" class="form-control validate[required]" name="order_antes" id="order_antes" value="<?php echo $order['antes']; ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-6 control-label"><?=$k208?>:</label> 
		<div class="col-sm-6"> 
		    <select class="form-control validate[required]" id="order_depois" name="order_depois">
				<option value="<?php echo $order['depois']; ?>"><?php echo $order['depois']; ?></option>
				<option></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
		</div>
	</div>
	<div class="form-group">
        <label class="col-sm-6 control-label"><p class="text-danger fl"><strong><?=$k210?></strong></p></label>
		<div class="col-sm-6">
			<?php $ord = str_pad($order['value'],$order['depois'],"0",STR_PAD_LEFT);?>
            <h5 id="order_preview"><?php echo $order['antes'].$ord; ?></h5>
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
		//invoice
        $("input[name='invoice_value']").on('keyup', function() {
			var new_value = $("select#invoice_depois").val();
			var antes = jQuery("input[name='invoice_antes']").val();
			var inv_value = jQuery("input[name='invoice_value']").val();
            var t = inv_value.padStart(new_value, "0"); 
			$('h5#invoice_preview').text(antes+t);
        });
        $("input[name='invoice_antes']").on('keyup', function() {
			var new_value = $("select#invoice_depois").val();
			var antes = jQuery("input[name='invoice_antes']").val();
			var inv_value = jQuery("input[name='invoice_value']").val();
            var t = inv_value.padStart(new_value, "0"); 
			$('h5#invoice_preview').text(antes+t);
        });
		$("select#invoice_depois").change(function() {
			var new_value = jQuery("select#invoice_depois").val();
			var antes = jQuery("input[name='invoice_antes']").val();
			var inv_value = jQuery("input[name='invoice_value']").val();
            var t = inv_value.padStart(new_value, "0"); 
			$('h5#invoice_preview').text(antes+t);
		});
		//order
        $("input[name='order_value']").on('keyup', function() {
			var new_valueu = jQuery("select#order_depois").val();
			var antesu = jQuery("input[name='order_antes']").val();
			var order_value = jQuery("input[name='order_value']").val();
            var u = order_value.padStart(new_valueu, "0"); 
			$('h5#order_preview').text(antesu+u);	
		});
		$("input[name='order_antes']").on('keyup', function() {
			var new_valueu = jQuery("select#order_depois").val();
			var antesu = jQuery("input[name='order_antes']").val();
			var order_value = jQuery("input[name='order_value']").val();
            var u = order_value.padStart(new_valueu, "0"); 
			$('h5#order_preview').text(antesu+u);
		});
		$("select#order_depois").change(function() {
			var new_valueu = jQuery("select#order_depois").val();
			var antesu = jQuery("input[name='order_antes']").val();
			var order_value = jQuery("input[name='order_value']").val();
            var u = order_value.padStart(new_valueu, "0"); 
			$('h5#order_preview').text(antesu+u);
		});
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
      	var invoice_value = jQuery("input[name='invoice_value']").val();
      	var invoice_antes = jQuery("input[name='invoice_antes']").val();
        var invoice_depois = jQuery("select[name='invoice_depois']").val();

      	var order_value = jQuery("input[name='order_value']").val();
      	var order_antes = jQuery("input[name='order_antes']").val();
        var order_depois = jQuery("select[name='order_depois']").val();
        
		var confirm = jQuery("select#confirm").val();
        //build string data
        var datastr = 'invoice_value='+invoice_value+'&invoice_antes='+invoice_antes+'&invoice_depois='+invoice_depois+'&order_value='+order_value+'&order_antes='+order_antes+'&order_depois='+order_depois+'&confirm='+confirm;
        send(datastr);
      } else {
      	e.preventDefault();
      }
    });
    function send(data) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/settings_invoice_counters_edit.php",
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
