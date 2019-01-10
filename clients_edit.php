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
    $client = get_client($_GET['id']);
}
?>
<form id="forms" class="form-horizontal" method="post">
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$k027?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" name="id" id="id" value="<?php echo $client['id']; ?>" readonly="readonly" /> 
		</div> 
	</div>
    <div class="form-group">
		<label class="col-sm-4 control-label"><?=$kl18?>:</label> 
        <div class="col-sm-8">
		    <select class="form-control validate[required]" id="type" name="type">
				<option value="<?=$client['type']?>">
				    <?php
				    if ($client['type'] == "company") { echo $kl20; }
				    if ($client['type'] == "person") { echo $kl19; }
				    ?>
				</option>
				<option></option>
				<option value="company"><?=$kl20?></option>
				<option value="person"><?=$kl19?></option>
			</select>
        </div>
    </div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$k058?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control" value="<?php echo $client['number']; ?>" name="number" id="number" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl06?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" value="<?php echo $client['name']; ?>" name="name" id="name" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl09?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" value="<?php echo $client['phone']; ?>" name="phone" id="phone" /> 
		</div> 
	</div>	
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl10?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control" value="<?php echo $client['email']; ?>" name="email" id="email" /> 
		</div> 
	</div>
	<div class="form-group"> 
	    <label class="col-sm-4 control-label"><?=$kl11?>:</label> 
		<div class="col-sm-8"> 
		    <select class="form-control validate[required]" id="region" name="region">
				<option value="<?=$client['region']?>"><?php echo get_oblast($lang,$client['region']); ?></option>
				<option></option>
                <?php
                $sql="SELECT * FROM `oblasti` ORDER BY `oblast_id` ASC";
                $result=$local->query($sql);
                if($result === false) {
                    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
                } else {
                    if($result->num_rows > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
			                echo "<option value=\"".$row['oblast_id']."\">".$row['oblast_name_bg']."</option>";
		                }
                    }
                }
                ?>
			</select>
		</div> 
	</div>
	<div class="form-group"> 
	    <label class="col-sm-4 control-label"><?=$kl12?>:</label> 
		<div class="col-sm-8"> 
		    <select class="form-control validate[required]" id="municipal" name="municipal">
				<option value="<?=$client['municipal']?>"><?php echo get_obshtina($lang,$client['municipal']); ?></option>
				<option></option>
                <?php
                $sql="SELECT * FROM `obshtini` WHERE `obshtina_oblast`='".$client['region']."' ORDER BY `obshtina_id` ASC";
                $result=$local->query($sql);
                if($result === false) {
                    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
                } else {
                    if($result->num_rows > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
			                echo "<option value=\"".$row['obshtina_id']."\">".$row['obshtina_name_'.$lang]."</option>";
		                }
                    }
                }
                ?>
			</select>
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl14?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" value="<?php echo $client['grad_celo']; ?>" name="grad_celo" id="grad_celo" /> 
		</div> 
	</div>
	<div class="form-group"> 
		<label class="col-sm-4 control-label"><?=$kl07?>:</label> 
		<div class="col-sm-8"> 
			<input type="text" class="form-control validate[required]" value="<?php echo stripslashes(htmlentities($client['address'])); ?>" name="address" id="address" /> 
		</div> 
	</div>
	
    <div id="dynamic"></div>

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

