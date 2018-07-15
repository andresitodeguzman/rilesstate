<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Survey
 * 
 * update
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

const SURVEY_ID = "survey_id";
const SURVEY_QUESTION = "survey_question";
const SURVEY_CHOICES = "survey_choices";


// Checks if all the required data has been sent
if(empty($_POST[SURVEY_ID])) die(throwError("Survey ID is Required"));
if(empty($_POST[SURVEY_QUESTION])) die(throwError("Survey Question is Required"));
if(empty($_POST[SURVEY_CHOICES])) die(throwError("Survey Choices is Required"));

// Create a var and sanitize
$survey_id = strip_tags($_POST[SURVEY_ID]);
$survey_question = strip_tags($_POST[SURVEY_QUESTION]);
$survey_choices = strip_tags($_POST[SURVEY_CHOICES]);

$array = array(
    SURVEY_ID=>$survey_id,
    SURVEY_QUESTION=>$survey_question,
    SURVEY_CHOICES=>$survey_choices
);

// Call the methods
$data = $survey->update($array);

// Check if data is present or empty
if($data == True){
    echo json_encode(array("code"=>200,"message"=>"Survey edited successfully"));
} else {
    throwError("Error while editing survey");
}

?> 