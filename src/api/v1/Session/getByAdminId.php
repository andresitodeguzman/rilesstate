<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Session
 * 
 * getByAdminId
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Check if parameter exists
if(empty($_POST['admin_id'])) die(throwError("Admin ID is Required"));

$admin_id = strip_tags($_POST['admin_id']);

$data = $session->getByAdminId($admin_id);

echo json_encode($data);
?>