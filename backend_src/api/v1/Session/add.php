<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Session
 * 
 * add
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');
$customer_id = "";
$admin_id = "";

if(!empty($_POST['customer_id'])) $customer_id = $_POST['customer_id'];
if(!empty($_POST['admin_id'])) $admin_id = $_POST['admin_id'];

$array = array(
    "customer_id"=>$customer_id,
    "admin_id"=>$admin_id,
    "ip_address"=>getUserIP()
);

$data = $session->array($array);

if($data == False){
    throwError("An Error Occurred");
} else {
    echo json_encode(array("code"=>200,"message"=>"OK","session_id"=>$data));
}
?>