<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Forum
 * 
 * get
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

const FORUM_ID = "forum_id";


// Checks if all the required data has been sent
if(empty($_POST[FORUM_ID])) die(throwError("Forum ID is Required"));

// Create a var and sanitize
$forum_id = strip_tags($_POST[FORUM_ID]);

// Call the method
$data = $forum->get($forum_id);

// Check if data is present or empty
if($data !== False){
    echo json_encode($data);
} else {
    throwError("Cannot find forum");
}

?> 