<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Session
 * 
 * getByCustomerId
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Check if parameter exists
if(empty($_POST['customer_id'])) die(throwError("Customer ID is Required"));

$customer_id = strip_tags($_POST['customer_id']);

$data = $session->getByCustomerId($customer_id);

echo json_encode($data);
?>