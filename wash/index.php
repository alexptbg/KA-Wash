<!DOCTYPE html>
<html lang="en">
<head>
    <title>WTKR</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description" content="Work Time Klock Register" />
    <meta name="keywords" content= "WTKR" />
    <meta name="AUTHOR" content="ALEX SOARES | Алекс Соарес" />
    <meta name="MAIL" content="alex@ka-ex.net" />
    <meta name="VERSION" content="1.0" />
    <meta name="REVISION" content="R21" />
    <!--<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />-->
    <link type="text/css" rel="stylesheet" href="css/font-awesome.css" />
    <link type="text/css" rel="stylesheet" href="css/ka-ex.css" />
    <link type="text/css" rel="stylesheet" href="css/weather-icons.css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-migrate.js"></script>
    <!--<script type="text/javascript" src="js/bootstrap.js"></script>-->
    <script type="text/javascript" src="js/socket.io.js"></script>
    <script type="text/javascript" src="js/moment.js"></script>
    <script type="text/javascript" src="js/moment-bg.js"></script>
    <script type="text/javascript" src="js/moment-timezone-with-data-2010-2020.js"></script>
</head>
<body>
    <div class="wrapper">
        <!-- test -->
        <p id="rfid"></p>
    </div>
    <script type="text/javascript">
    	var socket = io.connect('http://127.0.0.1:3003');
    	//init
        $(function() {
            socket.on('connected', function(){
                console.log("Socket Connected");
            });
            socket.on('disconnect', function(){
                console.log("Socket Disconnected");
            });
            socket.on('serial', function(data){
                console.log(data);
            });
            socket.on('data', function (data) {
                console.log(data);
            });
	        <?php
	        if(!empty($_GET)){
                //echo json_encode($_GET);
	            echo 'socket.emit("cmd", '.json_encode($_GET).');';
	        }
	        ?>
        });//function end
    </script>
</body>
</html>
