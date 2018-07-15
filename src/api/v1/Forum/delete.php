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

const FORUM_ID = "forum_id";


// Checks if all the required data has been sent
if(empty($_POST[FORUM_ID])) die(throwError("Forum ID is Required"));

// Create a var and sanitize
$forum_id = strip_tags($_POST[FORUM_ID]);

// Call the methods
$data = $forum->delete($forum_id);

// Check if data is present or empty
if($data !== False){
    echo json_encode(array("code"=>200,"message"=>"Forum deleted successfully"));
} else {
    throwError("Error while deleting forum");
}

?> 