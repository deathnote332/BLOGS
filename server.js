var app = require('express')();
var server =  require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

var MySQLEvents = require('mysql-events');
var dsn = {
    host:     'localhost',
    user:     'root',
    password: ''
};

server.listen(8080);

var mysqlEventWatcher = MySQLEvents(dsn);
var watcher =mysqlEventWatcher.add(
    'blogs_db.orders',
    function (oldRow, newRow, event) {
        //row inserted
        if (oldRow === null) {
            console.log("Row has updated ");
            io.emit('new_data', 1);
        }

        //row deleted
        if (newRow === null) {
            console.log("Row has updated ");
            io.emit('new_data', 1);
        }

        //row updated
        if (oldRow !== null && newRow !== null) {
            console.log("Row has updated ");
            io.emit('new_data', 1);
        }

        //detailed event information
        console.log(event); // don't matter, it updates, delete or insert

        //detailed event information
        //console.log(event)
    },
    'match this string or regex'
);

console.log(watcher);