<?php
// List of allowed origins
$white_list = array(
    "127.0.0.1",
    "0.0.0.0",
    '::1'
);

// Check if in white list
if(!in_array($_SERVER['REMOTE_ADDR'],$white_list)){
    $msg = "Forbidden Request";
    header('Content-Type: application/json');
    header("HTTP/1.1 403 Error: '$msg'");
    $error = array(
        "code"=>"403",
        "message"=>$msg
    );
    die(json_encode($error));
}
?>