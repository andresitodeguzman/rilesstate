<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Forum
 * 
 * getAll
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Call the method
$data = $forum->getAll();

echo json_encode($data);

?> 