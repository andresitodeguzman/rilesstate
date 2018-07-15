<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Survey
 * 
 * get
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

const SURVEY_ID = "survey_id";


// Checks if all the required data has been sent
if(empty($_POST[SURVEY_ID])) die(throwError("Survey ID is Required"));

// Create a var and sanitize
$survey_id = strip_tags($_POST[SURVEY_ID]);

// Call the method
$data = $survey->get($survey_id);

// Check if data is present or empty
if($data !== False){
    echo json_encode($data);
} else {
    throwError("Cannot find survey");
}

?> 