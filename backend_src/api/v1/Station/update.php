<?php
/**
 * RilesState
 * 2018
 * 
 * API
 * Station
 * 
 * add
 */

// Secure the API. Always include first.
require_once('../secure.php');

// Adds the DB connection and create Objects
require_once('../db.php');
require_once('../autoload.php');

// Checks if all the required data has been sent
if(empty($_POST['station_id'])) die(throwError("Station ID is Required"));
if(empty($_POST['name'])) die(throwError("Name is Required"));
if(empty($_POST['shortname'])) $shortname = "";
if(empty($_POST['address'])) $address = "";
if(empty($_POST['city'])) $city = "";
if(empty($_POST['latitude'])) $latitude = "";
if(empty($_POST['longitude'])) $longitude = "";
if(empty($_POST['line'])) $line = "";
if(empty($_POST['is_terminal'])) $is_terminal = "";
if(empty($_POST['southbound_next'])) $southbound_next = "";
if(empty($_POST['northbound_next'])) $northbound_next = "";
if(empty($_POST['position'])) $position = "";

// Create a var and sanitize.
$station_id = strip_tags($_POST['station_id']);
$name = strip_tags($_POST['name']);
if(!empty($_POST['shortname'])) $shortname = strip_tags($_POST['shortname']);
if(!empty($_POST['address'])) $address = strip_tags($_POST['address']);
if(!empty($_POST['city'])) $city = strip_tags($_POST['city']);
if(!empty($_POST['latitude'])) $latitude = strip_tags($_POST['latitude']);
if(!empty($_POST['longitude'])) $longitude = strip_tags($_POST['longitude']);
if(!empty($_POST['line'])) $line = strip_tags($_POST['line']);
if(!empty($_POST['is_terminal'])) $is_terminal = strip_tags($_POST['is_terminal']);
if(!empty($_POST['southbound_next'])) $southbound_next = strip_tags($_POST['southbound_next']);
if(!empty($_POST['northbound_next'])) $northbound_next = strip_tags($_POST['northbound_next']);
if(!empty($_POST['position'])) $position = strip_tags($_POST['position']);

$array = array(
    "station_id"=>$station_id,
    "name"=>$name,
    "address"=>$address,
    "city"=>$city,
    "latitude"=>$latitude,
    "longitude"=>$longitude,
    "line"=>$line,
    "is_terminal"=>$is_terminal,
    "southbound_next"=>$southbound_next,
    "northbound_next"=>$northbound_next,
    "position"=>$position
);

// Call the method
$data = $station->update($array);

// Check if data is present or empty
if($data !== True){
    throwError($data);
} else {
    echo json_encode(
        array(
            "code"=>"200",
            "message"=>"Station edited successfully!"
        )
    );
}

?> 