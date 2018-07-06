<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Customer
 * 
 * updatePassword
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['customer_id'])) die(throwError("ID is Required"));
if(empty($_POST['password'])) die(throwError("Password is Required"));

$customer_id = strip_tags($_POST['customer_id']);
$password = strip_tags($_POST['password']);

$array = array(
    "customer_id"=>$customer_id,
    "password"=>$password,
);

// Call the method
$data = $customer->updatePassword($array);

// Check if data is present or empty
if($data !== True){
    throwError($data);
} else {
    echo json_encode(
        array(
            "code"=>"200",
            "message"=>"Password edited successfully!"
        )
    );
}
?>