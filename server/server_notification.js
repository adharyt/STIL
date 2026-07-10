var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('socket.io-redis');
io.adapter(redis({ host: 'localhost', port: 6379 }));


server.listen(3000, function(){
   console.log('listening on *:3000');
});


io.on('connection', function (socket) {
  //socket.on( 'new_message', function( data ) {
    //  console.log( 'new_message' );
      //io.sockets.emit( 'new_message', {
      //  message: data.message,
      //  date: data.date,
      //  msgcount: data.msgcount
    //  });
  //  });
});

var redis1 = require('redis');
var client1 = redis1.createClient();

client1.subscribe('notification_user');
client1.subscribe('notification_store');

client1.on('message', function(channel, msg) {
  if(channel=='notification_user' || channel=='notification_store'){
    data=JSON.parse(msg);
    //console.log(data);
    io.sockets.emit( channel, {
      id_user: data.id_user,
      need_reload:data.need_reload
    });
  }
});
