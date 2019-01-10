<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
check_login($appname);
if((!empty($_POST)) && ($user_settings['level'] >= 10)) {
	$card = $_POST['card'];
    //continue
	if ( (!empty($card)) ) {
        $client = get_card_data($card);
        if(!empty($client)) {
            $data = "
                                            <div class=\"table-responsive\">
                                                <table class=\"table table-bordered\">
                                                    <thead>
                                                        <tr>
                                                            <th colspan=\"2\" class=\"tac\">".$k096."</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class=\"tar\">".$kl18.":</td>
                                                            <td>";
                                                            if ($client['type'] == "company") { $data .= $kl20; }
				                                            if ($client['type'] == "person") { $data .= $kl19; }
            $data .= "
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class=\"tar\">".$k058.":</td>
                                                            <td>".$client['number']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td class=\"tar\">".$kl06.":</td>
                                                            <td>".$client['name']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td class=\"tar\">".$kl09.":</td>
                                                            <td>".$client['phone']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td class=\"tar\">".$kl10.":</td>
                                                            <td>".$client['email']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td class=\"tar\">".$kl11.":</td>
                                                            <td>".get_oblast($lang,$client['region'])."</td>
                                                        </tr>
                                                        <tr>
                                                            <td class=\"tar\">".$kl12.":</td>
                                                            <td>".get_obshtina($lang,$client['municipal'])."</td>
                                                        </tr>
                                                        <tr>
                                                            <td class=\"tar\">".$kl14.":</td>
                                                            <td>".$client['grad_celo']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td class=\"tar\">".$kl07.":</td>
                                                            <td>".stripslashes(htmlentities($client['address']))."</td>
                                                        </tr>";
                                                        if ($client['type'] == "company") {
														    $data .= "
														<tr>
                                                            <td class=\"tar\">".$kl15.":</td>
                                                            <td>".$client['company_name']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td class=\"tar\">".$kl22.":</td>
                                                            <td>".$client['mol']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td class=\"tar\">".$kl16.":</td>
                                                            <td>".$client['eik']."</td>
                                                        </tr>
                                                        <tr>
                                                            <td class=\"tar\">".$kl17.":</td>
                                                            <td>".$client['ddc']."</td>
														</tr>
														    ";	
														}
														if ($client['type'] == "person") {
														    $data .= "
                                                        <tr>
                                                            <td class=\"tar\">".$kl21.":</td>
                                                            <td>".$client['egn']."</td>
														</tr>
														    ";	
														}                                  
             $data .= "
										            </tbody>
										        </table>
										        <div class=\"col-sm-12\">
										            <a href=\"washorders_by_client.php?id=".$client['id']."&card=".$client['card']."\" class=\"btn btn-primary w-md m-t-5 m-b-5\"><i class=\"fa fa-history\" aria-hidden=\"true\"></i>&nbsp;".$k097."</a>
										            <a href=\"washorders_add.php?id=".$client['id']."&card=".$client['card']."\" class=\"btn btn-success w-md m-t-5 m-b-5\"><i class=\"fa fa-plus themed-tooltip\" aria-hidden=\"true\"></i>&nbsp;".$k098."</a>";
										            if ($user_settings['level'] >= 50) {
													    $data .= "
										            <a class=\"btn btn-danger w-md m-t-5 m-b-5 fr\" id=\"del\" href=\"clients_clear_card.php?id=".$client['id']."\" data-remote=\"true\" data-toggle=\"modal\" data-target=\"#modal-n\" data-backdrop=\"static\" data-tag=\"".$k124."\" data-class=\"modal-danger\"><i class=\"fa fa-trash themed-tooltip\" aria-hidden=\"true\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k124."\"></i>&nbsp;".$k124."</a>";
												    } else {
														$data .= "
													<button type=\"button\" class=\"btn btn-danger w-md m-t-5 m-b-5 themed-tooltip fr\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$k124."\" disabled=\"disabled\"><i class=\"fa fa-trash themed-tooltip\" aria-hidden=\"true\"></i>&nbsp;".$k124."</button>";
													}
	        $data .= "
										        </div>
										    </div>
            ";
            echo $data;
		} else {
		    //echo "NOOK";
		    $data = "
                                            <div class=\"alert alert-warning m-t-20\" role=\"alert\">
                                                <strong>".$k094."!</strong>&nbsp;".$k095."
                                            </div>";
                                            if ($user_settings['level'] >= 20) {
                                        	$data .= "<a class=\"btn btn-primary w-md m-t-5 m-b-5\" id=\"add\" href=\"clients_add_with_card.php?card=".$card."\" data-remote=\"true\" data-toggle=\"modal\" data-target=\"#modal-n\" data-backdrop=\"static\" data-tag=\"".$kl03."\" data-class=\"modal-primary\"><i class=\"fa fa-plus themed-tooltip\" aria-hidden=\"true\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$kl03."\"></i>&nbsp;".$kl60."</a>";
                                        	} else {
                                        	$data .= "<button type=\"button\" class=\"btn btn-primary w-md m-t-5 m-b-5 themed-tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$kl03."\" disabled=\"disabled\"><i class=\"fa fa-plus themed-tooltip\" aria-hidden=\"true\"></i>&nbsp;".$kl60."</button>";
										    }
		    echo $data;	
		}
	} else {
	    echo $k025." (2)";
	}
} else {
	echo "<p>".$k037."</p>";
}
?>
