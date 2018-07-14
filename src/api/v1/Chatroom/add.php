<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Chatroom
 * 
 * add
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['name'])) die(throwError("Name is Required"));
$category = "";
$tags = "";
$code = "";
$description = "";
$image = "";

// Create a var and sanitize
$name = strip_tags($_POST['name']);
if(!empty($_POST['category'])) $category = strip_tags($_POST['category']);
if(!empty($_POST['tags'])) $tags = strip_tags($_POST['tags']);
if(!empty($_POST['code'])) $code = strip_tags($_POST['code']);
if(!empty($_POST['description'])) $description = strip_tags($_POST['description']);
if(!empty($_POST['image'])) $image = strip_tags($_POST['image']);

$array = array(
    "name"=>$name,
    "tags"=>$tags,
    "code"=>$code,
    "description"=>$description,
    "image"=>$image
);

// Call the methods
$data = $chatroom->add($array);

// Check if data is present or empty
if($data == True){
    echo json_encode(array("code"=>200,"message"=>"Chatroom created successfully"));
} else {
    throwError("Error while creating chatroom");
}

?> 