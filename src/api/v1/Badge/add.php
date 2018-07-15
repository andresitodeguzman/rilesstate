<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Badge
 * 
 * add
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['name'])) throwError("Name is Required");
$description = "";
$category = "";
$publisher = "";
$image = "";

// Create a var and sanitize.
$name = strip_tags($_POST['name']);
if(!empty($_POST['description'])) $description = strip_tags($_POST['description']);
if(!empty($_POST['category'])) $category = strip_tags($_POST['category']);
if(!empty($_POST['publisher'])) $publisher = strip_tags($_POST['publisher']);
if(!empty($_POST['image'])) $image = strip_tags($_POST['image']);

$array = array(
    "name"=>$name,
    "description"=>$description,
    "category"=>$category,
    "publisher"=>$publisher,
    "image"=>$image
);

// Call the method
$data = $badge->add($array);

// Check if data is present or empty
if($data !== True){
    throwError($data);
} else {
    echo json_encode(
        array(
            "code"=>"200",
            "message"=>"Badge added successfully!"
        )
    );
}

?> 