<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Admin
 * 
 * get
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['admin_id'])) die(throwError("ID is Required"));

// Create a var and sanitize
$id = strip_tags($_POST['admin_id']);

// Call the method
$data = $admin->get($id);

// Check if data is present or empty
if($data !== False){
    echo json_encode($data);
} else {
    echo throwError("Cannot find admin");
}

?> 