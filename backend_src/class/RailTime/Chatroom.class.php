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
    public $category;
    public $tags;
    public $code;
    public $description;
    public $image_url;
    public $timestamp;

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
     * @param: Int $chatroom_id
     * @return: Array
     */
    final public function get(Int $chatroom_id){
        if(empty($chatroom_id)) return "Chatroom ID is Required";
        $this->chatroom_id = strip_tags($chatroom_id);

        $stmt = $this->mysqli->prepare("SELECT `chatroom_id`,`name`,`category`,`tags`,`code`,`description`,`image_url`,`timestamp` FROM `chatroom` WHERE `chatroom_id`=?");
        $stmt->bind_param("i",$this->chatroom_id);
        $stmt->execute();
        $stmt->bind_param($chatroom_id,$name,$category,$tags,$code,$description,$image_url,$timestamp);

        $array = array();
        while($stmt->fetch()){
            $array = array(
                "chatroom_id"=>$chatroom_id,
                "name"=>$name,
                "category"=>$category,
                "tags"=>$tags,
                "code"=>$code,
                "description"=>$description,
                "image_url"=>$image_url,
                "timestamp"=>$timestamp
            );
        }

        return $array;
    }

    /**
     * getAll()
     * @param: None
     * @return: Array
     */
    final public function getAll(){
        $query = "SELECT `chatroom_id`,`name`,`category`,`tags`,`code`,`description`,`image`,`timestamp` FROM `chatroom` LIMIT 50";

        $array = array();

        if($result = $this->mysqli->query($query)){
            while($chatr = $result->fetch_array()){
                $data = array(
                    "chatroom_id"=>$chatr['chatroom_id'],
                    "name"=>$chatr['name'],
                    "category"=>$chatr['category'],
                    "tags"=>$chatr['tags'],
                    "code"=>$chatr['code'],
                    "description"=>$chatr['description'],
                    "image"=>$chatr['image'],
                    "timestamp"=>$chatr['timestamp']
                );
                
                $array[] = $data;
            }
        }

        return $array;
    }

    /**
     * getByCode()
     * @param: Int $code
     * @return: Array
     */
    final public function getByCode(String $code){
        if(empty($code)) return "Code is Required";
        $this->code = strip_tags($code);

        $stmt = $this->mysqli->prepare("SELECT `chatroom_id`,`name`,`category`,`tags`,`code`,`description`,`image_url`,`timestamp` FROM `chatroom` WHERE `code`=?");
        $stmt->bind_param("s",$this->code);
        $stmt->execute();
        $stmt->bind_param($chatroom_id,$name,$category,$tags,$code,$description,$image_url,$timestamp);

        $array = array();
        while($stmt->fetch()){
            $array = array(
                "chatroom_id"=>$chatroom_id,
                "name"=>$name,
                "category"=>$category,
                "tags"=>$tags,
                "code"=>$code,
                "description"=>$description,
                "image_url"=>$image_url,
                "timestamp"=>$timestamp
            );
        }

        return $array;
    }

    /**
     * add()
     * @param: Arrray $array
     * @return: Mixed
     */
    final public function add(Array $array){
        // Check for empty param
        if(empty($array['name'])) return "Name is Required";
        // Set param
        $this->name = $array['name'];
        if(!empty($array['category'])) $this->category = $array['category'];
        if(!empty($array['tags'])) $this->tags = $array['tags'];
        if(!empty($array['code'])) $this->code = $array['code'];
        if(!empty($array['description'])) $this->description = $array['description'];
        if(!empty($array['image'])) $this->image = $array['image'];
        // Prepare statement
        $stmt = $this->mysqli->prepare("INSERT INTO `chatroom`(`name`,`category`,`tags`,`code`,`description`,`image`) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss",$this->name,$this->category,$this->tags,$this->code,$this->description,$this->image);
        // Execute Query
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

    /**
     * delete()
     * @param: Int $chatroom_id
     * @return: String/Bool
     */
    final public function delete(Int $chatroom_id){
        // Check for empty param
        if(empty($chatroom_id)) return "Chatroom ID is Required";
        // Set param
        $this->chatroom_id = $chatroom_id;
        // Prepare statement
        $stmt = $this->mysqli->prepare("DELETE FROM `chatroom` WHERE `chatroom_id`=? LIMIT 1");
        // Bind parameter
        $stmt->bind_param("i",$this->chatroom_id);
        // Execute query
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

    /**
     * update()
     * @param: Array $array
     * @return: Bool
     */
    final public function update(Array $array){
        // Check for empty param
        if(empty($array['chatroom_id'])) return "Chatroom ID is Required";
        if(empty($array['name'])) return "Name is Required";
        // Set param
        $this->chatroom_id = $chatroom_id;
        $this->name = $array['name'];
        if(!empty($array['category'])) $this->category = $array['category'];
        if(!empty($array['tags'])) $this->tags = $array['tags'];
        if(!empty($array['code'])) $this->code = $array['code'];
        if(!empty($array['description'])) $this->description = $array['description'];
        if(!empty($array['image'])) $this->image = $array['image'];

        $stmt = $this->mysqli->prepare("UPDATE `chatroom` SET `name`=?,`category`=?,`tags`=?,`code`=?,`description`=?,`image`=? WHERE `chatroom_id`=? LIMIT 1");
        $stmt->bind_param("ssssssi",$this->name,$this->category,$this->tags,$this->code,$this->description,$this->image,$this->customer_id);
        

        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }
}
?>