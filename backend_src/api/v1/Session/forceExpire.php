<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Session
 * 
 * forceExpire
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Check if parameter exists
if(empty($_POST['session_id'])) die(throwError("Session ID is Required"));

$session_id = strip_tags($_POST['session_id']);

$data = $session->forceExpire($session_id);

echo json_encode($data);
?>