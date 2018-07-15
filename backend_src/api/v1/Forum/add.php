<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Forum
 * 
 * add
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

const FORUM_STATION_ID = "forum_station_id";
const FORUM_COMMENT = "forum_comment";
const FORUM_COMMENT_BY = "forum_comment_by";


// Checks if all the required data has been sent
if(empty($_POST[FORUM_COMMENT])) die(throwError("Forum Comment is Required"));

// Create a var and sanitize
$forum_station_id = strip_tags($_POST[FORUM_STATION_ID]);
$forum_comment = strip_tags($_POST[FORUM_COMMENT]);
$forum_comment_by = strip_tags($_POST[FORUM_COMMENT_BY]);

$array = array(
	FORUM_STATION_ID=>$forum_station_id,
    FORUM_COMMENT=>$forum_comment,
	FORUM_COMMENT_BY=>$forum_comment_by
);

// Call the methods
$data = $forum->add($array);

// Check if data is present or empty
if($data == True){
    echo json_encode(array("code"=>200,"message"=>"Forum created successfully"));
} else {
    throwError("Error while creating forum");
}

?> 