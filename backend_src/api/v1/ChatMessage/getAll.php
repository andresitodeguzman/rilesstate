<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Chatroom
 * 
 * get
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Call the method
$data = $chatmessage->getAll();

echo json_encode($data);
?>