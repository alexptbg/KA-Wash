<?php
error_reporting(E_ALL);
define('start',TRUE);
include("inc/db.php");
include("inc/functions.php");
include("inc/config.php");
check_login($appname);
?>
<?php if((!empty($_GET)) && ($user_settings['level'] >= 50) ): ?>
<?php
if(!empty($_GET)) {
	$program = get_program_data($_GET['tableid'],$_GET['progid']);
}
?>
<form id="forms" class="form-horizontal" method="post">

                                    <div class="table-responsive">
                                        <table id="laundryprogram-<?=$program['id']?>" class="table table-bordered table-striped table-condensed">
                                            <thead>
                                                <tr>
											        <th><span class="colored" style="text-transform:uppercase;font-weight:900"><?=$program['name']?></span></th>
											        <th><?=$s020?>1</th>
											        <th><?=$s020?>2</th>
											        <th><?=$s020?>3</th>
											        <th><?=$s020?>4</th>
											        <th><?=$s020?>5</th>
											        <th><?=$s020?>6</th>
											        <th><?=$s020?>7</th>
											        <th><?=$s020?>8</th>
											        <th><?=$s021?></th>
											        <th><?=$s022?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="color:#FFFFFF;font-weight:700;"><?=$s019?>1</td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s1p1']?>" name="s1p1" id="s1p1" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s1p2']?>" name="s1p2" id="s1p2" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s1p3']?>" name="s1p3" id="s1p3" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s1p4']?>" name="s1p4" id="s1p4" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s1p5']?>" name="s1p5" id="s1p5" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s1p6']?>" name="s1p6" id="s1p6" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s1p7']?>" name="s1p7" id="s1p7" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s1p8']?>" name="s1p8" id="s1p8" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s1time']?>" name="s1time" id="s1time" /></td>
                                                    <td><input type="text" class="form-control colored" value="<?=$program['s1name']?>" name="s1name" id="s1name" /></td>
												</tr>
												
                                                <tr>
                                                    <td style="color:#FFFFFF;font-weight:700;"><?=$s019?>2</td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s2p1']?>" name="s2p1" id="s2p1" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s2p2']?>" name="s2p2" id="s2p2" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s2p3']?>" name="s2p3" id="s2p3" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s2p4']?>" name="s2p4" id="s2p4" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s2p5']?>" name="s2p5" id="s2p5" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s2p6']?>" name="s2p6" id="s2p6" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s2p7']?>" name="s2p7" id="s2p7" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s2p8']?>" name="s2p8" id="s2p8" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s2time']?>" name="s2time" id="s2time" /></td>
                                                    <td><input type="text" class="form-control colored" value="<?=$program['s2name']?>" name="s2name" id="s2name" /></td>
												</tr>
												
                                                <tr>
                                                    <td style="color:#FFFFFF;font-weight:700;"><?=$s019?>3</td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s3p1']?>" name="s3p1" id="s3p1" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s3p2']?>" name="s3p2" id="s3p2" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s3p3']?>" name="s3p3" id="s3p3" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s3p4']?>" name="s3p4" id="s3p4" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s3p5']?>" name="s3p5" id="s3p5" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s3p6']?>" name="s3p6" id="s3p6" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s3p7']?>" name="s3p7" id="s3p7" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s3p8']?>" name="s3p8" id="s3p8" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s3time']?>" name="s3time" id="s3time" /></td>
                                                    <td><input type="text" class="form-control colored" value="<?=$program['s3name']?>" name="s3name" id="s3name" /></td>
												</tr>
												
                                                <tr>
                                                    <td style="color:#FFFFFF;font-weight:700;"><?=$s019?>4</td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s4p1']?>" name="s4p1" id="s4p1" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s4p2']?>" name="s4p2" id="s4p2" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s4p3']?>" name="s4p3" id="s4p3" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s4p4']?>" name="s4p4" id="s4p4" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s4p5']?>" name="s4p5" id="s4p5" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s4p6']?>" name="s4p6" id="s4p6" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s4p7']?>" name="s4p7" id="s4p7" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s4p8']?>" name="s4p8" id="s4p8" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s4time']?>" name="s4time" id="s4time" /></td>
                                                    <td><input type="text" class="form-control colored" value="<?=$program['s4name']?>" name="s4name" id="s4name" /></td>
												</tr>
												
                                                <tr>
                                                    <td style="color:#FFFFFF;font-weight:700;"><?=$s019?>5</td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s5p1']?>" name="s5p1" id="s5p1" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s5p2']?>" name="s5p2" id="s5p2" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s5p3']?>" name="s5p3" id="s5p3" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s5p4']?>" name="s5p4" id="s5p4" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s5p5']?>" name="s5p5" id="s5p5" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s5p6']?>" name="s5p6" id="s5p6" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s5p7']?>" name="s5p7" id="s5p7" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s5p8']?>" name="s5p8" id="s5p8" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s5time']?>" name="s5time" id="s5time" /></td>
                                                    <td><input type="text" class="form-control colored" value="<?=$program['s5name']?>" name="s5name" id="s5name" /></td>
												</tr>
												
                                                <tr>
                                                    <td style="color:#FFFFFF;font-weight:700;"><?=$s019?>6</td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s6p1']?>" name="s6p1" id="s6p1" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s6p2']?>" name="s6p2" id="s6p2" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s6p3']?>" name="s6p3" id="s6p3" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s6p4']?>" name="s6p4" id="s6p4" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s6p5']?>" name="s6p5" id="s6p5" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s6p6']?>" name="s6p6" id="s6p6" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s6p7']?>" name="s6p7" id="s6p7" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s6p8']?>" name="s6p8" id="s6p8" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s6time']?>" name="s6time" id="s6time" /></td>
                                                    <td><input type="text" class="form-control colored" value="<?=$program['s6name']?>" name="s6name" id="s6name" /></td>
												</tr>
												
                                                <tr>
                                                    <td style="color:#FFFFFF;font-weight:700;"><?=$s019?>7</td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s7p1']?>" name="s7p1" id="s7p1" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s7p2']?>" name="s7p2" id="s7p2" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s7p3']?>" name="s7p3" id="s7p3" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s7p4']?>" name="s7p4" id="s7p4" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s7p5']?>" name="s7p5" id="s7p5" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s7p6']?>" name="s7p6" id="s7p6" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s7p7']?>" name="s7p7" id="s7p7" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s7p8']?>" name="s7p8" id="s7p8" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s7time']?>" name="s7time" id="s7time" /></td>
                                                    <td><input type="text" class="form-control colored" value="<?=$program['s7name']?>" name="s7name" id="s7name" /></td>
												</tr>
												
                                                <tr>
                                                    <td style="color:#FFFFFF;font-weight:700;"><?=$s019?>8</td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s8p1']?>" name="s8p1" id="s8p1" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s8p2']?>" name="s8p2" id="s8p2" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s8p3']?>" name="s8p3" id="s8p3" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s8p4']?>" name="s8p4" id="s8p4" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s8p5']?>" name="s8p5" id="s8p5" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s8p6']?>" name="s8p6" id="s8p6" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s8p7']?>" name="s8p7" id="s8p7" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s8p8']?>" name="s8p8" id="s8p8" /></td>
                                                    <td><input type="text" class="form-control colored validate[required,custom[onlyNnumbers],custom[integer]]" value="<?=$program['s8time']?>" name="s8time" id="s8time" /></td>
                                                    <td><input type="text" class="form-control colored" value="<?=$program['s8name']?>" name="s8name" id="s8name" /></td>
												</tr>
											</tbody>
										</table>
									</div>
	<div class="form-group"> 
	    <label class="col-sm-8 control-label"><?=$k030?>:</label> 
		<div class="col-sm-4"> 
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
	            <button type="submit" class="btn btn-danger" name="submit" id="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;<?=$kl41?></button>
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
      	var tableid = '<?=$_GET['tableid']?>';
      	var progid = '<?=$_GET['progid']?>';
      	var confirm = jQuery("select#confirm").val();
		var s1p1 = jQuery("input[name='s1p1']").val();
		var s1p2 = jQuery("input[name='s1p2']").val();
		var s1p3 = jQuery("input[name='s1p3']").val();
		var s1p4 = jQuery("input[name='s1p4']").val();
		var s1p5 = jQuery("input[name='s1p5']").val();
		var s1p6 = jQuery("input[name='s1p6']").val();
		var s1p7 = jQuery("input[name='s1p7']").val();
		var s1p8 = jQuery("input[name='s1p8']").val();
		var s1time = jQuery("input[name='s1time']").val();
		var s1name = jQuery("input[name='s1name']").val();
		var s2p1 = jQuery("input[name='s2p1']").val();
		var s2p2 = jQuery("input[name='s2p2']").val();
		var s2p3 = jQuery("input[name='s2p3']").val();
		var s2p4 = jQuery("input[name='s2p4']").val();
		var s2p5 = jQuery("input[name='s2p5']").val();
		var s2p6 = jQuery("input[name='s2p6']").val();
		var s2p7 = jQuery("input[name='s2p7']").val();
		var s2p8 = jQuery("input[name='s2p8']").val();
		var s2time = jQuery("input[name='s2time']").val();
		var s2name = jQuery("input[name='s2name']").val();
		var s3p1 = jQuery("input[name='s3p1']").val();
		var s3p2 = jQuery("input[name='s3p2']").val();
		var s3p3 = jQuery("input[name='s3p3']").val();
		var s3p4 = jQuery("input[name='s3p4']").val();
		var s3p5 = jQuery("input[name='s3p5']").val();
		var s3p6 = jQuery("input[name='s3p6']").val();
		var s3p7 = jQuery("input[name='s3p7']").val();
		var s3p8 = jQuery("input[name='s3p8']").val();
		var s3time = jQuery("input[name='s3time']").val();
		var s3name = jQuery("input[name='s3name']").val();
		var s4p1 = jQuery("input[name='s4p1']").val();
		var s4p2 = jQuery("input[name='s4p2']").val();
		var s4p3 = jQuery("input[name='s4p3']").val();
		var s4p4 = jQuery("input[name='s4p4']").val();
		var s4p5 = jQuery("input[name='s4p5']").val();
		var s4p6 = jQuery("input[name='s4p6']").val();
		var s4p7 = jQuery("input[name='s4p7']").val();
		var s4p8 = jQuery("input[name='s4p8']").val();
		var s4time = jQuery("input[name='s4time']").val();
		var s4name = jQuery("input[name='s4name']").val();
		var s5p1 = jQuery("input[name='s5p1']").val();
		var s5p2 = jQuery("input[name='s5p2']").val();
		var s5p3 = jQuery("input[name='s5p3']").val();
		var s5p4 = jQuery("input[name='s5p4']").val();
		var s5p5 = jQuery("input[name='s5p5']").val();
		var s5p6 = jQuery("input[name='s5p6']").val();
		var s5p7 = jQuery("input[name='s5p7']").val();
		var s5p8 = jQuery("input[name='s5p8']").val();
		var s5time = jQuery("input[name='s5time']").val();
		var s5name = jQuery("input[name='s5name']").val();
		var s6p1 = jQuery("input[name='s6p1']").val();
		var s6p2 = jQuery("input[name='s6p2']").val();
		var s6p3 = jQuery("input[name='s6p3']").val();
		var s6p4 = jQuery("input[name='s6p4']").val();
		var s6p5 = jQuery("input[name='s6p5']").val();
		var s6p6 = jQuery("input[name='s6p6']").val();
		var s6p7 = jQuery("input[name='s6p7']").val();
		var s6p8 = jQuery("input[name='s6p8']").val();
		var s6time = jQuery("input[name='s6time']").val();
		var s6name = jQuery("input[name='s6name']").val();
		var s7p1 = jQuery("input[name='s7p1']").val();
		var s7p2 = jQuery("input[name='s7p2']").val();
		var s7p3 = jQuery("input[name='s7p3']").val();
		var s7p4 = jQuery("input[name='s7p4']").val();
		var s7p5 = jQuery("input[name='s7p5']").val();
		var s7p6 = jQuery("input[name='s7p6']").val();
		var s7p7 = jQuery("input[name='s7p7']").val();
		var s7p8 = jQuery("input[name='s7p8']").val();
		var s7time = jQuery("input[name='s7time']").val();
		var s7name = jQuery("input[name='s7name']").val();
		var s8p1 = jQuery("input[name='s8p1']").val();
		var s8p2 = jQuery("input[name='s8p2']").val();
		var s8p3 = jQuery("input[name='s8p3']").val();
		var s8p4 = jQuery("input[name='s8p4']").val();
		var s8p5 = jQuery("input[name='s8p5']").val();
		var s8p6 = jQuery("input[name='s8p6']").val();
		var s8p7 = jQuery("input[name='s8p7']").val();
		var s8p8 = jQuery("input[name='s8p8']").val();
		var s8time = jQuery("input[name='s8time']").val();
		var s8name = jQuery("input[name='s8name']").val();
        //cronstruct big string
        var datastr = 'progid='+progid+'&tableid='+tableid+'&confirm='+confirm;
        datastr += '&s1p1='+s1p1+'&s1p2='+s1p2+'&s1p3='+s1p3+'&s1p4='+s1p4+'&s1p5='+s1p5+'&s1p6='+s1p6+'&s1p7='+s1p7+'&s1p8='+s1p8+'&s1time='+s1time+'&s1name='+s1name;
        datastr += '&s2p1='+s2p1+'&s2p2='+s2p2+'&s2p3='+s2p3+'&s2p4='+s2p4+'&s2p5='+s2p5+'&s2p6='+s2p6+'&s2p7='+s2p7+'&s2p8='+s2p8+'&s2time='+s2time+'&s2name='+s2name;
        datastr += '&s3p1='+s3p1+'&s3p2='+s3p2+'&s3p3='+s3p3+'&s3p4='+s3p4+'&s3p5='+s3p5+'&s3p6='+s3p6+'&s3p7='+s3p7+'&s3p8='+s3p8+'&s3time='+s3time+'&s3name='+s3name;
        datastr += '&s4p1='+s4p1+'&s4p2='+s4p2+'&s4p3='+s4p3+'&s4p4='+s4p4+'&s4p5='+s4p5+'&s4p6='+s4p6+'&s4p7='+s4p7+'&s4p8='+s4p8+'&s4time='+s4time+'&s4name='+s4name;
        datastr += '&s5p1='+s5p1+'&s5p2='+s5p2+'&s5p3='+s5p3+'&s5p4='+s5p4+'&s5p5='+s5p5+'&s5p6='+s5p6+'&s5p7='+s5p7+'&s5p8='+s5p8+'&s5time='+s5time+'&s5name='+s5name;
        datastr += '&s6p1='+s6p1+'&s6p2='+s6p2+'&s6p3='+s6p3+'&s6p4='+s6p4+'&s6p5='+s6p5+'&s6p6='+s6p6+'&s6p7='+s6p7+'&s6p8='+s6p8+'&s6time='+s6time+'&s6name='+s6name;
        datastr += '&s7p1='+s7p1+'&s7p2='+s7p2+'&s7p3='+s7p3+'&s7p4='+s7p4+'&s7p5='+s7p5+'&s7p6='+s7p6+'&s7p7='+s7p7+'&s7p8='+s7p8+'&s7time='+s7time+'&s7name='+s7name;
        datastr += '&s8p1='+s8p1+'&s8p2='+s8p2+'&s8p3='+s8p3+'&s8p4='+s8p4+'&s8p5='+s8p5+'&s8p6='+s8p6+'&s8p7='+s8p7+'&s8p8='+s8p8+'&s8time='+s8time+'&s8name='+s8name;
        //console.log(datastr);
        send(datastr);
      } else {
      	e.preventDefault();
      }
    });
    function send(datastr) {
        jQuery.ajax({
            type: "POST",
            url: "ajax/settings_laundry_programs_edit.php",
            data: datastr,
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
