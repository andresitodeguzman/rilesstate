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
    public $category;
    public $publisher;
    public $image;
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
     * @param: Int $badge_id
     * @return: Array
     */
    final public function get(Int $badge_id){
        $this->badge_id = strip_tags($badge_id);
        $stmt = $this->mysqli->prepare("SELECT `badge_id`,`name`,`description`,`category`,`publisher`,`image`,`timestamp` FROM `badge` WHERE `badge_id`=? LIMIT 1");
        $stmt->bind_param("i",$stmt->badge_id);
        $stmt->execute();
        $stmt->bind_result($badge_id,$name,$description,$category,$publisher,$image,$timestamp);
        
        $array = array();
        while($stmt->fetch()){
            $array = array(
                "badge_id"=>$badge_id,
                "name"=>$name,
                "description"=>$description,
                "category"=>$category,
                "publisher"=>$publisher,
                "image"=>$image,
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
        $query = "SELECT `badge_id`,`name`,`description`,`category`,`publisher`,`image`,`timestamp` FROM `badge`";
        
        $array = array();

        if($result = $this->mysqli->query($query)){
            while($badg = $result->fetch_array){
                $data = array(
                    "badge_id"=>$badg['badge_id'],
                    "name"=>$badg['name'],
                    "description"=>$badg['description'],
                    "category"=>$badg['category'],
                    "publisher"=>$badg['publisher'],
                    "image"=>$badg['image'],
                    "timestamp"=>$badg['timestamp']
                );
                $array[] = $data;
            }
        }

        return $data;
    }

    /**
     * add()
     * @param: Array $array
     * @return: Bool
     */
    final public function add(Array $array){
        $this->name = $array['name'];
        $this->description = $array['description'];
        $this->category = $array['category'];
        $this->publisher = $array['publisher'];
        $this->image = $array['image'];
        
        $stmt = $this->mysqli->prepare("INSERT INTO `badge`(`name`,`description`,`category`,`publisher`,`image`) VALUES(?,?,?,?,?)");
        $stmt->bind_param("sssss",$this->name,$this->description,$this->category,$this->publisher,$this->image);

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
        $this->badge_id = $array['badge_id'];
        $this->name = $array['name'];
        $this->description = $array['description'];
        $this->category = $array['category'];
        $this->publisher = $array['publisher'];
        $this->image = $array['image'];

        $stmt = $this->mysqli->prepare("UPDATE `badge` SET `name`=?,`description`=?,`category`=?,`publisher`=?,`image`=? WHERE  LIMIT 1");
        $stmt->bind_param("sssssi",$this->name,$this->description,$this->category,$this->publisher,$this->image,$this->badge_id);
        
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

    /**
     * delete()
     * @param: Int $badge_id 
     * @return: Bool
     */
    final public function delete(Int $badge_id){
        $this->badge_id = $badge_id;
        $stmt = $this->mysqli->prepare("DELETE FROM `badge` WHERE `bagde_id`=? LIMIT 1");
        $stmt->bind_param("i",$this->badge_id);
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

}
?>