<?php
define('start',TRUE);
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/config.php");
header("Content-type: text/css");
?>
@charset "UTF-8";
@font-face {
    font-family: 'Digital-7Mono';
    src: url('../fonts/Digital-7Mono.eot?#iefix') format('embedded-opentype'),  
         url('../fonts/Digital-7Mono.woff') format('woff'), 
         url('../fonts/Digital-7Mono.ttf') format('truetype'), 
         url('../fonts/Digital-7Mono.svg#Digital-7Mono') format('svg');
    font-weight: normal;
    font-style: normal;
}
html, body {
    padding:0;
    margin:0;
    height:100%;
    min-height:100%;
    width:100%;
    min-width:100%;
}
body { 
    font-family: Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased; 
    background-color:#000000; 
    color:#ffffff;
    line-height: 12px;
}
.theme-text {
	color:<?=$color?>;
}
#NW {
    position:fixed;
    width:80%;
    height:50%;
    top:0;
    left:0;
}
#NE {
    position:fixed;
    width:20%;
    height:50%;
    top:0;
    left:80%;
}
#SW {
    position:fixed;
    width:80%;
    height:50%;
    top:50%;
    left:0;
}
#SW1 {
    position:fixed;
    width:80%;
    height:50%;
    top:50%;
    left:0;
    display: none;
}
#SW2 {
    position:fixed;
    width:80%;
    height:50%;
    top:50%;
    left:0;
    background: #000000;
    display: none;
}
#SE {
    position:fixed;
    width:20%;
    height:50%;
    top:50%;
    left:80%;
}
#SE,#SW,#SW2 {
    border-top:1px solid #333333;
}
#NE,#SE {
    border-left:1px solid #333333;
}
#clock {
    padding: 10px 8px;
}
#week {
	width: 100%;
    color: #666666;
    text-align: center;
    font-size: 34px;
    line-height: 26px;
    margin: 0;
    padding: 0;
    text-shadow: 1px 1px rgba(22,22,22,0.5);
}
#week span { /* 20px */
	padding: 0 18px 0 0;
	color: #666666;
	text-decoration: none;
}
#week span:last-child {
	padding-right: 0;
}
#week span.active {
	color:<?=$color?>;
	text-decoration: underline;
}
#week span.noactive {
	color: #666666;
	text-decoration: none;
}
#ctime {
	width: 100%;
	font-family: 'Digital-7Mono';
    color:<?=$color?>;
    font-size: 166px;
    line-height: 140px;
    text-align: center;
    margin: 0;
    padding: 0;
    padding-top:16px;
    padding-bottom:11px;
}
#cdate {
	width: 100%;
    color: #666666;
    text-align: center;
    font-size: 34px;
    line-height: 26px;
    text-transform: uppercase;
    margin: 0;
    padding: 0;
}
#weather {
    color: <?=$color?>;
    padding: 8px;
}
#zone {
    text-transform: uppercase;
    text-align: center;
    font-size: 34px;
    line-height: 26px;
    margin: 0;
    padding: 6px 0 6px 0;
}
img#cond {
    position: relative;
    display: block;
    margin: 0 auto;
    padding: 4px 0;
    width: 90px;
    height: 90px;
}
#icond {
    text-align: center;
    padding: 0;
    margin: 0;
    margin-top:0px;
    height: 90px;
    max-height: 90px;
}
#icond i {
    font-size: 58px;
    line-height: 70px;
    vertical-align: middle;
    margin: 0 auto;
    padding: 8px 0 8px 0;
    display: block;
    max-height: 86px;
}
#condi {
    text-transform: uppercase;
    text-align: center;
    font-size: 22px;
    line-height: 22px;
    margin: 0;
    padding: 0;
}
#temps {
	text-align: center;
	margin-top: 14px;
        margin-bottom: 2px;
}
#temps span#min {
	font-size: 22px;
	color: #666666;
	padding-right: 4px;
	vertical-align: bottom;
	line-height: 20px;
}
#temps span#max {
	font-size: 22px;
	color: #666666;
	padding-left: 4px;
	vertical-align: bottom;
	line-height: 20px;
}
#temps span#min::after,#temps span#max::after {
	font-family: "ka-ex";
	font-size: 26px;
	content: "A";
	padding-top: 5px;
}
#temp,#tempin {
    text-align: center;
    font-size: 36px;
    line-height: 24px;
    margin: 0;
    padding: 0;
    vertical-align: middle;
}
#temp::after,#tempin::after {
	font-family: "ka-ex";
	font-size: 40px;
	content: "A";
	margin-top: -20px;
	vertical-align: middle;
	display: inline-block;
}
p#extends {
	width: 100%;
	vertical-align: middle;
	text-align: center;
        display: inline-block;
}
#extends span {
	font-size: 16px;
	display: inline-block;
	width: 24% !important;
}
span#hum::before {
	font-family: "ka-ex";
	font-size: 20px;
	content: "\e048";
	vertical-align: middle;
	padding-right: 5px;
}
span#wind::after {
	font-family: "ka-ex";
	font-size: 20px;
	content: "Q";
	vertical-align: middle;
	padding-left: 5px;
}
span#nuv::before {
	font-family: "ka-ex";
	font-size: 20px;
	content: "\e08f";
	vertical-align: middle;
	padding-right: 5px;
}
span#mb::after {
	font-family: "ka-ex";
	font-size: 20px;
	content: "\e0a3";
	vertical-align: middle;
	padding-left: 5px;
}
span#sunrise::before {
	font-family: "ka-ex";
	font-size: 20px;
	content: "\e014";
	vertical-align: middle;
	padding-right: 5px;
}
span#sunset::after {
	font-family: "ka-ex";
	font-size: 20px;
	content: "\e015";
	vertical-align: middle;
	padding-left: 5px;
}
#rfid {
	margin: 0;
	padding: 15px 8px 8px 8px;
}
#PIN {
	color:<?=$color?>;
	font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
	font-size: 48px;
	line-height: 32px;
	text-align: center;
	padding 0;
	margin: 0;
	letter-spacing: 4px;
	text-transform: uppercase;
    font-weight:700;
}
#Name {
	color:<?=$color?>;
	/*color:#FFFFFF;*/
	font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
	font-size: 36px;
    font-weight: 700;
	line-height: 36px;
	padding-top: 10px;
	text-align: center;
	text-transform: uppercase;
}
#Event {
	color:<?=$color?>;
	font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
	font-size: 48px;
	line-height: 40px;
	text-align: center;
	text-transform: uppercase;
	padding-top: 0px;
}
#Event i {
    vertical-align: middle;
    line-height: 10px;
}
.In::before {
    content: "\f18e";
    padding-right: 14px;
    font-family: fontawesome;
    font-size: 56px;
    line-height: 10px;
}
.Out::before {
    content: "\f190";
    padding-right: 14px;
    font-family: fontawesome;
    font-size: 56px;
    line-height: 10px;
}
.Err::before {
    content: "\f071";
    font-family: fontawesome;
    font-size: 82px;
    line-height: 30px;
    color:#FF0000;
}
.Reg::before {
    content: "\f058";
    font-family: fontawesome;
    font-size: 82px;
    line-height: 30px;
}
#info {
	margin:0;
	padding:0;
}
#info p {
	padding: 10px 0 10px 0;
	margin: 0;
	/*color:<?=$color?>;*/
	font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
	font-size: 22px;
	height:20px;
	line-height: 20px;
	text-align: center;
	vertical-align:center;
	text-transform: uppercase;
	border-bottom:1px solid #333333;
}
#info p:last-child {
    border-bottom:none;
    overflow:hidden;
}
p#inv {
    color:<?=$color?>;
    font-size: 24px;
    font-weight:700;
    padding: 12px 0 10px 0;
}
#ipaddr {
    color:<?=$color?>;
    font-size:15px !important;
    font-weight:600;
    padding:8px 0 6px 0 !important;
}
span#net {
    color:#666666;
    font-size:20px;
    padding:7px 0 5px 0 !important;
}
span#usb {
	color:#666666;
	font-size:20px;
	padding:7px 0 5px 0 !important;
}
#server {
	color:#666666;
	font-size:20px;
}
#server span#ping {
    margin-left:10px;
}
#server #ping span {
    font-weight: 700;
    font-size: 10px;
    margin-left: 6px;
}
#cpu {
    color:<?=$color?>;
    padding:11px 0 9px 0 !important;
}
#cpu::before {
	font-family: fontawesome;
	font-size: 20px;
	content: "\f2db";
	padding-right: 8px;
}
#cpu::after {
	font-family: "ka-ex";
	font-size: 26px;
	content: "A";
	padding-top: 0px;
	margin-top: -5px;
	vertical-align: top;
	display: inline-block;
}
#title {
	padding: 11px 0 0 0;
	margin: 0;
	color:<?=$color?>;
	font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
	font-size: 19px;
	line-height: 20px;
	text-align: center;
	text-transform: uppercase;
}
#tempin {
	padding-top: 13px;
    padding-left: 8px;
	margin-top: 0;
	color:<?=$color?>;
	line-height: 20px;
	border-bottom:1px solid #333333;
	padding-bottom: 16px;
}
.status {
    width:100%;
    height:92px;
    /*border:1px solid #FF0000;*/
}
#resp {
    /*border:1px solid #FF0000;*/
	padding:0;
	margin:0;
	font-size: 76px;
	line-height: 96px;
	text-transform:uppercase;
    display:block;
    text-align: center;
    vertical-alight:middle;
    color:#666666;
}
.online {
	border-top:1px solid #333333;
}
.online p#status {
	padding:4px 0px 0px 0px;
	margin:0px;
	color:<?=$color?>;
	font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
	font-size: 28px;
	font-weight:700;
	line-height: 41px;
	text-align: center;
	text-transform: uppercase;
    overflow:hidden;
}
.online p#status.on {
    background-color:#00ff00;
    color:#000000;
}
.online p#status.off {
    background-color:#ff0000;
    color:#000000;	
}
span#space {
    width:16px;	
}
#counter {
    color:<?=$color?>;
    font-size:19px !important;
    padding:10px 0 1px 0 !important;
}
p#third {
    padding:10px 0 9px 0 !important;	
}
#counter::before {
	font-family: fontawesome;
	content: "\f2c2";
	padding-right: 8px;
	margin-top:-1px;
}
p#revision {
	background-color:#333333;
	position:absolute;
	left:-5px;
	bottom:0px;
	font-size:20px;
	line-height:18px;
    writing-mode: tb-rl;
    color:#000000;
    width:20px;
    display: inline-block;
    padding:10px 3px 9px 0 !important;
}
