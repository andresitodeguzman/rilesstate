<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use RailTimeSocket\Chat;

require_once("vendor/autoload.php");
require_once("class/Chat.class.php");

$server = IoServer::factory(new HttpServer(
    new WsServer(
        new Chat()
    )
),8080);
$server->run();
?>