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
if(empty($_POST['announcement_id'])) die(throwError("Announcement ID is Required"));
if(empty($_POST['announcement_caption'])) die(throwError("Announcement Caption is Required"));

// Create a var and sanitize
$announcement_id = strip_tags($_POST['announcement_id']);
$announcement_caption = strip_tags($_POST['announcement_caption']);

$array = array(
    "announcement_id"=>$announcement_id,
    "announcement_caption"=>$announcement_caption
);

// Call the methods
$data = $announcement->update($array);

// Check if data is present or empty
if($data == True){
    echo json_encode(array("code"=>200,"message"=>"Announcement edited successfully"));
} else {
    throwError("Error while editing announcement");
}

?> 