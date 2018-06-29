<?php
date_default_timezone_set("Asia/Manila");

$mysqli = new mysqli($mysqli_host, $mysqli_username, $mysqli_password, $mysqli_database);

header('Content-Type: application/json');

function throwError(String $msg){
    if(empty($msg)) $msg = "An Unknown Error Occurred";
    $error = array(
        "code"=>"500",
        "message"=>$msg
    );
    die($error);
}

?>