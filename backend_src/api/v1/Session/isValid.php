<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Customer
 * 
 * add
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Check if parameter exists
if(empty($_POST['session_id'])) die(throwError("Session ID is Required"));

$session_id = strip_tags($_POST['session_id']);

$data = $session->isValid($session_id);

if($data == True){
    echo json_encode(array("code"=>200,"message"=>$data));
} else {
    echo json_encode(array("code"=>200,"message"=>$data));
}
?>