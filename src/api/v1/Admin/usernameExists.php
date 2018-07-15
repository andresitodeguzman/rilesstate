<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Admin
 * 
 * usernameExists
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

if(empty($_POST['username'])) throwError("Username is Required");

$username = strip_tags($_POST['username']);

// Call the method
$data = $admin->usernameExists($username);

// Check if data is present or empty
if($data == True){
    $data = array(
        "username"=>$username,
        "exists"=>True
    );
    echo json_encode($data);
} else {
    $data = array(
        "username"=>$username,
        "exists"=>False
    );
    echo json_encode($data);
}

?> 