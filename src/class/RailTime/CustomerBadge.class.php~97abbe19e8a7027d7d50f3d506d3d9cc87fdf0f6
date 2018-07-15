<?php
/**
 * RailTime
 * 2018
 * 
 * API
 * Class
 * 
 * CustomerBadge
 */

namespace RailTime;

final class CustomerBadge {
    
    // Properties
    private $mysqli;

    public $customerbadge_id;
    public $customer_id;
    public $badge_id;
    public $notes;
    public $date_earned;

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