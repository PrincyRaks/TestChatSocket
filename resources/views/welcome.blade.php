<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Chat</title>
</head>
    <style>
        .chat-row {
            margin-top: 100px;
        }

        ul{
            margin: 0;
            padding: 0;
            list-style: none;
        }

        ul li{
            padding: 8px;
            background: #928792;
            margin-bottom: 20px;
        }

        ul li:nth-child(2n-2){
            background: #c3c5c5;
        }

        .chat-input{
            border: 1px solid lightgray;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
            padding: 8px 10px;
        }
    </style>
<body>
    <div class="container">
        <div class="row">
            <div class="chat-content">
                <ul>
                    <li>BBABA</li>
                </ul>
            </div>

            <div class="chat-section">
                <div class="chat-box">
                    <div class="chat-input bg-white" id="chatInput" contenteditable="">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.socket.io/4.6.0/socket.io.min.js"
        integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous">
    </script>
    <script>
        $(function() {
            let ip_adress = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_adress + ':' + socket_port);
            let chatInput = $('#chatInput');

            chatInput.keypress(function(e){
                let message = $(this).html();
                // console.log(message);
                if (e.which === 13 && !e.shiftKey) {
                    socket.emit('sendChat',message);
                    chatInput.html('');
                    return false
                }
            });

            socket.on('sendChatToClient', (message) => {
                $('.chat-content ul').append('<li>' + message + '</li>');
            });
        })
    </script>
</body>

</html>
