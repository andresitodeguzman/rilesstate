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

// Checks if all the required data has been sent
if(empty($_POST['message_id'])) die(throwError("Message ID is Required"));

// Create a var and sanitize
$message_id = strip_tags($_POST['message_id']);

// Call the method
$data = $chatmessage->delete($message_id);

// Check if data is present or empty
if($data == True){
    echo json_encode(array("code"=>200,"message"=>"Message deleted successfully!"));
} else {
    throwError("Cannot delete message");
}

?>