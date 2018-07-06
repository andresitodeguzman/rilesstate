<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Customer
 * 
 * updateBasic
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['customer_id'])) die(throwError("ID is Required"));
if(empty($_POST['first_name'])) die(throwError("First Name is Required"));
if(empty($_POST['middle_name'])) $middle_name = "";
if(empty($_POST['last_name'])) die(throwError("Last Name is Required"));
if(empty($_POST['email'])) $email = "";
if(empty($_POST['mobile_number'])) $mobile_number = "";
if(empty($_POST['gender'])) $gender = "";

$customer_id = strip_tags($_POST['customer_id']);
$first_name = strip_tags($_POST['first_name']);
if(!empty($_POST['middle_name'])) $middle_name = strip_tags($_POST['middle_name']);
$last_name = strip_tags($_POST['last_name']);
if(!empty($_POST['email'])) $email = strip_tags($_POST['email']);
if(!empty($_POST['mobile_number'])) $mobile_number = strip_tags($_POST['mobile_number']);
if(!empty($_POST['gender'])) strip_tags($gender = $_POST['gender']);

$array = array(
    "customer_id"=>$customer_id,
    "first_name"=>$first_name,
    "middle_name"=>$middle_name,
    "last_name"=>$last_name,
    "email"=>$email,
    "mobile_number"=>$mobile_number,
    "gender"=>$gender
);

// Call the method
$data = $customer->updateBasic($array);

// Check if data is present or empty
if($data !== True){
    throwError($data);
} else {
    echo json_encode(
        array(
            "code"=>"200",
            "message"=>"Account edited successfully!"
        )
    );
}
?>