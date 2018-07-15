<?php
/**
 * RailTime
 * 2018
 * 
 * API
 * Class
 * 
 * Admin
 */

namespace RailTime;

final class Admin extends AccountUtility {

    // Properties
    private $mysqli;

    public $admin_id = 0;
    public $first_name = "";
    public $middle_name = "";
    public $last_name = "";
    public $address = "";
    public $status = "";
    public $department = "";
    public $position = "";
    public $gender = "";
    public $email = "";
    public $mobile_number = "";
    public $profile_picture = "";
    public $username = "";
    public $password = "";
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
     * @param: Int $admin_id
     * @return: Array
     */
    final public function get(Int $admin_id){
        $this->admin_id = strip_tags($admin_id);

        $stmt = $this->mysqli->prepare("SELECT `admin_id`,`first_name`,`middle_name`,`last_name`,`address`,`status`,`department`,`position`,`gender`,`email`,`mobile_number`,`profile_picture`,`username`,`date_registered` FROM `admin` WHERE `admin_id`=? LIMIT 1");
        $stmt->bind_param("i",$this->admin_id);

        $stmt->execute();
        $stmt->bind_result($admin_id,$first_name,$middle_name,$last_name,$address,$status,$department,$position,$gender,$email,$mobile_number,$profile_picture,$username,$date_registered);

        $array = array();

        while($stmt->fetch()){
            $array = array(
                "admin_id"=>$admin_id,
                "first_name"=>$first_name,
                "middle_name"=>$middle_name,
                "last_name"=>$last_name,
                "address"=>$address,
                "status"=>$status,
                "department"=>$department,
                "position"=>$position,
                "gender"=>$gender,
                "email"=>$email,
                "mobile_number"=>$mobile_number,
                "profile_picture"=>$profile_picture,
                "username"=>$username,
                "date_registered"=>$date_registered
            );
        }

        return $array;
    }

    /**
     * getByUsername()
     * @param: String $username
     * @return: Array
     */
    final public function getByUsername(String $username){
        $this->username = strip_tags($username);

        $stmt = $this->mysqli->prepare("SELECT `admin_id`,`first_name`,`middle_name`,`last_name`,`address`,`status`,`department`,`position`,`gender`,`email`,`mobile_number`,`profile_picture`,`username`,`date_registered` FROM `admin` WHERE `username`=? LIMIT 1");
        $stmt->bind_param("s",$this->username);

        $stmt->execute();
        $stmt->bind_result($admin_id,$first_name,$middle_name,$last_name,$address,$status,$department,$position,$gender,$email,$mobile_number,$profile_picture,$username,$date_registered);

        $array = array();

        while($stmt->fetch()){
            $array = array(
                "admin_id"=>$admin_id,
                "first_name"=>$first_name,
                "middle_name"=>$middle_name,
                "last_name"=>$last_name,
                "address"=>$address,
                "status"=>$status,
                "department"=>$department,
                "position"=>$position,
                "gender"=>$gender,
                "email"=>$email,
                "mobile_number"=>$mobile_number,
                "profile_picture"=>$profile_picture,
                "username"=>$username,
                "date_registered"=>$date_registered
            );
        }

        return $array;
    }

    /**
     * getAll()
     * @param: none
     * @return: Array
     */
    final public function getAll(){
        $query = "SELECT `admin_id`,`first_name`,`middle_name`,`last_name`,`address`,`status`,`department`,`position`,`gender`,`email`,`mobile_number`,`profile_picture`,`username`,`date_registered` FROM `admin`";
        $array = array();
        if($result = $this->mysqli->query($query)){
            while($adm = $result->fetch_array()){
                $data = array(
                    'admin_id'=>$adm['admin_id'],
                    'first_name'=>$adm['first_name'],
                    'middle_name'=>$adm['middle_name'],
                    'last_name'=>$adm['last_name'],
                    'address'=>$adm['address'],
                    'status'=>$adm['status'],
                    'department'=>$adm['department'],
                    'position'=>$adm['position'],
                    'gender'=>$adm['gender'],
                    'email'=>$adm['email'],
                    'mobile_number'=>$adm['mobile_number'],
                    'profile_picture'=>$adm['profile_picture'],
                    'username'=>$adm['username'],
                    'date_registered'=>$adm['date_registered']
                );
                $array[] = $data;
            }
        }

        return $array;
    }

    /**
     * delete()
     * @param: Int $admin_id
     * @return: Bool
     */
    final public function delete(Int $admin_id){
        $this->admin_id = strip_tags($admin_id);
        $stmt = $this->mysqli->prepare("DELETE FROM WHERE LIMIT 1");
        $stmt->bind_param("i",$this->admin_id);
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
        $this->username = strip_tags($username);
        $stmt = $this->mysqli->prepare("SELECT `admin_id` FROM `admin` WHERE `username`=? LIMIT 1");
        $stmt->bind_param("s", $this->username);
        $stmt->execute();

        $stmt->bind_result($admin_id);
        while($stmt->fetch()){
            if($admin_id){
                return True;
            } else {
                return False;
            }
        }
    }

