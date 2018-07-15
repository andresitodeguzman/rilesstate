<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Customer
 * 
 * add
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
$first_name = "";
$middle_name = "";
$last_name = "";
$address = "";
$status = "";
$email = "";
$mobile_number = "";
$gender = "";
$dev_share_stats = "";
if(empty($_POST['username'])) die(throwError("Username is Required"));
if(empty($_POST['password'])) die(throwError("Password is Required"));

// Create a var and sanitize.
if(!empty($_POST['first_name'])) $first_name = strip_tags($_POST['first_name']);
if(!empty($_POST['middle_name'])) $middle_name = strip_tags($_POST['middle_name']);
if(!empty($_POST['last_name'])) $last_name = strip_tags($_POST['last_name']);
if(!empty($_POST['address'])) $address = strip_tags($_POST['address']);
if(!empty($_POST['status'])) $status = strip_tags($_POST['status']);
if(!empty($_POST['email'])) $email = strip_tags($_POST['email']);
if(!empty($_POST['mobile_number'])) $mobile_number = strip_tags($_POST['mobile_number']);
$username = strip_tags($_POST['username']);
$password = strip_tags($_POST['password']);
if(!empty($_POST['gender'])) $gender = strip_tags($_POST['gender']);
if(!empty($_POST['dev_share_stats'])) $dev_share_stats = strip_tags($_POST['dev_share_stats']);


$array = array(
    "first_name"=>$first_name,
    "middle_name"=>$middle_name,
    "last_name"=>$last_name,
    "address"=>$address,
    "status"=>$status,
    "email"=>$email,
    "mobile_number"=>$mobile_number,
    "username"=>$username,
    "password"=>$password,
    "gender"=>$gender,
    "dev_share_stats"=>$dev_share_stats
);

// Call the method
$data = $customer->add($array);

// Check if data is present or empty
if($data !== True){
    throwError($data);
} else {
    echo json_encode(
        array(
            "code"=>"200",
            "message"=>"Account created successfully!"
        )
    );
}

?> 