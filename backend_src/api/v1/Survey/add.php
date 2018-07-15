<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Survey
 * 
 * add
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

const SURVEY_QUESTION = "survey_question";
const SURVEY_CHOICES = "survey_choices";
const SURVEY_ADDED_BY = "survey_added_by";


// Checks if all the required data has been sent
if(empty($_POST[SURVEY_QUESTION])) die(throwError("Survey Question is Required"));
if(empty($_POST[SURVEY_CHOICES])) die(throwError("Survey Choices is Required"));

// Create a var and sanitize
$survey_question = strip_tags($_POST[SURVEY_QUESTION]);
$survey_choices = strip_tags($_POST[SURVEY_CHOICES]);
$survey_added_by = strip_tags($_POST[SURVEY_ADDED_BY]);

$array = array(
    SURVEY_QUESTION=>$survey_question,
    SURVEY_CHOICES=>$survey_choices,
    SURVEY_ADDED_BY=>$survey_added_by
);

// Call the methods
$data = $survey->add($array);

// Check if data is present or empty
if($data == True){
    echo json_encode(array("code"=>200,"message"=>"Survey created successfully"));
} else {
    throwError("Error while creating survey");
}

?> 