<?php
/**
 * RailTime
 * 2018
 * 
 * API
 * Class
 * 
 * Badge
 */

namespace RailTime;

final class Badge {
    
    // Properties
    private $mysqli;

    public $badge_id;
    public $name;
    public $description;
    public $image;
    

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

}
?>