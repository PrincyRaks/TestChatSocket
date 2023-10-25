import express from 'express'
import http from 'http';
import { Server } from 'socket.io';

const app = express();

const server = http.createServer(app);

const io = new Server(server, {
    cors: { origin: '*' }
});

io.on('connection', (socket) => {
    console.log('a user connected');
    socket.on('sendChat', (message) => {
        console.log(message);
        io.sockets.emit('sendChatToClient', message);
    });

    socket.on('disconnect', (socket) => {
        console.log('user disconnected');
    });
});

server.listen(3000, () => {
    console.log('listening on *:3000');
});

