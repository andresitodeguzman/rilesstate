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

    public $announcement_id;
    public $announcement_caption;
    public $announcement_date;

    const ANNOUNCEMENT_TABLE = "announcement";
    const ANNOUNCEMENT_ID = "announcement_id";
    const ANNOUNCEMENT_CAPTION = "announcement_caption";
    const ANNOUNCEMENT_DATE = "announcement_date"


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
            ANNOUNCEMENT_ID . "," .
            ANNOUNCEMENT_CAPTION . "," .
            ANNOUNCEMENT_DATE . " FROM " . ANNOUNCEMENT_TABLE . " WHERE " . ANNOUNCEMENT_ID . "=? LIMIT 1");

        // Bind Parameters
        $stmt->bind_param("i", $this->announcement_id);

        // Execute query
        $stmt->execute();

        // Prepre Result
        $stmt->bind_result($announcement_id,$announcement_caption,$announcement_date);

        // Create empty array
        $announcement_arr = array();

        // Fetch result
        while($stmt->fetch()){
            $announcement_arr = array(
                ANNOUNCEMENT_ID=>$announcement_id,
                ANNOUNCEMENT_CAPTION=>$announcement_caption,
                ANNOUNCEMENT_DATE=>$announcement_date
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
        $query = "SELECT * FROM " . ANNOUNCEMENT_TABLE;
        // Create empty array
        $arr = array();
        // Do Query
        if($result = $this->mysqli->query($query)){
            while($st = $result->fetch_array()){
                $data = array(
                    ANNOUNCEMENT_ID=>$st[ANNOUNCEMENT_ID],
                    ANNOUNCEMENT_CAPTION=>$st[ANNOUNCEMENT_CAPTION],
                    ANNOUNCEMENT_DATE=>$st[ANNOUNCEMENT_DATE]
                );

                $arr[] = $data; 
            }
        }

        return $arr;
    }

    /**
     * delete()
     * @param: Int $announcement_id
     * @return: Bool
     */
    final public function delete(Int $announcement_id){
        // Check empty fields
        if(empty($announcement_id)) return "Announcement ID is Required";

        // Set props
        $this->announcement_id = $announcement_id;

        // Prepare Statement
        $stmt = $this->mysqli->prepare("DELETE FROM " . ANNOUNCEMENT_TABLE . " WHERE " . ANNOUNCEMENT_ID . "=? LIMIT 1");
        
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
        if(empty($array[ANNOUNCEMENT_CAPTION])) return "Announcement Caption is Required";

        // Set params
        $this->announcement_caption = strip_tags($array[ANNOUNCEMENT_CAPTION]);

        // Prepare statement
        $stmt = $this->mysqli->prepare("INSERT INTO " . ANNOUNCEMENT_TABLE . "(" .
            ANNOUNCEMENT_CAPTION . "," .
            ANNOUNCEMENT_DATE . ") VALUES(?,?)");

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
        if(empty($array[ANNOUNCEMENT_ID])) return "Announcement ID is Required";
        if(empty($array[ANNOUNCEMENT_CAPTION])) return "Announcement Caption is Required";

        // Set props
        $this->announcement_id = strip_tags($array[ANNOUNCEMENT_ID]);
        if(!empty($array[ANNOUNCEMENT_CAPTION$this->announcement_caption = strip_tags($array[ANNOUNCEMENT_CAPTION]);
        
        // Prepare statement
        $stmt = $this->mysqli->prepare("UPDATE " . ANNOUNCEMENT_TABLE . 
            " SET " . ANNOUNCEMENT_CAPTION . "=? WHERE " . ANNOUNCEMENT_ID . "=? LIMIT 1");
        
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