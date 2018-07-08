<?php
/**
 * RailTime
 * 2018
 * 
 * API
 * Class
 * 
 * Chatroom
 */

namespace RailTime;

class Chatroom {
    
    // Properties
    private $mysqli;

    public $chatroom_id;
    public $name;
    public $description;
    

    // Methods

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

    final public function get(Int $chatroom_id){
        if(empty($chatroom_id)) return "Chatroom ID is Required";
        $this->chatroom_id = strip_tags($chatroom_id);

        $stmt = $this->mysqli->prepare("SELECT * FROM `chatroom` WHERE `chatroom_id`=?");
        $stmt->bind_param("i",$this->chatroom_id);
        $stmt->execute();
        $stmt->bind_param($chatroom_id);

        $array = array();
        while($stmt->fetch()){

        }
    }

}
?>