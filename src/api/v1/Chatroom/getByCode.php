<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Chatroom
 * 
 * getByCode
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['code'])) die(throwError("Code is Required"));

// Create a var and sanitize
$code = strip_tags($_POST['code']);

// Call the method
$data = $chatroom->getByCode($code);

// Check if data is present or empty
if($data !== False){
    echo json_encode($data);
} else {
    throwError("Cannot find chatroom");
}

?> 