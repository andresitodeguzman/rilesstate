<?php
/**
 * RailTime
 * 2018
 * 
 * API
 * Class
 * 
 * Announcement
 */

namespace RailTime;


final class Announcement{

    // Properties
    private $mysqli;




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
     * @param: Int $station_id
     * @return: Array
     */
    final public function get(Int $announcement_id){
        // Check for empty param
        if(empty($announcement_id)) return "Announcement ID is Required";
        // Set props
        $this->announcement_id = $announcement_id;

        // Prepare Statement
        $stmt = $this->mysqli->prepare("SELECT " . 
            "announcement_id" . "," .
            "announcement_caption" . "," .
            "announcement_date" . " FROM " . "announcement" . " WHERE " . "announcement_id" . "=? LIMIT 1");

        // Bind Parameters
        $stmt->bind_param("i", $this->announcement_id);

        // Execute query
        $stmt->execute();

        // Prepre Result
        $stmt->bind_result("announcement_id","announcement_caption","announcement_date");

        // Create empty array
        $announcement_arr = array();

        // Fetch result
        while($stmt->fetch()){
            $announcement_arr = array(
                ANNOUNCEMENT_ID=>"announcement_id",
                ANNOUNCEMENT_CAPTION=>"announcement_caption",
                ANNOUNCEMENT_DATE=>"announcement_date"
            );
        }

        return $announcement_arr;
    }

    /**
     * getAll()
     * @param: None
     * @return: Array
     */
    final public function getAll(){
        // Prepare query
        $query = "SELECT * FROM " . "announcement";
        // Create empty array
        $arr = array();
        // Do Query
        if($result = $this->mysqli->query($query)){
            while($st = $result->fetch_array()){
                $data = array(
                    "announcement_id"=>$st["announcement_id"],
                    "announcement_caption"=>$st["announcement_caption"],
                    "announcement_date"=>$st["announcement_date"]
                );

                $arr[] = $data; 
            }
        }

        return $arr;
    }

    /**
     * delete()
     * @param: Int "announcement_id"
     * @return: Bool
     */
    final public function delete(Int "announcement_id"){
        // Check empty fields
        if(empty("announcement_id")) return "Announcement ID is Required";

        // Set props
        $this->announcement_id = "announcement_id";

        // Prepare Statement
        $stmt = $this->mysqli->prepare("DELETE FROM " . "announcement" . " WHERE " . "announcement_id" . "=? LIMIT 1");
        
        // Bind parameters
        $stmt->bind_param("i", $this->announcement_id);
        
        // Do query
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

    /**
     * add()
     * @param: Array $array
     * @return: Bool
     */
    final public function add(Array $array){
        // Check for empty params
        if(empty($array["announcement_caption"])) return "ANNOUNCEMENT Caption is Required";

        // Set params
        $this->"announcement_caption" = strip_tags($array["announcement_caption"]);

        // Prepare statement
        $stmt = $this->mysqli->prepare("INSERT INTO " . "announcement" . "(" .
            "announcement_caption" . "," .
            "announcement_date" . ") VALUES(?,?)");

        // Bind Parameters
        $stmt->bind_param("ss",
            $this->announcement_caption,
            $this->announcement_date
        );

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
        //Check for empty params
        if(empty($array["announcement_id"])) return "$ANNOUNCEMENT ID is Required";
        if(empty($array["announcement_caption"])) return "$ANNOUNCEMENT Caption is Required";

        // Set props
        $this->announcement_id = strip_tags($array["announcement_id"]);
        if(!empty($array["announcement_caption"])) $this->announcement_caption = strip_tags($array["announcement_caption"]);
        
        // Prepare statement
        $stmt = $this->mysqli->prepare("UPDATE " . "announcement" . 
            " SET " . "announcement_caption" . "=? WHERE " . "announcement_id" . "=? LIMIT 1");
        
        $stmt->bind_param("ss",
            $this->announcement_caption,
            $this->announcement_id
        );

        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

}

?>