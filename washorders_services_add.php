<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
if (!empty($_GET)) {
    $order_id = $_GET['order_id'];
}
?>
<form id="formsx" class="form-horizontal" method="post">
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$k133?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="order_id" id="order_id" value="<?php echo $order_id; ?>" readonly="readonly" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$k135?>:</label> 
		<div class="col-sm-8"> 
		    <select class="form-control validate[required]" id="services" name="services"> 
				<option></option>
			</select>
		</div> 
	</div>
	<div class="form-group"> 
	    <label class="col-sm-4 control-label"><?=$wa28?>:</label>
		<div class="col-sm-2"> 
		    <select class="form-control validate[required]" id="unit" name="unit">
				<option></option>
				<option value="kg"><?=$wa07?></option>
				<option value="un"><?=$wa27?></option>
			</select>
		</div> 
		<div class="col-sm-3"> 
		    <input type="text" class="form-control" name="teglo" id="teglo" /> 
		</div>
		<div class="col-sm-3">
		    <button class="btn btn-success btn-small" id="ask"><i class="fa fa-question-circle" aria-hidden="true"></i></button>
		    <button class="btn btn-pink btn-small" id="plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
		    <button class="btn btn-danger btn-small fr" id="tara"><i class="fa fa-text-height" aria-hidden="true"></i></button>
		</div>
	</div>
	
    <div class="form-group">
		<div id="calc"></div>
	</div>
	
    <div class="form-group">
		<label class="col-sm-4 control-label"><?=$k181?>:</label> 
	    <div class="col-sm-8">
			<span id="total"><input type="text" class="form-control validate[required,custom[number]]" name="quantity" id="quantity" value="0" readonly="readonly" /></span>
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
<!-- socket.io -->
<script type="text/javascript" src="assets/dist/js/socket.io.js"></script>
<script type="text/javascript">
    $(function () {
		var socket = io.connect('http://127.0.0.1:3001');
    	//init
        $(function() {
            socket.on('connected', function(){
                console.log("Socket Connected");
            });
            socket.on('disconnect', function(){
                console.log("Socket Disconnected");
            });
            socket.on('serial', function(data){
                //console.log(data);
            });
            socket.on('data', function (data) {
                //console.log(data);
                rework(data);
			});
            $("button#tara").click(function(x) {
                x.preventDefault();
                console.log("Requesting tara reset");
                socket.emit("tara", { z: "5" });
            });
        });//function end
		$("button#ask").hide("fast");
		$("button#plus").hide("fast");
		$("button#tara").hide("fast");
		$("input#teglo").prop('readonly', true);
		$("input#teglo").val("");
		var teglo = 0;
		var quantity = 0;
		var c = 0;
		var div = "";
		$("span#results").val();
        if(jQuery().validationEngine) {
            $("#formsx").validationEngine({promptPosition : "bottomLeft:10", showArrowOnRadioAndCheckbox: true});;
        }
        jQuery.ajax({
            type: "POST",
            url: "ajax/washorders_services.php",
            data: { 'lang':'<?php echo $lang;?>'},
            success: function(data){
			    //console.log(data);
                $("select#services").html(data);
            },
            error: function(jqXhr,textStatus,errorThrown){
                console.log(errorThrown);
            },
        });
        $("button#ask").click(function(x) {
            x.preventDefault();
            console.log("Requesting weight");
            socket.emit("ask", { x: "6" });
        });
        $("button#plus").click(function(x) {
            x.preventDefault();
            c++;
            var plus = parseFloat(jQuery("input[name='teglo']").val()) || 0; // get value of field
            //div = '<input type="text" class="form-control validate[required] txt" name="sum" id="sum" value="'+plus+'" readonly="readonly" />';
            div = '<label class="col-sm-4 control-label">'+c+':</label>'+
	              '<div class="col-sm-8"><input type="text" class="form-control validate[required,custom[number]] txt" name="sum" id="sum" value="'+plus+'" readonly="readonly" /></div>';
            $("div#calc").append(div);
            $("input#teglo").val("");
            calculateSum();
        });
        if(!$("input#teglo").val()) {
            $("button#plus").attr("disabled",true);
        } else {
	        $("button#plus").removeAttr("disabled");	
	    }
	    /*
	    $("input#teglo").on('keyup', function() {
	        jQuery("#formsx").validationEngine('validate');
	    });
	    */
        $("select#unit").on("change",function() {
			var unit = jQuery("select[name='unit']").val();
			if(unit=="kg"){
				c = 0;
				$("input#teglo").val("");
				//$("input#teglo").prop('readonly', true);
				//without kantara
				$("input#teglo").prop('readonly', false);
				$("#quantity").val("");
				$("button#plus").attr("disabled",true);
                $("button#ask").show("fast");
                $("button#plus").show("fast");
                $("button#tara").show("fast");
                //without kantara
                $("input[name='teglo']").keyup(function() {
					$("button#plus").removeAttr("disabled");
					var total = $("input[name='teglo']").val();
                    $("#quantity").val(total);
                });
			} else if(unit=="un"){
				c = 0;
				$("input#teglo").prop('readonly', false);
				$("input#teglo").val("");
				$("div#calc").html("");
				$("#quantity").val("");
                $("input[name='teglo']").keyup(function() {
					var total = $("input[name='teglo']").val();
                    $("#quantity").val(total);
                });
				$("button#ask").hide("fast");
				$("button#plus").hide("fast");
				$("button#tara").hide("fast");
			} else {
				c = 0;
                $("input#teglo").prop('readonly', true);
                $("input#teglo").val("");
                $("#quantity").val("");
                $("div#calc").html("");
                $("button#ask").hide("fast");
                $("button#plus").hide("fast");
                $("button#tara").hide("fast");
			}
		});
    });
    jQuery("#formsx").on('click', '#submit', function(e) {
      var valid = jQuery("#formsx").validationEngine('validate');
      if (valid == true) {
      	//validated
      	e.preventDefault();
		var order_id = jQuery("input[name='order_id']").val();
		var services = jQuery("select[name='services']").val();
		var unit = jQuery("select[name='unit']").val();
		var quantity = jQuery("input[name='quantity']").val();
        
        var datastr = 'order_id='+order_id+'&order_service='+services+'&order_unit='+unit+'&order_quantity='+quantity;
        //console.log(datastr);
        send(datastr);
      } else {
      	e.preventDefault();
      }
    });
    function send(data) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/washorders_services_add.php",
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
                    jQuery("#formsx").hide();
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
        function rework(data) {
			$("input#teglo").val("");
            var str = data;
            var chunks = [];
            var chunkSize = 2;
            while (str) {
                if (str.length < chunkSize) {
                    chunks.push(str);
                    break;
                } else {
                    chunks.push(str.substr(0, chunkSize));
                    str = str.substr(chunkSize);
                }
            }
            //console.log(chunks); // chunks == 12,34,56,78,9
            if ( (chunks[0]==55) && (chunks[1]==55) && (chunks[2]==55) && (chunks[3]==55) && (chunks[4]==55) ) {
                //var frame = "TARA";
                console.log("TARA RESET OK");
                console.log(chunks);
                $("input#teglo").val("TARA OK");
            } else if ( (chunks[0]==77) && (chunks[1]==77) && (chunks[2]==77) && (chunks[3]==77) && (chunks[4]==77) ) {
				//var frame = "TERR";
				console.log("TARA RESET ERROR");
				console.log(chunks);
				$("input#teglo").val("TARA ERROR");
		    } else {
				//var frame = "ASK";
                console.log(chunks);
                var check;
                var w_h = hexToDec(chunks[0]);
                var w_m = hexToDec(chunks[1]);
                var w_l = hexToDec(chunks[2]);
                var p10 = hexToDec(chunks[3]);
                var w_p = 0;
                if (p10 == 0) { w_p = 1; }
                if (p10 == 1) { w_p = 10; }
                if (p10 == 2) { w_p = 100; }
                if (p10 == 3) { w_p = 1000; }
                var t = (w_h*65536+w_m*256+w_l)*w_p;
                $("input#teglo").val(t/1000);
                $("button#plus").removeAttr("disabled");
			}
		}
        function hexToDec(hex) {
            var result = 0, digitValue;
            hex = hex.toLowerCase();
            for (var i = 0; i < hex.length; i++) {
                digitValue = '0123456789abcdefgh'.indexOf(hex[i]);
                result = result * 16 + digitValue;
            }
            return result;
        }
	    function calculateSum() {
		    var sum = 0;
		    //iterate through each textboxes and add the values
		    $(".txt").each(function() {
			    //add only if the value is number
			    if(!isNaN(this.value) && this.value.length!=0) {
				    sum += parseFloat(this.value);
			    }
		    });
		    $("#quantity").val(sum.toFixed(2));
		    $("button#plus").attr("disabled",true);
	    }
</script>
