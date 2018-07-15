<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Customer
 * 
 * searchBy
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['category'])) die(throwError("Category is Required"));
if(empty($_POST['query'])) die(throwError("Query is Required"));

// Create a var and sanitize.
$category = strip_tags($_POST['category']);
$query = strip_tags($_POST['query']);

$array = array(
    "category"=>$category,
    "query"=>$query
);

// Call the method
$data = $customer->searchBy($array);

echo $data;

?> 