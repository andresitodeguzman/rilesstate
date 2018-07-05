<?php
/**
 * RailTime
 * 2018
 * 
 * API
 * Class
 * 
 * Station
 */

namespace RailTime;

class Station {

    private $mysqli;

    public $station_id;
    public $name;
    public $address;
    public $city;
    public $longitude;
    public $latitude;
    public $line;
    public $is_terminal;
    public $southbound_next;
    public $northbound_next;

    /**
     * __construct()
     * @param: $mysqli
     * @return: void
     * No need to declare public, constructors are public methods
     */
    function __construct($mysqli){
        // Return a message when mysqli object is not passed in the constructor
        if(!$mysqli) return "Mysqli connection is required";
        // Set the mysqli prop
        $this->mysqli = $mysqli;
    }

    final public function get(Int $station_id){
        if(empty($station_id)) return "Station ID is Required";
        $this->station_id = $station_id;

        $stmt = $this->mysqli->prepare("SELECT `station_id`,`name`,`address`,`city`,`longitude`,`latitude`,`line`,`is_terminal`,`southbound_next`,`northbound_next` FROM `station` WHERE `station_id`=? LIMIT 1");
        $stmt->bind_param("i", $this->station_id);
        $stmt->execute();

        $stmt->bind_result($station_id,$name,$address,$city,$longitude,$latitude,$line,$is_terminal,$southbound_next,$northbound_next);

        $station_arr = array();

        while($stmt->fetch()){
            $station_arr = array(
                "station_id"=>$station_id,
                "name"=>$name,
                "address"=>$address,
                "city"=>$city,
                "longitude"=>$longitude,
                "latitude"=>$latitude,
                "line"=>$line,
                "is_terminal"=>$is_terminal,
                "southbound_next"=>$southbound_next,
                "northbound_next"=>$northbound_next
            );
        }

        return $station_arr;
    }

}

?>