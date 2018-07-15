<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * admin
 * 
 * add
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['first_name'])) die(throwError("First Name is Required"));
if(empty($_POST['middle_name'])) $middle_name = "";
if(empty($_POST['last_name'])) die(throwError("Last Name is Required"));
if(empty($_POST['department'])) $department = "";
if(empty($_POST['position'])) $position = "";
if(empty($_POST['gender'])) $gender = "";
if(empty($_POST['email'])) $email = "";
if(empty($_POST['mobile_number'])) $mobile_number = "";
if(empty($_POST['username'])) die(throwError("Username is Required"));
if(empty($_POST['password'])) die(throwError("Password is Required"));


// Create a var and sanitize.
$first_name = strip_tags($_POST['first_name']);
if(!empty($_POST['middle_name'])) $middle_name = strip_tags($_POST['middle_name']);
$last_name = strip_tags($_POST['last_name']);
if(!empty($_POST['department'])) $department = strip_tags($_POST['department']);
if(!empty($_POST['position'])) $position = strip_tags($_POST['position']);
if(!empty($_POST['gender'])) $gender = strip_tags($_POST['gender']);
if(!empty($_POST['email'])) $email = strip_tags($_POST['email']);
if(!empty($_POST['mobile_number'])) $mobile_number = strip_tags($_POST['mobile_number']);
$username = strip_tags($_POST['username']);
$password = strip_tags($_POST['password']);

$array = array(
    "first_name"=>$first_name,
    "middle_name"=>$middle_name,
    "last_name"=>$last_name,
    "department"=>$department,
    "position"=>$position,
    "gender"=>$gender,
    "email"=>$email,
    "mobile_number"=>$mobile_number,
    "username"=>$username,
    "password"=>$password
);

// Call the method
$data = $admin->add($array);

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