<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
$washmachinesid = array();
$sql="SELECT * FROM `washmachinesid` ORDER BY `id` ASC";
$result=$local->query($sql);
if($result === false) {
    trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
} else {
    if($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
		    $washmachinesid[] = $row;
		}
    }
}
if(!empty($washmachinesid)) {
    $x=1;
    $div_size = (12/count($washmachinesid));
    foreach($washmachinesid as $washmachine) {
	    $rfids = str_replace("rfid:","",get_clients_in_wash_now($washmachine['number']));
		$rfids = preg_replace("/\s+/","",$rfids);
		$clients = explode(":",$rfids);
		$c=0;
		echo "
            <div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-".$div_size."\">
                <div class=\"statistic-box statistic-filled-".$x."\">
                    <h2 style=\"margin-bottom:12px;\">".$k110." ".$washmachine['number']."</h2>";
                    if(!empty($rfids)){
                        echo "<div class=\"small\">";
						foreach($clients as $client) {
						    if(($client != "") && ($client != " ")) {
							    $client_name = get_card_client_name($client);
								$c++;
								if(($client_name != "") && ($client_name != " ")) {
								    echo "<span class=\"index-".$x." themed-tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$client."\">".$c.":&nbsp;".$client_name."</span><br/>";
							    } else {
								    echo "<span class=\"index-".$x." themed-tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" data-original-title=\"".$client."\">".$c.":&nbsp;".$client."</span><br/>";
							    }
						    }
						}
                        echo "</div>";
					} else {
					    //echo "<div class=\"small\">".$k201."</div>";
						echo "<div class=\"small\">0</div>";
					}
					echo "<i class=\"pe-ly-tumble-dry statistic_icon\"></i>
                </div>
			</div>";
		$x++;
    }
}
?>
