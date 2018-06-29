<?php
/**
 * RailTime
 * 2018
 * 
 * API
 * Class
 * 
 * Customer
 */

namespace RailTime;

class Customer {

    // Properties
    private $mysqli;

    public $customer_id;

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

    /**
     * get()
     * @param: Int $id
     * @return: Array
     */
    public function get(Int $id){
        return array();
    }

    /**
     * getAll()
     * @param: none
     * @return: Array
     */
    public function getAll(){
        return array();
    }

    /**
     * add()
     * @param: Array $array
     * @return: String/Bool
     */
    public function add(Array $array){
        return True;
    }

    /**
     * delete()
     * @param: Int $id
     * @return: Bool
     */
    public function delete(Int $id){
        return True;
    }

    /**
     * update()
     * @param: Array $array;
     * @return: String/Bool
     */
    public function update($array){
        return True;
    }
    
}
?>