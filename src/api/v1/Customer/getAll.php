<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Customer
 * 
 * getAll  
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Call the method
$data = $customer->getAll();

// Check if data is present or empty
if($data !== False){
    echo json_encode($data);
} else {
    throwError($data);
}

?> 