<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Customer
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

$username = $_POST['username'];
$password = $_POST['password'];

$array = array(
    "username"=>$username,
    "password"=>$password,
);

// Call the method
$data = $customer->verifyLogin($array);

if($data['code'] == 200){
    echo json_encode($data);
} else {
    throwError($data['message']);
}

?>