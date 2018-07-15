<<<<<<< HEAD:src/rt-serve.php
<?php
/**
 * RailTime
 * 2018
 * 
 * rt-serve
 */

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
require_once('class/RailTime/Chatroom.class.php');
require_once('class/RailTime/ChatMessage.class.php');

// Composer autoloader
require_once("vendor/autoload.php");

// Include Chat class
require_once("rsclass/RealTime.class.php");

// Declare the server var
$server = IoServer::factory(new HttpServer(
    new WsServer(
        new RealTime($mysqli)
    )
),9000);

// Run the server
$server->run();
=======
<?php
/**
 * RailTime
 * 2018
 * 
 * rt-serve
 */

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use RailTimeSocket\RealTime;

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
require_once('class/RailTime/Chatroom.class.php');
require_once('class/RailTime/ChatMessage.class.php');

// Composer autoloader
require_once("vendor/autoload.php");

// Include Chat class
require_once("rsclass/RealTime.class.php");

// Declare the server var
$server = IoServer::factory(new HttpServer(
    new WsServer(
        new RealTime($mysqli)
    )
),9000);

// Run the server
$server->run();
>>>>>>> 97abbe19e8a7027d7d50f3d506d3d9cc87fdf0f6:backend_src/rt-serve.php
?>