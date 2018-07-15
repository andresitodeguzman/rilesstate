<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Survey
 * 
 * delete
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');
require_once('../constants.php');

const SURVEY_ID = "survey_id";


// Checks if all the required data has been sent
if(empty($_POST[SURVEY_ID])) die(throwError("Survey ID is Required"));

// Create a var and sanitize
$survey_id = strip_tags($_POST[SURVEY_ID]);

// Call the methods
$data = $survey->delete($survey_id);

// Check if data is present or empty
if($data !== False){
    echo json_encode(array("code"=>200,"message"=>"Survey deleted successfully"));
} else {
    throwError("Error while deleting survey");
}

?> 