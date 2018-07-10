<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Chatroom
 * 
 * deleteByChatroomId
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['chatroom_id'])) die(throwError("Chatroom ID is Required"));

// Create a var and sanitize
$chatroom_id = strip_tags($_POST['chatroom_id']);

// Call the method
$data = $chatmessage->deleteByChatroomId($chatroom_id);

// Check if data is present or empty
if($data == True){
    echo json_encode(array("code"=>200,"message"=>"Messages deleted successfully!"));
} else {
    throwError("Cannot delete messages");
}

?>