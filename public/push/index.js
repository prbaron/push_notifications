"use strict";

var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var port = process.env.PORT || 5000;

app.get('/', function (req, res) {
    res.send('<h1>Hello world</h1>');
});

io.on('connection', function (socket) {
    console.info('SocketIO > Connected socket ' + socket.id);

    socket.on('php.message.created', function (response) {
        console.log('php.message.created', JSON.stringify(response));
        io.emit('message.created', response);
    });
    socket.on('php.message.updated', function (response) {
        console.log('php.message.updated', JSON.stringify(response));
        io.emit('message.updated', response);
    });
    socket.on('php.message.deleted', function (response) {
        console.log('php.message.deleted', JSON.stringify(response));
        io.emit('message.deleted', response);
    });

    socket.on('disconnect', function () {
        console.info('SocketIO > Disconnected socket ' + socket.id);
    });
});

http.listen(port, function () {
    console.log('listening on *:' + port);
});