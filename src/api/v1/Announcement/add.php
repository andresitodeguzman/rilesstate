<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Announcement
 * 
 * add
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['announcement_caption'])) die(throwError("Announcement Caption is Required"));
$announcement_date = "";

// Create a var and sanitize
$name = strip_tags($_POST['announcement_caption']);

$array = array(
    'announcement_caption'=>$announcement_caption,
    "announcement_date"=>$announcement_date
);

// Call the methods
$data = $announcement->add($array);

// Check if data is present or empty
if($data == True){
    echo json_encode(array("code"=>200,"message"=>"Announcement created successfully"));
} else {
    throwError("Error while creating announcement");
}

?> 