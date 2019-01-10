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
$logo_path=$_SERVER['DOCUMENT_ROOT']."/".$config['base_dir']."/logo/".$firma['logo'];
if (file_exists($logo_path)) {
    $logo_file="logo/".$firma['logo'];
} else {
    $logo_file="assets/dist/img/logo-not-".$lang.".png";
}
?>
<?php if($user_settings['level'] >= 50): ?>

<?php if(isset($_FILES['image'])): ?>

<?php else: ?>
<form id="forms" class="form-horizontal" method="post" enctype="multipart/form-data">

	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$s005?>:</label> 
		<div class="col-sm-7"> 
		  <div id="image_preview">
			<img id="previewing" src="<?=$logo_file?>" alt="logo" class="mycompany-logo-edit" />
		  </div>
		</div> 
	</div>
	
	<div class="form-group"> 
		<label class="col-sm-5 control-label"><?=$s006?>:</label> 
		<div class="col-sm-7"> 
			<input type="file" name="image" id="image" required />
		</div> 
	</div>

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
        var ok = false;
        $("button#submit").attr("disabled",true);
        $("#image").change(function() {
            $("#error").hide();
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg","image/png","image/jpg"];
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))) {
                $("#previewing").attr('src','<?php echo $config['base_url']."/assets/dist/img/logo-not-".$lang.".png";?>');
                $("button#submit").attr("disabled",true);
                $("#image").css("color","#ff1a1a");
			    //$("span#err").html("<strong><?=$k026?> #IMG-LOGO</strong> -> <?=$s013?>");
			    $("span#err").html("<strong><?=$k026?> "+data[0].errnr+"</strong> -> "+data[0].error);
                $("#error").show();
                ok = false;
                return false;
            } else {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
                ok = true;
                if($("select#confirm").val().length > 0 && $("select#confirm").val() == "YES" && ok==true) {
		            $("button#submit").removeAttr("disabled");
                }
            }
        });
        $("select#confirm").change(function() {
            if($("select#confirm").val().length > 0 && $("select#confirm").val() == "YES" && ok==true) {
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
        var formData = new FormData();
        formData.append('image', $('input[type=file]')[0].files[0]);
        $.ajax({
            url: "ajax/settings_company_logo_edit.php",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data) {
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
            }
        });
        }
    });
    function imageIsLoaded(e) {
        $("#image").css("color","#00ff00");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
    }
</script>
<?php endif; ?>
<?php else: ?>
<p><?php echo $k037; ?></p>
<?php endif; ?>
