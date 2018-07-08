<?php
/**
 * RailTime
 * 2018
 * 
 * API
 * Class
 * 
 * Session
 */

namespace RailTime;

class Session extends AccountUtility {

    // Properties
    private $mysqli;

    public $session_id;
    public $timestamp;
    public $customer_id;
    public $admin_id;
    public $is_force_expired;
    public $ip_address;

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

    final public function get(String $session_id){
        if(empty($session_id)) return "Session ID is Required";
        
        $this->session_id = $session_id;

        $stmt = $this->mysqli->prepare("SELECT `session_id`,`timestamp`,`customer_id`,`admin_id`,`is_force_expired`,`ip_address` FROM `session` WHERE `session_id`=? LIMIT 1");
        $stmt->bind_param("s", $this->session_id);
        $stmt->execute();

        $stmt->bind_result($session_id,$timestamp,$customer_id,$admin_id,$is_force_expired,$ip_address);
        $arr = array();
        while($stmt->fetch()){
            $arr = array(
                "session_id"=>$session_id,
                "timestamp"=>$timestamp,
                "customer_id"=>$customer_id,
                "admin_id"=>$admin_id,
                "is_force_expired"=>$is_force_expired,
                "ip_address"=>$ip_address
            );
        }
        return $arr;
    }

    /**
     * getByCustomerId()
     * @param: Int $customer_id
     * @return: Array
     */
    final public function getByCustomerId(Int $customer_id){
        // Check for empty param
        if(empty($customer_id)) return "Customer ID is Required";
        // Set props
        $this->customer_id = strip_tags($customer_id);
        // Prepare statement
        $stmt = $this->mysqli->prepare("SELECT `session_id`,`timestamp`,`customer_id`,`admin_id`,`is_force_expired`,`ip_address` FROM `session` WHERE `customer_id`=? LIMIT 20");
        // Bind param
        $stmt->bind_param("i",$this->customer_id);
        //Execute
        $stmt->execute();
        // Create placeholder array
        $arr = array();
        $stmt->bind_result($session_id,$timestamp,$customer_id,$admin_id,$is_force_expired,$ip_address);

        while($stmt->fetch_array()){
            $data = array(
                "session_id"=>$session_id,
                "timestamp"=>$timestamp,
                "customer_id"=>$customer_id,
                "admin_id"=>$admin_id,
                "is_force_expired"=>$is_force_expired,
                "ip_address"=>$ip_address
            );
            $arr[] = $data;
        }

        return $arr;
    }

    /**
     * add()
     * @param: Array $array
     * @return: String/Bool
     */
    final public function add(Array $array){
        $this->session_id = $this->generateID();
        if(!empty($array['customer_id'])) $this->customer_id = $array['customer_id'];
        if(!empty($array['admin_id'])) $this->admin_id = $array['admin_id'];
        if(!empty($array['ip_address'])) $this->ip_address = $array['ip_address'];

        $stmt = $this->mysqli->prepare("INSERT INTO `session`(`session_id`,`customer_id`,`admin_id`,`ip_address`) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss",$this->session_id, $this->customer_id, $this->admin_id, $this->ip_address);
        
        if($stmt->execute()){
            return $this->session_id;
        } else {
            return False;
        }
    }

    /**
     * forceExpire()
     * @param: String $session_id
     * @return: Bool
     */
    final public function forceExpire(String $session_id){
        // Check for empty param
        if(empty($session_id)) return "Session ID is Required";
        // Set props
        $this->session_id = strip_tags($session_id);
        // Prepare Statement
        $stmt  = $this->mysqli->prepare("UPDATE `session` SET `is_force_expired`='True' WHERE `session_id`=? LIMIT 1");
        $stmt->bind_param("s", $this->session_id);
        
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

    final public function isValid(String $session_id){
        if(empty($session_id)) return "Session ID is Required";
        $this->session_id = strip_tags($session_id);
        $session_info = $this->get($session_id);
        if(empty($session_info)) return False;
        if($session_info['is_force_expired']){
            return False;
        } else {
            if(strtotime($session_info['timestamp']) < strtotime("-30 days")){
                $this->forceExpire($this->session_id);
                return False;
            } else {
                return True;
            }
        }
    }

}
?>