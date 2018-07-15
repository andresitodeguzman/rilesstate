<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Chatroom
 * 
 * delete
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');
require_once('../constants.php');

// Checks if all the required data has been sent
if(empty($_POST[ANNOUNCEMENT_ID])) die(throwError("Announcement ID is Required"));

// Create a var and sanitize
$announcement_id = strip_tags($_POST[ANNOUNCEMENT_ID]);

// Call the methods
$data = $announcement->delete($announcement_id);

// Check if data is present or empty
if($data !== False){
    echo json_encode(array("code"=>200,"message"=>"Announcement deleted successfully"));
} else {
    throwError("Error while deleting announcement");
}

?> 