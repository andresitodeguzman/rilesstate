<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use RailTimeSocket\Chat;

// Include the config file (Important)
require_once("_system/config.php");

// Set the default timezone to Manila to prevent wrong time/date
date_default_timezone_set("Asia/Manila");

// Create mysqli object to be passed onto the classes
$mysqli = new mysqli($mysqli_host, $mysqli_username, $mysqli_password, $mysqli_database);

// Require files instead of using an autoloader (more stable)
require_once('class/RailTime/AccountUtility.class.php');
require_once('class/RailTime/Customer.class.php');
require_once('class/RailTime/Session.class.php');

require_once("vendor/autoload.php");
require_once("wsclass/Chat.class.php");

$server = IoServer::factory(new HttpServer(
    new WsServer(
        new Chat($mysqli)
    )
),8080);
$server->run();
?>