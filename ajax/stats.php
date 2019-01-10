<?php
error_reporting(E_ALL);
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
if(!empty($_GET)) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $what = $_GET['what'];
    //print_r($_GET);
    $data = array();
    $data_exists = FALSE;
    $data_title = "";
    //$local = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    //get company data
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
    //$local->set_charset("utf8");
    //what=1 // wash mashines count step 1 by day
    //just test
    //$start    = (new DateTime($start_date))->modify('first day of this month');
    //$end      = (new DateTime($end_date))->modify('first day of next month');
    //$interval = DateInterval::createFromDateString('1 month');
    //$period   = new DatePeriod($start,$interval,$end);
    //now i know how much months to split data
    /*
    foreach ($period as $dt) {
        //echo $dt->format("Y-m") . "<br>\n";
        $new_interval = DateInterval::createFromDateString('1 day');
        $new_start = $dt->format("Y-m-d");
        echo $new_start."-".$new_end."<br/>";
    }
    */
    if($what=="1"){
        $start = (new DateTime($start_date));
        $end = (new DateTime($end_date))->modify('+1 day');
        $new_interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start,$new_interval,$end);
        //get wash machines
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
        $total_machines = count($washmachinesid);
        if(!empty($washmachinesid)) {
            $x = 1;
            $res = array();
	        foreach ($period as $dt) {
		        //echo "<br/>";
		        //echo $dt->format("Y-m-d") . "<br>\n";
		        $day = $dt->format("Y-m-d");
                $res[$x]['day']=$day;
                $machines=array();
                $steps=array();
                $data = array();
                foreach($washmachinesid as $washmachine) {
                    $sql="SELECT washmachine,COUNT(washstep) AS `steps` FROM `washstatus` WHERE `washstep`='1' AND `washmachine`='".$washmachine['number']."' AND `datetime` LIKE '%".$day."%'";
                    $result=$local->query($sql);
                    if($result === false) {
                        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
                    } else {
                        if($result->num_rows > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
			                    //print_r($row);
                                //echo "<br/>";
                                $machines[] = $washmachine['number'];
                                $steps[] = $row['steps'];
		                    }
                        }
                    }
	            }
                $data = array_combine($machines,$steps);
                $res[$x]['data']=$data;
                $x++;
            }
        }
        if(!empty($res)) {
			echo "
            <div class=\"table-responsive\" id=\"printx\">
                <table id=\"statsx\" class=\"table table-bordered table-striped table-hover\">
                    <thead>
                        <tr>
                            <th>".$k149."</th>";
            for ($i = 1; $i <= $total_machines; $i++) {
                echo "<th>".$k187." ".$i."</th>";
            }
            echo "
                        </tr>
                    </thead>
                    <tbody>";
			$s=array();
			foreach ($res as $st) {
			    echo "<tr>";
			    echo "<td>".$st['day']."</td>";
			    $v=0;
			    foreach($st['data'] as $key => $val) {
                    if($v==$total_machines) { $v=0; }
                    $s[$v][]=$val;
					if($val==0){ echo "<td class=\"text-warning\">".$val."</td>"; } 
				    else { echo "<td class=\"text-success\">".$val."</td>"; }
				    $v++;
				}
			    echo "</tr>";
		    }
		    if(!empty($s)) {
				echo "<tr>";
				echo "<td>".$k087."</td>";
                foreach ($s as $key => $value) {
                    $s[$key] = array_sum($value);
					if($s[$key]==0){ echo "<td class=\"text-danger\" style=\"font-weight:700;\">".$s[$key]."</td>"; } 
				    else { echo "<td class=\"text-success\" style=\"font-weight:700;\">".$s[$key]."</td>"; }
                }
                echo "</tr>";
			}		    
            echo "
                    </tbody>
                    <!--
                    <tfoot>
                        <tr>
                            <td>".$k149."</td>";
            for ($i = 1; $i <= $total_machines; $i++) {
                echo "<td>".$k187." ".$i."</td>";
            }
            echo "
                        </tr>
                    </tfoot>
                    -->
		        </table>
		    </div>
        <script type=\"text/javascript\">
        $(function () {
            $(\"span#stats_title\").text('".$st01."');
            if(jQuery().dataTable) {
                $.extend(true,$.fn.dataTable.defaults, {
                    \"language\": {
                        \"buttons\": {
                            copyTitle: '".$dt041."',
                            copySuccess: {
                                _: '%d ".$dt042."',
                                1: '1 ".$dt043."'
                            }
                        }
                    }           
                });
                if($(\"#statsx\").length > 0) { 
	                $(\"#statsx\").DataTable({
		                dom: '<\"html5buttons\" B>lTfgitp',
		                buttons: [
			            {
				            extend: 'copyHtml5',
				            text: '".$dt023."',
				            exportOptions: {
					            columns: [ 0";
                                for ($i = 1; $i <= $total_machines; $i++) {
                                    echo ",".$i;
                                }
					            echo "]
				            },
				            title: '".$app." - ".$st01."'
			            },
			            {
				            extend: 'excelHtml5',
				            exportOptions: {
					            columns: [ 0";
                                for ($i = 1; $i <= $total_machines; $i++) {
                                    echo ",".$i;
                                }
					            echo "]
				            },
				            title: '".$app." - ".$st01."'
			            },
			            {
				            extend: 'pdfHtml5',
				            exportOptions: {
					            columns: [ 0";
                                for ($i = 1; $i <= $total_machines; $i++) {
                                    echo ",".$i;
                                }
					            echo "]
				            },
                            customize: function(doc) {
                                doc.defaultStyle.fontSize = 8;
                            },
                            title: '".$app." - ".$st01."'
			            },
			            {    
			                extend: 'print',
			                orientation: 'landscape',
			                text: '".$dt024."',
			                title: '".$app." - ".$st01."',
				            exportOptions: {
					            columns: [ 0";
                                for ($i = 1; $i <= $total_machines; $i++) {
                                    echo ",".$i;
                                }
					            echo "]
				            }
			            }
		                ],
                        \"aoColumns\": [
				            { \"bSearchable\": true, \"bSortable\": true }";
                                for ($i = 1; $i <= $total_machines; $i++) {
                                    echo ",{ \"bSearchable\": true, \"bSortable\": true }";
                                }
				            echo "
                        ],
		                \"aaSorting\": [[ 0, \"asc\" ]],
				        \"iDisplayLength\": 50,
				        \"aLengthMenu\": [[50, 75, 100, -1], [50, 75, 100, \"".$dt026."\"]],
		                \"oLanguage\": {
			                \"sLengthMenu\": \"".$dt027." _MENU_ ".$dt028.".\",
			                \"sSearch\": \"".$dt029.": \",
			                \"sZeroRecords\": \"".$dt030.".\",
			                \"sInfo\": \"".$dt031." _START_ ".$dt032." _END_ ".$dt033." _TOTAL_ ".$dt034.".\",
			                \"sInfoEmpty\": \"".$dt031." 0 ".$dt032." 0 ".$dt034.".\",
			                \"sInfoFiltered\": \"(".$dt035." _MAX_ ".$dt036.")\",
                            \"oPaginate\": {
                                \"sFirst\":    \"".$dt037."\",
                                \"sPrevious\": \"".$dt038."\",
                                \"sNext\":     \"".$dt039."\",
                                \"sLast\":     \"".$dt040."\"
                            }
                        }
                    });
                }
            }
        });
        </script>";
            $data_exists = FALSE;
            $data_title = $st01;
		}
    }
    //end of what=1
    if($what=="2"){
        $start = (new DateTime($start_date));
        $end = (new DateTime($end_date))->modify('+1 day');
        $new_interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start,$new_interval,$end);
        //get wash pumps
        $washpumps = array();
        $sql="SELECT * FROM `washdetergents` ORDER BY `id` ASC";
        $result=$local->query($sql);
        if($result === false) {
            trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
        } else {
            if($result->num_rows > 0) {
                while($row = mysqli_fetch_assoc($result)) {
		            $washpumps[] = $row;
		        }
            }
        }
        $total_pumps = count($washpumps);
        if(!empty($washpumps)) {
            $x = 1;
            $res = array();
	        foreach ($period as $dt) {
		        //echo "<br/>";
		        //echo $dt->format("Y-m-d") . "<br>\n";
		        $day = $dt->format("Y-m-d");
                $res[$x]['day']=$day;
                $pumps=array();
                $prep=array();
                $data = array();
                $z=1;
                foreach($washpumps as $washpump) {
                    $sql="SELECT SUM(washprep".$z.") AS `prep".$z."` FROM `washstatus` WHERE `datetime` LIKE '%".$day."%'";
                    //echo $sql."<br/>";
                    $result=$local->query($sql);
                    if($result === false) {
                        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
                    } else {
                        if($result->num_rows > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
								//print "<pre>";
			                    //print_r($row);
			                    //print "</pre>";
                                //echo "<br/>";
                                if($row['prep'.$z]==NULL){$prep_val=0;}else {$prep_val=$row['prep'.$z];}
                                $pumps[] = $washpump['pump'];
                                $prep[] = number_format($prep_val/1000,3,'.','');
		                    }
                        }
                    }
                    $z++;
	            }
                $data = array_combine($pumps,$prep);
                $res[$x]['data']=$data;
                $x++;
            }
		}
		//print "<pre>";
		//print_r($res);
		//print "</pre>";
        if(!empty($res)) {
			echo "
            <div class=\"table-responsive\" id=\"printx\">
                <table id=\"statsx\" class=\"table table-bordered table-striped table-hover\">
                    <thead>
                        <tr>
                            <th>".$k149."</th>";
            for ($i = 1; $i <= $total_pumps; $i++) {
                echo "<th>".$k113." ".$i."</th>";
            }
            echo "
                        </tr>
                    </thead>
                    <tbody>
			";
			$s=array();
			foreach ($res as $st) {
			    echo "<tr>";
			    echo "<td>".$st['day']."</td>";
			    $v=0;
			    foreach($st['data'] as $key => $val) {
                    if($v==$total_pumps) { $v=0; }
                    $s[$v][]=$val;
					if($val==0){ echo "<td class=\"text-warning\">".$val."</td>"; } 
				    else { echo "<td class=\"text-success\">".$val."</td>"; }
				    $v++;
				}
			    echo "</tr>";
		    }
		    if(!empty($s)) {
				echo "<tr>";
				echo "<td>".$k087."</td>";
                foreach ($s as $key => $value) {
                    $s[$key] = array_sum($value);
					if($s[$key]==0){ echo "<td class=\"text-danger\" style=\"font-weight:700;\">".$s[$key]."</td>"; } 
				    else { echo "<td class=\"text-success\" style=\"font-weight:700;\">".$s[$key]."</td>"; }
                }
                echo "</tr>";
			}		
            echo "
                    </tbody>
                    <!--
                    <tfoot>
                        <tr>
                            <td>".$k149."</td>";
            for ($i = 1; $i <= $total_pumps; $i++) {
                echo "<td>".$k187." ".$i."</td>";
            }
            echo "
                        </tr>
                    </tfoot>
                    -->
		        </table>
		    </div>
        <script type=\"text/javascript\">
        $(function () {
            $(\"span#stats_title\").text('".$st02."');
            if(jQuery().dataTable) {
                $.extend(true,$.fn.dataTable.defaults, {
                    \"language\": {
                        \"buttons\": {
                            copyTitle: '".$dt041."',
                            copySuccess: {
                                _: '%d ".$dt042."',
                                1: '1 ".$dt043."'
                            }
                        }
                    }           
                });
                if($(\"#statsx\").length > 0) { 
	                $(\"#statsx\").DataTable({
		                dom: '<\"html5buttons\" B>lTfgitp',
		                buttons: [
			            {
				            extend: 'copyHtml5',
				            text: '".$dt023."',
				            exportOptions: {
					            columns: [ 0";
                                for ($i = 1; $i <= $total_pumps; $i++) {
                                    echo ",".$i;
                                }
					            echo "]
				            },
				            title: '".$app." - ".$st02."'
			            },
			            {
				            extend: 'excelHtml5',
				            exportOptions: {
					            columns: [ 0";
                                for ($i = 1; $i <= $total_pumps; $i++) {
                                    echo ",".$i;
                                }
					            echo "]
				            },
				            title: '".$app." - ".$st02."'
			            },
			            {
				            extend: 'pdfHtml5',
				            exportOptions: {
					            columns: [ 0";
                                for ($i = 1; $i <= $total_pumps; $i++) {
                                    echo ",".$i;
                                }
					            echo "]
				            },
                            customize: function(doc) {
                                doc.defaultStyle.fontSize = 8;
                            },
                            title: '".$app." - ".$st02."'
			            },
			            {    
			                extend: 'print',
			                orientation: 'landscape',
			                text: '".$dt024."',
			                title: '".$app." - ".$st02."',
				            exportOptions: {
					            columns: [ 0";
                                for ($i = 1; $i <= $total_pumps; $i++) {
                                    echo ",".$i;
                                }
					            echo "]
				            }
			            }
		                ],
                        \"aoColumns\": [
				            { \"bSearchable\": true, \"bSortable\": true }";
                                for ($i = 1; $i <= $total_pumps; $i++) {
                                    echo ",{ \"bSearchable\": true, \"bSortable\": true }";
                                }
				            echo "
                        ],
		                \"aaSorting\": [[ 0, \"asc\" ]],
				        \"iDisplayLength\": 50,
				        \"aLengthMenu\": [[50, 75, 100, -1], [50, 75, 100, \"".$dt026."\"]],
		                \"oLanguage\": {
			                \"sLengthMenu\": \"".$dt027." _MENU_ ".$dt028.".\",
			                \"sSearch\": \"".$dt029.": \",
			                \"sZeroRecords\": \"".$dt030.".\",
			                \"sInfo\": \"".$dt031." _START_ ".$dt032." _END_ ".$dt033." _TOTAL_ ".$dt034.".\",
			                \"sInfoEmpty\": \"".$dt031." 0 ".$dt032." 0 ".$dt034.".\",
			                \"sInfoFiltered\": \"(".$dt035." _MAX_ ".$dt036.")\",
                            \"oPaginate\": {
                                \"sFirst\":    \"".$dt037."\",
                                \"sPrevious\": \"".$dt038."\",
                                \"sNext\":     \"".$dt039."\",
                                \"sLast\":     \"".$dt040."\"
                            }
                        }
                    });
                }
            }
        });
        </script>";
            $data_exists = FALSE;
            $data_title = $st02;
		}
	}
    //end of what=2
    if($what=="3"){
        $start = (new DateTime($start_date));
        $end = (new DateTime($end_date))->modify('+1 day');
        $new_interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start,$new_interval,$end);
        $washmachineid = $_GET['washid'];
        $data_title = $k110." ".$washmachineid." - ".$st02;
        //echo $washmachineid;
        //get wash pumps
        $washpumps = array();
        $sql="SELECT * FROM `washdetergents` ORDER BY `id` ASC";
        $result=$local->query($sql);
        if($result === false) {
            trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
        } else {
            if($result->num_rows > 0) {
                while($row = mysqli_fetch_assoc($result)) {
		            $washpumps[] = $row;
		        }
            }
        }
        $total_pumps = count($washpumps);
        if(!empty($washpumps)) {
            $x = 1;
            $res = array();
	        foreach ($period as $dt) {
		        //echo "<br/>";
		        //echo $dt->format("Y-m-d") . "<br>\n";
		        $day = $dt->format("Y-m-d");
                $res[$x]['day']=$day;
                $pumps=array();
                $prep=array();
                $data = array();
                $z=1;
                foreach($washpumps as $washpump) {
                    $sql="SELECT SUM(washprep".$z.") AS `prep".$z."` FROM `washstatus` WHERE `washmachine`='".$washmachineid."' AND `datetime` LIKE '%".$day."%'";
                    //echo $sql."<br/>";
                    $result=$local->query($sql);
                    if($result === false) {
                        trigger_error('Wrong SQL: '.$sql.' Error: '.$local->error,E_USER_ERROR);
                    } else {
                        if($result->num_rows > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
								//print "<pre>";
			                    //print_r($row);
			                    //print "</pre>";
                                //echo "<br/>";
                                if($row['prep'.$z]==NULL){$prep_val=0;}else {$prep_val=$row['prep'.$z];}
                                $pumps[] = $washpump['pump'];
                                $prep[] = number_format($prep_val/1000,3,'.','');
		                    }
                        }
                    }
                    $z++;
	            }
                $data = array_combine($pumps,$prep);
                $res[$x]['data']=$data;
                $x++;
            }
		}
		//print "<pre>";
		//print_r($res);
		//print "</pre>";
        if(!empty($res)) {
			echo "
            <div class=\"table-responsive\" id=\"printx\">
                <table id=\"statsx\" class=\"table table-bordered table-striped table-hover\">
                    <thead>
                        <tr>
                            <th>".$k149."</th>";
            for ($i = 1; $i <= $total_pumps; $i++) {
                echo "<th>".$k113." ".$i."</th>";
            }
            echo "
                        </tr>
                    </thead>
                    <tbody>
			";
			$s=array();
			foreach ($res as $st) {
			    echo "<tr>";
			    echo "<td>".$st['day']."</td>";
			    $v=0;
			    foreach($st['data'] as $key => $val) {
                    if($v==$total_pumps) { $v=0; }
                    $s[$v][]=$val;
					if($val==0){ echo "<td class=\"text-warning\">".$val."</td>"; } 
				    else { echo "<td class=\"text-success\">".$val."</td>"; }
				    $v++;
				}
			    echo "</tr>";
		    }
		    if(!empty($s)) {
				echo "<tr>";
				echo "<td>".$k087."</td>";
                foreach ($s as $key => $value) {
                    $s[$key] = array_sum($value);
					if($s[$key]==0){ echo "<td class=\"text-danger\" style=\"font-weight:700;\">".$s[$key]."</td>"; } 
				    else { echo "<td class=\"text-success\" style=\"font-weight:700;\">".$s[$key]."</td>"; }
                }
                echo "</tr>";
			}		
            echo "
                    </tbody>
                    <!--
                    <tfoot>
                        <tr>
                            <td>".$k149."</td>";
            for ($i = 1; $i <= $total_pumps; $i++) {
                echo "<td>".$k187." ".$i."</td>";
            }
            echo "
                        </tr>
                    </tfoot>
                    -->
		        </table>
		    </div>
        <script type=\"text/javascript\">
        $(function () {
            $(\"span#stats_title\").text('".$data_title."');
            if(jQuery().dataTable) {
                $.extend(true,$.fn.dataTable.defaults, {
                    \"language\": {
                        \"buttons\": {
                            copyTitle: '".$dt041."',
                            copySuccess: {
                                _: '%d ".$dt042."',
                                1: '1 ".$dt043."'
                            }
                        }
                    }           
                });
                if($(\"#statsx\").length > 0) { 
	                $(\"#statsx\").DataTable({
		                dom: '<\"html5buttons\" B>lTfgitp',
		                buttons: [
			            {
				            extend: 'copyHtml5',
				            text: '".$dt023."',
				            exportOptions: {
					            columns: [ 0";
                                for ($i = 1; $i <= $total_pumps; $i++) {
                                    echo ",".$i;
                                }
					            echo "]
				            },
				            title: '".$app." - ".$data_title."'
			            },
			            {
				            extend: 'excelHtml5',
				            exportOptions: {
					            columns: [ 0";
                                for ($i = 1; $i <= $total_pumps; $i++) {
                                    echo ",".$i;
                                }
					            echo "]
				            },
				            title: '".$app." - ".$data_title."'
			            },
			            {
				            extend: 'pdfHtml5',
				            exportOptions: {
					            columns: [ 0";
                                for ($i = 1; $i <= $total_pumps; $i++) {
                                    echo ",".$i;
                                }
					            echo "]
				            },
                            customize: function(doc) {
                                doc.defaultStyle.fontSize = 8;
                            },
                            title: '".$app." - ".$data_title."'
			            },
			            {    
			                extend: 'print',
			                orientation: 'landscape',
			                text: '".$dt024."',
			                title: '".$app." - ".$data_title."',
				            exportOptions: {
					            columns: [ 0";
                                for ($i = 1; $i <= $total_pumps; $i++) {
                                    echo ",".$i;
                                }
					            echo "]
				            }
			            }
		                ],
                        \"aoColumns\": [
				            { \"bSearchable\": true, \"bSortable\": true }";
                                for ($i = 1; $i <= $total_pumps; $i++) {
                                    echo ",{ \"bSearchable\": true, \"bSortable\": true }";
                                }
				            echo "
                        ],
		                \"aaSorting\": [[ 0, \"asc\" ]],
				        \"iDisplayLength\": 50,
				        \"aLengthMenu\": [[50, 75, 100, -1], [50, 75, 100, \"".$dt026."\"]],
		                \"oLanguage\": {
			                \"sLengthMenu\": \"".$dt027." _MENU_ ".$dt028.".\",
			                \"sSearch\": \"".$dt029.": \",
			                \"sZeroRecords\": \"".$dt030.".\",
			                \"sInfo\": \"".$dt031." _START_ ".$dt032." _END_ ".$dt033." _TOTAL_ ".$dt034.".\",
			                \"sInfoEmpty\": \"".$dt031." 0 ".$dt032." 0 ".$dt034.".\",
			                \"sInfoFiltered\": \"(".$dt035." _MAX_ ".$dt036.")\",
                            \"oPaginate\": {
                                \"sFirst\":    \"".$dt037."\",
                                \"sPrevious\": \"".$dt038."\",
                                \"sNext\":     \"".$dt039."\",
                                \"sLast\":     \"".$dt040."\"
                            }
                        }
                    });
                }
            }
        });
        </script>";
            $data_exists = FALSE;
		}
		
		
    }
    //end of what=3
    //global whats if data
    if ($data_exists == TRUE) {
	    echo "
	    <button type=\"button\" id=\"btn\" class=\"btn btn-primary fr\" onclick=\"printDiv();\"><i class=\"fa fa-print\" aria-hidden=\"true\"></i>&nbsp;".$k153."</button>
        <!-- print -->
        <script type=\"text/javascript\">
        function printDiv() { 
            var document_title = ' „".$firma['name']."”';
            var data_title = '".$data_title."';
            var divToPrint=document.getElementById('printx');
            var newWin=window.open('','');
            newWin.document.open();
            newWin.document.write('<!DOCTYPE html><html><head><title></title>');
            newWin.document.write('<link rel=\"stylesheet\" href=\"assets/dist/css/base.css\" type=\"text/css\" />');
            newWin.document.write('<link rel=\"stylesheet\" href=\"assets/dist/css/component_ui.css\" type=\"text/css\" />'); 
            newWin.document.write('<link rel=\"stylesheet\" href=\"assets/dist/css/extend.css\" type=\"text/css\" />');
            newWin.document.write('<link rel=\"stylesheet\" href=\"assets/dist/css/stats.css\" type=\"text/css\" />');
            newWin.document.write('</head><body>');
            newWin.document.write(''+
                '<style>.display-none{display:block;}</style>'+
                '<h1 style=\"text-transform:uppercase;text-align:center;\">'+document_title+'</h1>'+
                '<h3 style=\"text-transform:uppercase;text-align:center;\">'+data_title+'</h3>'+
            '');
            newWin.document.write(divToPrint.innerHTML);
            newWin.document.write('<br/><br/><p><span style=\"padding-left:1px;\">".$k180."&nbsp;<strong>".$app."&nbsp;".$version."</strong><span>&nbsp;<small>r".$revision."</small></span>&nbsp;-&nbsp;".$kaweb."</span></p>');
            newWin.document.write('</body></html>');
            newWin.document.close();
            newWin.focus();
            newWin.print();
            setTimeout(function(){newWin.close();},10);
            return false;
        }
        </script>
        ";	
	}
} else {
    //empty GET
}

?>
