<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Customer
 * 
 * delete
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['customer_id'])) die(throwError("ID is Required"));

// Create a var and sanitize.
$id = strip_tags($_POST['customer_id']);

// Call the method
$data = $customer->delete($id);

// Check if data is present or empty
if($data !== False){
    echo json_encode(
        array(
            "code"=>"200",
            "message"=>"Customer info deleted successfully!"
        )
    );
} else {
    echo throwError("Cannot find customer");
}

?> 