/* eslint-disable node/no-missing-require */
//'use strict';

/*
var GPIO = require('onoff').Gpio,
    led = new GPIO(19,'out');
*/
var http = require('http');
var express = require('express');
var app = express();
var SerialPort = require("serialport");
var server = http.createServer(app).listen(3000);
var io = require('socket.io').listen(server);
var args = process.argv;

//PORT
//var OPORT = "/dev/ttyUSB0";
var OPORT = "/dev/"+args[2];
const OBAUD = 9600;

const parsers = SerialPort.parsers;
// Use a `\r\n` as a line terminator
const parser = new parsers.Readline({
  delimiter: '\r\n'
});

const port = new SerialPort(OPORT, {
  baudRate: OBAUD
});

port.pipe(parser);
io.sockets.setMaxListeners(15);

port.on('open', function(){

  console.log('Serial Port Is Open');
  
  port.write('main screen turn on', function(err) {
    if (err) {
      return console.log('Error on write: ', err.message);
    }
    console.log('Message sent');
  });

  //wait for socket from web
  io.sockets.on('connection', function (socket) {
    console.log('Socket connected');
    console.log('Client ID: '+socket.id);
    socket.emit('connected');
    socket.emit('serial', { PORT: OPORT, BAUD: OBAUD });
    //serial data
    //port.on('data', function(data){
	parser.on('data', function(data){
      console.log('DATA: '+data);
      socket.emit('data', data);
    });
    //if get response
    socket.on('got', function (response) {
      console.log("GET it!");
      console.log(response);
    });

  });

});

port.on('error', function(err) {
  console.log('Error: ', err.message);
});

port.on('close', function(){
  console.log('USB device unplugged!');
});
