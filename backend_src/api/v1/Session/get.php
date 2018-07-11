<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Session
 * 
 * get
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Check if parameter exists
if(empty($_POST['this_session_id'])) die(throwError("Session ID is Required"));

$session_id = strip_tags($_POST['this_session_id']);

$data = $session->get($session_id);

echo json_encode($data);
?>