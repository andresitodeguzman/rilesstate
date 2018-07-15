<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Announcement
 * 
 * get
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['announcement_id'])) die(throwError("Announcement ID is Required"));

// Create a var and sanitize
$announcement_id = strip_tags($_POST['announcement_id']);

// Call the method
$data = $announcement->get($announcement_id);

// Check if data is present or empty
if($data !== False){
    echo json_encode($data);
} else {
    throwError("Cannot find announcement");
}

?> 