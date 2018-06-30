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

class Customer extends AccountUtility{

    // Properties
    private $mysqli;

    public $customer_id;
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $profile_picture;
    public $status;
    public $gender;
    public $date_registered;

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
     * @param: Int $customer_id
     * @return: Array
     */
    final public function get(Int $customer_id){
        // Set prop
        $this->customer_id = $customer_id;
        // Prepare Statement
        $stmt = $this->mysqli->prepare("SELECT `customer_id`,`first_name`,`last_name`,`username`,`profile_picture`,`status`,`gender`,`date_registered` FROM `customer` WHERE `customer_id`=? LIMIT 1");
        // Bind Parameters
        $stmt->bind_param("i", $this->customer_id);
        // Execute query
        $stmt->execute();
        // Bind result        
        $stmt->bind_result($customer_id, $first_name, $last_name, $username, $profile_picture, $status, $gender, $date_registered);
        // Create empty arr
        $customer_info = array();
        // Fetch data
        while($stmt->fetch()){
            $customer_info = array(
                "customer_id"=>$customer_id,
                "first_name"=>$first_name,
                "last_name"=>$last_name,
                "username"=>$username,
                "profile_picture"=>$profile_picture,
                "status"=>$status,
                "gender"=>$gender,
                "date_registered"=>$date_registered
            );
        }
        // Return Result
        return $customer_info;
    }

    /**
     * getAll()
     * @param: none
     * @return: Array
     */
    final public function getAll(){
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
    final public function add(Array $array){
        return True;
    }

    /**
     * delete()
     * @param: Int $customer_id
     * @return: Bool
     */
    final public function delete(Int $customer_id){
        // Set as prop
        $this->id = $customer_id;
        
        // Prepare statement
        $stmt = $this->mysqli->prepare("DELETE FROM `customer` WHERE `customer_id`=?");
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
    final public function update($array){
        return True;
    }
    
}
?>