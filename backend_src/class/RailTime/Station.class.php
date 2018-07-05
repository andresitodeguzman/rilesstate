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
    public $shortname;
    public $address;
    public $city;
    public $latitude;
    public $longitude;
    public $line;
    public $is_terminal;
    public $southbound_next;
    public $northbound_next;
    public $position;

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

        $stmt = $this->mysqli->prepare("SELECT `station_id`,`name`,`shortname`,`address`,`city`,`latitude`,`longitude`,`line`,`is_terminal`,`southbound_next`,`northbound_next`,`position` FROM `station` WHERE `station_id`=? LIMIT 1");
        $stmt->bind_param("i", $this->station_id);
        $stmt->execute();

        $stmt->bind_result($station_id,$name,$shortname,$address,$city,$latitude,$longitude,$line,$is_terminal,$southbound_next,$northbound_next,$position);

        $station_arr = array();

        while($stmt->fetch()){
            $station_arr = array(
                "station_id"=>$station_id,
                "name"=>$name,
                "shortname"=>$shortname,
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
        }

        return $station_arr;
    }

    final public function getAll(){
        $query = "SELECT `station_id`,`name`,`shortname`,`address`,`city`,`latitude`,`longitude`,`line`,`is_terminal`,`southbound_next`,`northbound_next`,`position` FROM `station`";

        $arr = array();

        if($result = $this->mysqli->query($query)){
            while($st = $result->fetch_array()){
                $data = array(
                    "station_id"=>$st['station_id'],
                    "name"=>$st['name'],
                    "shortname"=>$st['shortname'],
                    "address"=>$st['address'],
                    "city"=>$st['city'],
                    "latitude"=>$st['latitude'],
                    "longitude"=>$st['longitude'],
                    "line"=>$st['line'],
                    "is_terminal"=>$st['is_terminal'],
                    "southbound_next"=>$st['southbound_next'],
                    "northbound_next"=>$st['northbound_next'],
                    "position"=>$st['position']
                );

                $arr[] = $data; 
            }
        }

        return $arr;
    }

    final public function delete(Int $station_id){
        if(empty($station_id)) return "Station ID is Required";
        $this->station_id = $station_id;

        $stmt = $this->mysqli->prepare("DELETE FROM `station` WHERE `station_id`=? LIMIT 1");
        $stmt->bind_param("i", $this->station_id);

        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

    final public function add(Array $array){
        if(empty($array['name'])) return "Name is Required";
        
        $this->name = strip_tags($array['name']);
        if(!empty($array['shortname'])) $this->shortname = strip_tags($array['shortname']);
        if(!empty($array['address'])) $this->address = strip_tags($array['address']);
        if(!empty($array['city'])) $this->city = strip_tags($array['city']);
        if(!empty($array['latitude'])) $this->latitude = strip_tags($array['latitude']);
        if(!empty($array['longitude'])) $this->longitude = strip_tags($array['longitude']);
        if(!empty($array['line'])) $this->line = strip_tags($array['line']);
        if(!empty($array['is_terminal'])) $this->is_terminal = strip_tags($array['is_terminal']);
        if(!empty($array['southbound_next'])) $this->southbound_next = strip_tags($array['southbound_next']);
        if(!empty($array['northbound_next'])) $this->northbound_next = strip_tags($array['northbound_next']);
        if(!empty($array['position'])) $this->position = strip_tags($array['position']);

        $stmt = $this->mysqli->prepare("INSERT INTO `station`(`name`,`shortname`,`address`,`city`,`latitude`,`longitude`,`line`,`is_terminal`,`southbound_next`,`northbound_next`,`position`) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssisssi",
            $this->name,
            $this->shortname,
            $this->address,
            $this->city,
            $this->latitude,
            $this->longitude,
            $this->line,
            $this->is_terminal,
            $this->southbound_next,
            $this->northbound_next,
            $this->position
        );
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }

    }

    final public function update(Array $array){
        if(empty($array['station_id'])) return "Station ID is Required";
        if(empty($array['name'])) return "Name is Required";
        
        $this->station_id = strip_tags($array['station_id']);
        $this->name = strip_tags($array['name']);
        if(!empty($array['shortname'])) $this->shortname = strip_tags($array['shortname']);
        if(!empty($array['address'])) $this->address = strip_tags($array['address']);
        if(!empty($array['city'])) $this->city = strip_tags($array['city']);
        if(!empty($array['latitude'])) $this->latitude = strip_tags($array['latitude']);
        if(!empty($array['longitude'])) $this->longitude = strip_tags($array['longitude']);
        if(!empty($array['line'])) $this->line = strip_tags($array['line']);
        if(!empty($array['is_terminal'])) $this->is_terminal = strip_tags($array['is_terminal']);
        if(!empty($array['southbound_next'])) $this->southbound_next = strip_tags($array['southbound_next']);
        if(!empty($array['northbound_next'])) $this->northbound_next = strip_tags($array['northbound_next']);
        if(!empty($array['position'])) $this->position = strip_tags($array['position']);

        $stmt = $this->mysqli->prepare("UPDATE `station` SET WHERE `station_id`=?");
        $stmt->bind_param("ssssssisssi",
            $this->name,
            $this->shortname,
            $this->address,
            $this->city,
            $this->latitude,
            $this->longitude,
            $this->line,
            $this->is_terminal,
            $this->southbound_next,
            $this->northbound_next,
            $this->position
        );
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

}

?>