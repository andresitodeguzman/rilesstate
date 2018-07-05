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

    public $customer_id = 0;
    public $first_name = "";
    public $middle_name = "";
    public $last_name = "";
    public $email = "";
    public $mobile_number = "";
    public $username = "";
    public $password = "";
    public $profile_picture = "";
    public $gender = "";
    public $date_registered = "";

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
        $stmt = $this->mysqli->prepare("SELECT `customer_id`,`first_name`,`middle_name`,`last_name`,`email`,`mobile_number`,`username`,`profile_picture`,`gender`,`date_registered` FROM `customer` WHERE `customer_id`=? LIMIT 1");
        // Bind Parameters
        $stmt->bind_param("i", $this->customer_id);
        // Execute query
        $stmt->execute();
        // Bind result        
        $stmt->bind_result($customer_id, $first_name, $middle_name, $last_name, $email, $mobile_number, $username, $profile_picture, $gender, $date_registered);
        // Create empty arr
        $customer_info = array();
        // Fetch data
        while($stmt->fetch()){
            $customer_info = array(
                "customer_id"=>$customer_id,
                "first_name"=>$first_name,
                "middle_name"=>$middle_name,
                "last_name"=>$last_name,
                "email"=>$email,
                "mobile_number"=>$mobile_number,
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
        $stmt = $this->mysqli->prepare("SELECT `customer_id`,`first_name`,`middle_name`,`last_name`,`email`,`mobile_number`,`username`,`profile_picture`,`gender`,`date_registered` FROM `customer` WHERE `customer_id`=? LIMIT 1");
        // Bind Parameters
        $stmt->bind_param("s", $this->username);
        // Execute query
        $stmt->execute();
        // Bind result        
        $stmt->bind_result($customer_id, $first_name, $middle_name, $last_name, $email, $mobile_number, $username, $profile_picture, $gender, $date_registered);
        // Create empty arr
        $customer_info = array();
        // Fetch data
        while($stmt->fetch()){
            $customer_info = array(
                "customer_id"=>$customer_id,
                "first_name"=>$first_name,
                "middle_name"=>$middle_name,
                "last_name"=>$last_name,
                "email"=>$email,
                "mobile_number"=>$mobile_number,
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
     * searchBy()
     * @param: String $category
     * @param: String $query
     * @return: Array
     */
    final public function searchBy(Array $array){
        if(empty($array['category'])) return "Category is Required";
        if(empty($array['query'])) return "Query is Required";
        $category = strip_tags($array['category']);
        $query = strip_tags($array['query']);

        $stmt = $this->mysqli->prepare("SELECT `customer_id`,`first_name`,`middle_name`,`last_name`,`email`,`mobile_number`,`username`,`profile_picture`,`gender`,`date_registered` FROM `customer` WHERE `?` LIKE `%?%` LIMIT 100");
        $stmt->bind_param("ss", $category, $query);

        // Execute query
        $stmt->execute();
        // Bind result        
        $stmt->bind_result($customer_id, $first_name, $middle_name, $last_name, $email, $mobile_number, $username, $profile_picture, $gender, $date_registered);
        // Create empty arr
        $customer_info = array();
        // Fetch data
        while($stmt->fetch()){
            $arr = array(
                "customer_id"=>$customer_id,
                "first_name"=>$first_name,
                "middle_name"=>$middle_name,
                "last_name"=>$last_name,
                "email"=>$email,
                "mobile_number"=>$mobile_number,
                "username"=>$username,
                "profile_picture"=>$profile_picture,
                "gender"=>$gender,
                "date_registered"=>$date_registered
            );
            $customer_info[] = $arr;
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
        $query = "SELECT `customer_id`,`first_name`,`middle_name`,`last_name`,`email`,`mobile_number`,`username`,`profile_picture`,`gender`,`date_registered` FROM `customer` LIMIT 100";

        // Create blank array
        $arr = array();

        // Do Query
        if($result = $this->mysqli->query($query)){
            // Loop along the results
            while($cust = $result->fetch_array()){
                $data = array(
                    'customer_id'=>$cust['customer_id'],
                    'first_name'=>$cust['first_name'],
                    'middle_name'=>$cust['middle_name'],
                    'last_name'=>$cust['last_name'],
                    'email'=>$cust['email'],
                    'mobile_number'=>$cust['mobile_number'],
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
        if($this->passwordValid($password)){
            $a = 1;
        } else {
            return "Password Too Short or Too Weak";
        }    
        if($this->usernameExists($array['username'])) return "Username already in use";

        // Add to props
        $this->first_name = strip_tags($array['first_name']);
        if(!empty($array['middle_name'])) $this->middle_name = strip_tags($array['middle_name']);
        $this->last_name = strip_tags($array['last_name']);
        if(!empty($array['email'])) $this->email = strip_tags($array['email']);
        if(!empty($array['mobile_number'])) $this->mobile_number = strip_tags($array['mobile_number']);
        $this->username = strip_tags($array['username']);
        $this->password = $this->passwordHash(strip_tags($array['password']));
        if(!empty($array['gender'])) $this->gender = strip_tags($array['gender']);

        // Prepare and bind
        $stmt = $this->mysqli->prepare("INSERT INTO `customer`(`first_name`,`middle_name`,`last_name`,`email`,`mobile_number`,`username`,`password`,`gender`) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss",$this->first_name,$this->middle_name,$this->last_name,$this->email,$this->mobile_number,$this->username,$this->password, $this->gender);

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
        // Check for empty fields
        if(empty($customer_info)) return "Customer does not exist";
        if(empty($array['first_name'])) return "First Name is Required";
        if(empty($array['last_name'])) return "Last Name is Required";

        $this->first_name = $array['first_name'];
        if(!empty($array['middle_name'])) $this->middle_name = $array['middle_name'];
        $this->last_name = $array['last_name'];
        if(!empty($array['email'])) $this->email = $array['email'];
        if(!empty($array['mobile_number'])) $this->mobile_number = $array['mobile_number'];

        $stmt = $this->mysqli->prepare("UPDATE `customer` SET `first_name`=?, `middle_name`=?, `last_name`=?, `email`=?, `mobile_number`=? WHERE `customer_id`=?");
        $stmt->bind_param("sssssi",$this->first_name, $this->middle_name, $this->last_name, $this->email, $this->mobile_number,$this->customer_id);

        if($stmt->execute()){
            return True;
             
        } else {
            return False;
        }
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
        $customer_info = $this->get($this->customer_id);
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
        $stmt->bind_param("si", $this->password, $this->customer_id);

        // Execute Query
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

    final function verifyLogin(Array $array){
        if(empty($array['username'])) return "Username is Required";
        if(empty($array['password'])) return "Password is Required";

        $this->username = $array['username'];
        $this->password = $array['password'];

        if($this->usernameExists($this->username) == True){
            $hash_password = $this->getPasswordByUsername($this->username);
            if($this->passwordVerify($this->password,$hash_password) == True){
                return $this->getByUsername($this->username);
            } else {
                return "Passsword is incorrect";
            }
        } else {
            return "Account does not exist";
        }
    }

    final private function getPasswordByUsername(String $username){
        $stmt = $this->mysqli->prepare("SELECT `password` FROM `customer` WHERE `username`=? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($password);
        
        while($stmt->fetch()){
            return $password;
        }
    }
    
}
?>