/* eslint-disable node/no-missing-require */
//'use strict';
//"serialport@4.0.7"
var http = require('http');
var fs = require('fs');
var express = require('express');
var app = express();
var dateTime = require('node-datetime');
var SerialPort = require("serialport");
var mysql = require('mysql');
var server = http.createServer(app).listen(3003);
var io = require('socket.io').listen(server);
var args = process.argv;
var ping = 120000;

//db
var connection = mysql.createConnection({
  host     : '192.168.0.210',
  user     : 'pi',
  password : 'a11543395',
  database : 'ka-ex'
});
connection.connect();
//socket config
io.sockets.setMaxListeners(15);
//SERIAL PORT
//var OPORT = "/dev/ttyUSB0";
var OPORT = "/dev/"+args[2];
const OBAUD = 38400;

const port = new SerialPort(OPORT, {
  baudRate: OBAUD,
  //parser: SerialPort.parsers.raw
  parser: SerialPort.parsers.readline('\r\n')
  //parser: SerialPort.parsers.byteDelimiter([1,7])
  //parser: SerialPort.parsers.byteLength(8)
});

port.on('open', function(){
  console.log('Serial Port Is Open');
  //serial data
  port.on('data', function(data){
  //parser.on('data', function(data){
    console.log('DATA: '+data);
    var arr = data.split(',');
    //wash machine
    var wash_machine = arr[0].match(/[\d\.]+/g);
    console.log("W:"+wash_machine);
    //wash program
    var wash_program = arr[1].match(/[\d\.]+/g);
    console.log("P:"+wash_program);
    //step and step values
    var step = arr[2];
    var steps = step.split(' ');
    var wash_step = steps[0].match(/[\d\.]+/g);
    console.log("S:"+wash_step);
    //STEP 1
    var stp1 = steps[1].match(/[\d\.]+/g);
    console.log("S1:"+stp1);
    if (parseInt(stp1)!= 0) {
      connection.query("SELECT `quantity` FROM `washdetergents` WHERE `pump`='1'", function (err, result1, fields) {
        if (err) throw err;
        var stx1 = parseInt(result1[0].quantity)-parseInt(stp1);
        var sql1 = "UPDATE `washdetergents` SET `quantity`='"+stx1+"' WHERE `pump`='1'";
        connection.query(sql1, function (err, result) {
          if (err) throw err;
          console.log("PUMP 1:"+result.affectedRows + " record(s) updated");
        });
      });
    }
    //STEP2
    var stp2 = steps[2].match(/[\d\.]+/g);
    console.log("S2:"+stp2);
    if (parseInt(stp2)!= 0) {
      connection.query("SELECT `quantity` FROM `washdetergents` WHERE `pump`='2'", function (err, result2, fields) {
        if (err) throw err;
        var stx2 = parseInt(result2[0].quantity)-parseInt(stp2);
        var sql2 = "UPDATE `washdetergents` SET `quantity`='"+stx2+"' WHERE `pump`='2'";
        connection.query(sql2, function (err, result) {
          if (err) throw err;
          console.log("PUMP 2:"+result.affectedRows + " record(s) updated");
        });
      });
    }
    //STEP3
    var stp3 = steps[3].match(/[\d\.]+/g);
    console.log("S3:"+stp3);
    if (parseInt(stp3)!= 0) {
      connection.query("SELECT `quantity` FROM `washdetergents` WHERE `pump`='3'", function (err, result3, fields) {
        if (err) throw err;
        var stx3 = parseInt(result3[0].quantity)-parseInt(stp3);
        var sql3 = "UPDATE `washdetergents` SET `quantity`='"+stx3+"' WHERE `pump`='3'";
        connection.query(sql3, function (err, result) {
          if (err) throw err;
          console.log("PUMP 3:"+result.affectedRows + " record(s) updated");
        });
      });
    }
    //STEP4
    var stp4 = steps[4].match(/[\d\.]+/g);
    console.log("S4:"+stp4);
    if (parseInt(stp4)!= 0) {
      connection.query("SELECT `quantity` FROM `washdetergents` WHERE `pump`='4'", function (err, result4, fields) {
        if (err) throw err;
        var stx4 = parseInt(result4[0].quantity)-parseInt(stp4);
        var sql4 = "UPDATE `washdetergents` SET `quantity`='"+stx4+"' WHERE `pump`='4'";
        connection.query(sql4, function (err, result) {
          if (err) throw err;
          console.log("PUMP 4:"+result.affectedRows + " record(s) updated");
        });
      });
    }
    //STEP5
    var stp5 = steps[5].match(/[\d\.]+/g);
    console.log("S5:"+stp5);
    if (parseInt(stp5)!= 0) {
      connection.query("SELECT `quantity` FROM `washdetergents` WHERE `pump`='5'", function (err, result5, fields) {
        if (err) throw err;
        var stx5 = parseInt(result5[0].quantity)-parseInt(stp5);
        var sql5 = "UPDATE `washdetergents` SET `quantity`='"+stx5+"' WHERE `pump`='5'";
        connection.query(sql5, function (err, result) {
          if (err) throw err;
          console.log("PUMP 5:"+result.affectedRows + " record(s) updated");
        });
      });
    }
    //STEP6
    var stp6 = steps[6].match(/[\d\.]+/g);
    console.log("S6:"+stp6);
    if (parseInt(stp6)!= 0) {
      connection.query("SELECT `quantity` FROM `washdetergents` WHERE `pump`='6'", function (err, result6, fields) {
        if (err) throw err;
        var stx6 = parseInt(result6[0].quantity)-parseInt(stp6);
        var sql6 = "UPDATE `washdetergents` SET `quantity`='"+stx6+"' WHERE `pump`='6'";
        connection.query(sql6, function (err, result) {
          if (err) throw err;
          console.log("PUMP 6:"+result.affectedRows + " record(s) updated");
        });
      });
    }
    //STEP7
    var stp7 = steps[7].match(/[\d\.]+/g);
    console.log("S7:"+stp7);
    if (parseInt(stp7)!= 0) {
      connection.query("SELECT `quantity` FROM `washdetergents` WHERE `pump`='7'", function (err, result7, fields) {
        if (err) throw err;
        var stx7 = parseInt(result7[0].quantity)-parseInt(stp7);
        var sql7 = "UPDATE `washdetergents` SET `quantity`='"+stx7+"' WHERE `pump`='7'";
        connection.query(sql7, function (err, result) {
          if (err) throw err;
          console.log("PUMP 7:"+result.affectedRows + " record(s) updated");
        });
      });
    }
    //STEP8
    var stp8 = steps[8].match(/[\d\.]+/g);
    console.log("S8:"+stp8);
    if (parseInt(stp8)!= 0) {
      connection.query("SELECT `quantity` FROM `washdetergents` WHERE `pump`='8'", function (err, result8, fields) {
        if (err) throw err;
        var stx8 = parseInt(result8[0].quantity)-parseInt(stp8);
        var sql8 = "UPDATE `washdetergents` SET `quantity`='"+stx8+"' WHERE `pump`='8'";
        connection.query(sql8, function (err, result) {
          if (err) throw err;
          console.log("PUMP 8:"+result.affectedRows + " record(s) updated");
        });
      });
    }
    //clients rfid
    var rfids = arr[3];
    var clients = rfids.split(' ');
    console.log("C:"+clients.length);
    var c = 0;
    //var rfid_clean = [];
    clients.forEach(function(client) {
      c++;
      //rfid_clean[c] = client.match(/[\d\.]+/g);
      console.log("C"+c+":"+client.match(/[\d\.]+/g));
    });
    var rfids_cleaned = clients.join(':');
    //next
    var dt = dateTime.create();
    var formatted = dt.format('Y-m-d H:M:S');
    var stamp = dt.getTime();
    var timestamp = Math.floor(stamp/1000);
    if((wash_machine >0) && (wash_machine < 11)) {
      if((wash_step >0) && (wash_step < 9)) {
        //build query string
        var insert_data = { datetime: formatted, timestamp: timestamp, washmachine: wash_machine, washprogram: wash_program, washstep: wash_step, washprep1: stp1, washprep2: stp2, washprep3: stp3, washprep4: stp4, washprep5: stp5, washprep6: stp6, washprep7: stp7, washprep8: stp8, washclients: clients.length, washrfids: rfids_cleaned };
        console.log("WRITE");
        connection.query('INSERT INTO `washstatus` SET ?', insert_data, function(err,res){
          if(err) throw err;
          console.log('Last insert ID:', res.insertId);
        });
      }
    } else {
      //console.log("ERROR2");
    }
  });
});

/*
port.write(tara, function(err) {
  if (err) {
    return console.log('Error on write: ', err.message);
  }
  console.log('Tara reset OK');
});
*/

port.on('error', function(err) {
  console.log('Error: ', err.message);
});

port.on('close', function(){
  console.log('USB device unplugged!');
  connection.end();
});

setInterval(function () {
  connection.ping(function (err) {
    if (err) throw err;
    console.log('mySQL Server responded to ping!');
  });
},ping);

/*
connection.on('error', function(){

});
*/
io.sockets.on('connection',function (socket) {
  console.log('A client is connected!');
  //if get response
  socket.on('cmd', function (response) {
    console.log("CMD");
    var params = JSON.stringify(response);
    var pars = params.replace(/\"/g,"");
    var par = pars.replace(/[{}]/g,"");
    console.log(par);
    port.write(par+"\r\n",function(err) {
      if (err) {
        return console.log('Error on write: ', err.message);
      } else {
        console.log('Message sent');
        socket.emit('sent', 'Serial message sent!');
      }
    });
  });
});

