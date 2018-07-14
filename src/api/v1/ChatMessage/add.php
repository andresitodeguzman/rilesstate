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
if(empty($_POST['chatroom_id'])) die(throwError("Chatroom ID is Required"));
if(empty($_POST['customer_id'])) die(throwError("Customer ID is Required"));
if(empty($_POST['body'])) die(throwError("Body is Required"));

// Create a var and sanitize
$chatroom_id = strip_tags($_POST['chatroom_id']);
$customer_id = strip_tags($_POST['customer_id']);
$body = strip_tags($_POST['body']);

$array = array(
    "chatroom_id"=>$chatroom_id,
    "customer_id"=>$customer_id,
    "body"=>$body
);

// Call the method
$data = $chatmessage->add($array);

echo json_encode($data);

?>