<script type="text/javascript">
    $(function () {
		var type = "<?=$client['type']?>";
        if(jQuery().validationEngine) {
            $("#forms").validationEngine({promptPosition : "bottomLeft:10"});;
        }
        $("select#region").on("change",function() {
			datastr = { 'lang':'<?=$lang?>', 'oblast_id':this.value };
			//console.log(datastr);
			$("select#municipal").html('<option><?=$k046?>...</option>');
            jQuery.ajax({
                type: "POST",
                url: "ajax/obshtini.php",
                data: datastr,
                success: function(data){
				    //console.log(data);
                    $("select#municipal").html(data);
                },
                error: function(jqXhr,textStatus,errorThrown){
                    console.log(errorThrown);
                },
            });
        });
        if(type == "company") {
			$("#dynamic").html('<div class="form-group"><label class="col-sm-4 control-label">&nbsp;</label><div class="col-sm-8"><span class="text-info"><strong><?=$kl23?></strong></span></div></div><div class="form-group"><label class="col-sm-4 control-label"><?=$kl15?>:</label><div class="col-sm-8"><input type="text" class="form-control validate[required]" value="<?=$client['company_name']?>" name="company_name" id="company_name" /></div></div><div class="form-group"><label class="col-sm-4 control-label"><?=$kl22?>:</label><div class="col-sm-8"><input type="text" class="form-control validate[required]" value="<?=$client['mol']?>" name="mol" id="mol" /></div></div><div class="form-group"> <label class="col-sm-4 control-label"><?=$kl17?>:</label><div class="col-sm-8"><input type="text" class="form-control validate[required]" value="<?=$client['ddc']?>" name="ddc" id="ddc" /></div></div><div class="form-group"><label class="col-sm-4 control-label"><?=$kl16?>:</label><div class="col-sm-8"><input type="text" class="form-control validate[required]" value="<?=$client['eik']?>" name="eik" id="eik" /></div></div>');
		} else if (type == "person") {
			$("#dynamic").html('<div class="form-group"><label class="col-sm-4 control-label"><?=$kl21?>:</label><div class="col-sm-8"><input type="text" class="form-control validate[required]" value="<?=$client['egn']?>" name="egn" id="egn" /></div></div>');
		} else {
			$("#dynamic").html("");
		}
        $("select#type").on("change",function() {
            if(this.value == "company") {
				$("#dynamic").html('<div class="form-group"><label class="col-sm-4 control-label">&nbsp;</label><div class="col-sm-8"><span class="text-info"><strong><?=$kl23?></strong></span></div></div><div class="form-group"><label class="col-sm-4 control-label"><?=$kl15?>:</label><div class="col-sm-8"><input type="text" class="form-control validate[required]" value="<?=$client['company_name']?>" name="company_name" id="company_name" /></div></div><div class="form-group"><label class="col-sm-4 control-label"><?=$kl22?>:</label><div class="col-sm-8"><input type="text" class="form-control validate[required]" value="<?=$client['mol']?>" name="mol" id="mol" /></div></div><div class="form-group"> <label class="col-sm-4 control-label"><?=$kl17?>:</label><div class="col-sm-8"><input type="text" class="form-control validate[required]" value="<?=$client['ddc']?>" name="ddc" id="ddc" /></div></div><div class="form-group"><label class="col-sm-4 control-label"><?=$kl16?>:</label><div class="col-sm-8"><input type="text" class="form-control validate[required]" value="<?=$client['eik']?>" name="eik" id="eik" /></div></div>');
			} else if (this.value == "person") {
				$("#dynamic").html('<div class="form-group"><label class="col-sm-4 control-label"><?=$kl21?>:</label><div class="col-sm-8"><input type="text" class="form-control validate[required]" value="<?=$client['egn']?>" name="egn" id="egn" /></div></div>');
			} else {
				$("#dynamic").html("");
			}
        });
    });
    jQuery("#forms").on('click', '#submit', function(e) {
      var valid = jQuery("#forms").validationEngine('validate');
      if (valid == true) {
      	//validated
      	e.preventDefault();
      	var id = jQuery("input[name='id']").val();
      	var type = jQuery("select[name='type']").val();
      	var number = jQuery("input[name='number']").val();
		var name = jQuery("input[name='name']").val();
		var phone = jQuery("input[name='phone']").val();
		var email = jQuery("input[name='email']").val();
		var region = jQuery("select[name='region']").val();
		var municipal = jQuery("select[name='municipal']").val();
		var grad_celo = jQuery("input[name='grad_celo']").val();
		var address = jQuery("input[name='address']").val();
        if(type == "company") {
      	    var company_name = jQuery("input[name='company_name']").val();
		    var mol = jQuery("input[name='mol']").val();
		    var ddc = jQuery("input[name='ddc']").val();
		    var eik = jQuery("input[name='eik']").val();
		    //build string data
            var datastr = 'id='+id+'&type='+type+'&number='+number+'&name='+name+'&phone='+phone+'&email='+email+'&region='+region+'&municipal='+municipal+'&grad_celo='+grad_celo+'&address='+addslashes(address)+'&company_name='+company_name+'&mol='+mol+'&ddc='+ddc+'&eik='+eik;
		}
        if(type == "person") {
			var egn = jQuery("input[name='egn']").val();
		    //build string data
            var datastr = 'id='+id+'&type='+type+'&number='+number+'&name='+name+'&phone='+phone+'&email='+email+'&region='+region+'&municipal='+municipal+'&grad_celo='+grad_celo+'&address='+addslashes(address)+'&egn='+egn;
		}
        //console.log(datastr);
        send(datastr);
      } else {
      	e.preventDefault();
      }
    });
    function send(data) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/clients_edit.php",
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
