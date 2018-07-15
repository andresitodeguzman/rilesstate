<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Forum
 * 
 * update
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

const FORUM_ID = "forum_id";
const FORUM_COMMENT = "forum_comment";


// Checks if all the required data has been sent
if(empty($_POST[FORUM_ID])) die(throwError("Forum ID is Required"));
if(empty($_POST[FORUM_COMMENT])) die(throwError("Forum Comment is Required"));

// Create a var and sanitize
$forum_id = strip_tags($_POST[FORUM_ID]);
$forum_comment = strip_tags($_POST[FORUM_COMMENT]);

$array = array(
    FORUM_ID=>$forum_id,
    FORUM_COMMENT=>$forum_comment
);

// Call the methods
$data = $forum->update($array);

// Check if data is present or empty
if($data == True){
    echo json_encode(array("code"=>200,"message"=>"Forum edited successfully"));
} else {
    throwError("Error while editing forum");
}

?> 