    /**
     * add()
     * @param: Array $array
     * @return: Bool
     */
    final public function add(Array $array){
        // Check for empty fields
        if(empty($array['first_name'])) return "First Name is Required";
        if(empty($array['last_name'])) return "Last Name is Required";
        if(empty($array['username'])) return "Username is Required";
        if(empty($array['password'])) return "Password is Required";
        if(!$this->passwordValid($array['password'])) return "Password Too Short or Too Weak";
        if($this->usernameExists($array['username'])) return "Username already in use";

        $this->first_name = strip_tags($array['first_name']);
        if(!empty($array['middle_name'])) $this->middle_name = strip_tags($array['middle_name']);
        $this->last_name = strip_tags($array['last_name']);
        if(!empty($array['address'])) $this->address = strip_tags($array['address']);
        if(!empty($array['status'])) $this->status = strip_tags($array['status']);
        if(!empty($array['department'])) $this->department = strip_tags($array['department']);
        if(!empty($array['position'])) $this->position = strip_tags($array['position']);
        if(!empty($array['gender'])) $this->gender = strip_tags($array['gender']);
        if(!empty($array['email'])) $this->email = strip_tags($array['email']);
        if(!empty($array['mobile_number'])) $this->mobile_number = strip_tags($array['mobile_number']);
        if(!empty($array['profile_picture'])) $this->profile_picture = strip_tags($array['profile_picture']);
        $this->username = strip_tags($array['username']);
        $this->password = $this->passwordHash(strip_tags($array['password']));

        $stmt = $this->mysqli->prepare("INSERT INTO `admin`(`first_name`,`middle_name`,`last_name`,`address`,`status`,`department`,`position`,`gender`,`email`,`mobile_number`,`profile_picture`,`username`,`password`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssssss",$this->first_name,$this->middle_name,$this->last_name,$address,$status,$department,$position,$gender,$email,$mobile_number,$profile_picture);

        if($stmt->execute()){
            return True;
        } else {
            return False;
        }

    }

    /**
     * updateBasic()
     * @param: Array $array
     * @return: Bool
     */
    final public function updateBasic(Array $array){
        $this->admin_id = strip_tags($array['admin_id']);

        $admin_info = $this->get($this->admin_id);

        // Check for empty fields
        if(empty($admin_info)) return "Customer does not exist";
        if(empty($array['first_name'])) return "First Name is Required";
        if(empty($array['last_name'])) return "Last Name is Required";

        $this->first_name = strip_tags($array['first_name']);
        if(!empty($array['middle_name'])) $this->middle_name = strip_tags($array['middle_name']);
        $this->last_name = strip_tags($array['last_name']);
        if(!empty($array['address'])) $this->address = strip_tags($array['address']);
        if(!empty($array['status'])) $this->status = strip_tags($array['status']);
        if(!empty($array['department'])) $this->department = strip_tags($array['department']);
        if(!empty($array['position'])) $this->position = strip_tags($array['position']);
        if(!empty($array['gender'])) $this->gender = strip_tags($array['gender']);
        if(!empty($array['email'])) $this->email = strip_tags($array['email']);
        if(!empty($array['mobile_number'])) $this->mobile_number = strip_tags($array['mobile_number']);
        if(!empty($array['profile_picture'])) $this->profile_picture = strip_tags($array['profile_picture']);
        
        $stmt = $this->mysqli->prepare("UPDATE `admin` SET `first_name`=?,`middle_name`=?,`last_name`=?, `address`=?, `status`=?, `department`=?,`position`=?,`gender`=?,`email`=?,`mobile_number`=?,`profile_picture`=? WHERE `admin_id`=? LIMIT 1");
        $stmt->bind_param("sssssssssi",$this->first_name,$this->middle_name,$this->last_name,$this->address, $this->status, $this->department,$this->position,$this->gender,$this->email,$this->mobile_number,$this->profile_picture,$this->admin_id);

        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

    /**
     * updateUsername
     * @param: Array $array
     * @return: Bool
     */
    final public function updateUsername(Array $array){
        // Set props
        $this->admin_id = strip_tags($array['admin_id']);
        $this->username = $this->usernameSanitize($array['username']);

        // Get the current username and check if different
        $admin_info = $this->get($this->admin_id);
        if($this->username == $admin_info['username']) return False;

        // Prepare statement
        $stmt = $this->mysqli->prepare("UPDATE `admin` SET `username`=? WHERE `admin_id`=? LIMIT 1");
        $stmt->bind_param("si",$this->username,$this->admin_id);

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
        $this->admin_id = strip_tags($array['admin_id']);
        if($this->passwordValid($array['password']) == False) return False;

        $this->password = strip_tags($array['password']);
        $this->password = $this->passwordHash($this->password);
        
        $stmt = $this->mysqli->prepare("UPDATE `admin` SET `password`=? WHERE `admin_id`=? LIMIT 1");
        $stmt->bind_param("si",$this->password,$this->admin_id);

        if($stmt->execute()){
            return True; 
        } else {
            return False;
        }
    }

    /**
     * verifyLogin()
     * @param: Array $array
     * @return: Array
     */
    final public function verifyLogin(Array $array){
        if(empty($array['username'])) return "Username is Required";
        if(empty($array['password'])) return "Password is Required";

        $this->username = strip_tags($array['username']);
        $this->password = strip_tags($array['password']);

        if($this->usernameExists($this->username) == True){
            $hash_password = $this->getPasswordByUsername($this->username);
            if($this->passwordVerify($this->password,$hash_password) == True){
                return array("code"=>200,"message"=>$this->getByUsername($this->username));
            } else {
                return array("code"=>500,"message"=>"Passsword is incorrect");
            }
        } else {
            return array("code"=>500,"message"=>"Account does not exist");
        }
    }

    /**
     * getPasswordByUsername()
     * @param: String $username
     * @return: String
     */
    final private function getPasswordByUsername(String $username){
        // Prepared stmt
        $stmt = $this->mysqli->prepare("SELECT `password` FROM `admin` WHERE `username`=? LIMIT 1");

        // Bind param
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $stmt->bind_result($password);
        
        while($stmt->fetch()){
            return $password;
        }
    }


    
}
?>