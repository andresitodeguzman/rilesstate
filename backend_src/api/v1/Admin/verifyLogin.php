<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Admin
 * 
 * verifyPassword
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['username'])) die(throwError("Username is Required"));
if(empty($_POST['password'])) die(throwError("Password is Required"));

$username = strip_tags($_POST['username']);
$password = strip_tags($_POST['password']);

$array = array(
    "username"=>$username,
    "password"=>$password,
);

// Call the method
$data = $admin->verifyLogin($array);

if($data['code'] == 200){
    $array = array(
        "admin_id"=>$data['message']['admin_id'],
        "ip_address"=>getUserIP()
    );
    $session_data = $session->add($array);
    echo json_encode(array("code"=>200,"session"=>$session_data,"admin"=>$data['message']));
} else {
    throwError($data['message']);
}

?>