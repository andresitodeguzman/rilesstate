<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Admin
 * 
 * getByUsername
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['username'])) die(throwError("Username is Required"));

// Create a var and sanitize
$username = strip_tags($_POST['username']);

// Call the method
$data = $admin->getByUsername($username);

// Check if data is present or empty
if($data !== False){
    echo json_encode($data);
} else {
    echo throwError("Cannot find admin");
}

?> 