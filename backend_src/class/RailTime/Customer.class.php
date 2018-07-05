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

class Customer extends AccountUtility {

    // Properties
    private $mysqli;

    public $customer_id;
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $profile_picture;
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
        $stmt = $this->mysqli->prepare("SELECT `customer_id`,`first_name`,`last_name`,`username`,`profile_picture`,`gender`,`date_registered` FROM `customer` WHERE `customer_id`=? LIMIT 1");
        // Bind Parameters
        $stmt->bind_param("i", $this->customer_id);
        // Execute query
        $stmt->execute();
        // Bind result        
        $stmt->bind_result($customer_id, $first_name, $last_name, $username, $profile_picture, $gender, $date_registered);
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
                "gender"=>$gender,
                "date_registered"=>$date_registered
            );
        }
        // Return Result
        return $customer_info;
    }

    /**
     * getByUsername()
     * @param: String $username
     * @return: Array
     */
    final public function getByUsername(String $username){
        // Set Prop
        $this->username = $username;
        // Prepare Statement
        $stmt = $this->mysqli->prepare("SELECT `customer_id`,`first_name`,`last_name`,`username`,`profile_picture`,`gender`,`date_registered` FROM `customer` WHERE `username`=? LIMIT 1");
        // Bind Parameters
        $stmt->bind_param("s", $this->username);
        // Execute query
        $stmt->execute();
        // Bind result        
        $stmt->bind_result($customer_id, $first_name, $last_name, $username, $profile_picture, $gender, $date_registered);
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
        $query = "SELECT `customer_id`,`first_name`,`last_name`,`username`,`profile_picture`,`gender`,`date_registered` FROM `customer` LIMIT 50";

        // Create blank array
        $arr = array();

        // Do Query
        if($result = $this->mysqli->query($query)){
            // Loop along the results
            while($cust = $result->fetch_array()){
                $data = array(
                    'customer_id'=>$cust['customer_id'],
                    'first_name'=>$cust['first_name'],
                    'last_name'=>$cust['last_name'],
                    'username'=>$cust['username'],
                    'profile_picture'=>$cust['profile_picture'],
                    'gender'=>$cust['gender'],
                    'date_registered'=>$cust['date_registered']
                );
                $arr[] = $data;
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
        // Check for empty fields
        if(empty($array['first_name'])) return "First Name is Required";
        if(empty($array['last_name'])) return "Last Name is Required";
        if(empty($array['username'])) return "Username is Required";
        if(empty($array['password'])) return "Password is Required";
        if(!passwordValid($password)) return "Password Too Short or Too Weak";
        if($this->usernameExists($array['username'])) return "Username already in use";

        // Add to props
        $this->first_name = strip_tags($array['first_name']);
        $this->last_name = strip_tags($array['last_name']);
        $this->username = strip_tags($array['username']);
        $this->password = strip_tags($array['password']);
        if(!empty($array['profile_picture'])) $this->profile_picture = strip_tags($array['profile_picture']);
        if(!empty($array['gender'])) $this->gender = strip_tags($array['gender']);

        // Prepare and bind
        $stmt = $this->mysqli->prepare("INSERT INTO `customer`(`first_name`,`last_name`,`username`,`password`,`profile_picture`,`gender`) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss",$this->first_name,$this->last_name,$this->username,$this->password, $this->profile_picture, $this->gender);

        // Execute statement
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

    /**
     * usernameExists()
     * @param: String $username
     * @return: Bool
     */
    final public function usernameExists(String $username){
        // Prepare Statement
        $stmt = $this->mysqli->prepare("SELECT `customer_id` FROM `customer` WHERE `username`=? LIMIT 1");
        // Bind Parameters
        $stmt->bind_param("s", $username);
        // Execute
        $stmt->execute();

        // Bind Result
        $stmt->bind_result($uname);
        // Check
        while($stmt->fetch()){
            if($uname){
                return True;
            } else {
                return False;
            }
        }
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
    final public function updateBasic(Array $array){
        $this->customer_id = $array['customer_id'];
        $customer_info = $this->get($this->customer_id);
        if(empty($customer_info)) return "Customer does not exist";
        return True;
    }

    /**
     * updateUsername()
     * @param: Array $array
     * @return: Bool
     */
    final public function updateUsername(Array $array){
        // Set props
        $this->customer_id = $array['customer_id'];
        $this->username = $this->usernameSanitize($array['username']);

        // Get current username and check if different
        $customer_info = $this->get($customer_id);
        if($customer_info['username'] == $username) return False;

        // Prepare Statement
        $stmt = $this->mysqli->prepare("UPDATE `customer` SET `username`=? WHERE `customer_id`=?");
        // Bind Paramaters
        $stmt->bind_param("si", $this->username, $this->customer_id);

        // Execute Query
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

    /**
     * updatePassword()
     * @param: Array $array
     * @return: Bool
     */
    final public function updatePassword(Array $array){
        // Set props
        $this->customer_id = $array['customer_id'];
        // Check if valid passwwrd
        if($this->passwordValid($array['password']) == False) return False;

        // Set props
        $password = $array['password'];
        // Hash Password
        $this->password = $this->passwordHash($password);
        
        // Prepare Statement
        $stmt = $this->mysqli->prepare("UPDATE `customer` SET `password`=? WHERE `customer_id`=?");
        // Bind Parameters
        $stmt->bind_param("s", $this->password);

        // Execute Query
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }
    
}
?>