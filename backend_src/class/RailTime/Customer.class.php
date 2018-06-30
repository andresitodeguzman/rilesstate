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
        // Make query
        $query = "SELECT * FROM `customer` LIMIT 50";

        // Create blank array
        $arr = array();

        // Do Query
        if($result = $this->mysqli->query($query)){
            // Loop along the results
            while($cust = $result->fetch_array()){
                $arr[] = $cust;
            }
        }

        // Return final result
        return $arr;
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
        // Set as prop
        $this->id = $id;
        
        // Prepare statement
        $stmt = $this->mysqli->prepare("DELETE FROM `customer` WHERE `id`=?");
        // Bind parameters
        $stmt->bind_param("i",$this->id);

        // Execute query
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
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