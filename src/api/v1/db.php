<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * DB
 * 
 * All the scripts needed for the database should be prepared here
 */

// Include the config file (Important)
require_once("../../../_system/config.php");

// Set the default timezone to Manila to prevent wrong time/date
date_default_timezone_set("Asia/Manila");

// Create mysqli object to be passed onto the classes
$mysqli = new mysqli($mysqli_host, $mysqli_username, $mysqli_password, $mysqli_database);

// Set  header type as JSON for rendering results
header('Content-Type: application/json');

// Function that will be called when empty or an error occurred
function throwError(String $msg){
    if(empty($msg)) $msg = "An Unknown Error Occurred";
    header("HTTP/1.1 500 Error: '$msg'");
    $error = array(
        "code"=>"500",
        "message"=>$msg
    );
    die(json_encode($error));
}

?>