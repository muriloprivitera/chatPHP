<?php

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
// use src\ChatComponent;
use src\ChatComponent;

    require_once(__DIR__.'/vendor/autoload.php');

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new ChatComponent())
        ),
        8080
    );

    $server->run();
?>