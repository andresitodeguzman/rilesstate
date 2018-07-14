<?php
/**
 * RailTime
 * 2018
 * 
 * API
 * Class
 * 
 * Survey
 */

namespace RailTime;

final class Survey{

    // Properties
    private $mysqli;

    public $survey_id;
    public $survey_question;
    public $survey_choices;
    public $survey_added_by;
    public $survey_date_added;

    const SURVEY_TABLE = "forum";
    const SURVEY_ID = "survey_id";
    const SURVEY_QUESTION = "survey_question";
    const SURVEY_CHOICES = "survey_choices";
    const SURVEY_ADDED_BY = "survey_added_by";
    const SURVEY_DATE_ADDED = "survey_date_added";

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
     * @param: Int $survey_id
     * @return: Array
     */
    final public function get(Int $survey_id){
        // Check for empty param
        if(empty($SURVEY_ID)) return "Survey ID is Required";

        // Set props
        $this->survey_id = $SURVEY_ID;

        // Prepare Statement
        $stmt = $this->mysqli->prepare(
            "SELECT " .
                SURVEY_ID . "," .
                SURVEY_QUESTION . "," .
                SURVEY_CHOICES . "," .
                SURVEY_ADDED_BY . "," .
                SURVEY_DATE_ADDED . 
                " FROM " . SURVEY_TABLE . " WHERE " . SURVEY_ID . "=? LIMIT 1");

        // Bind Parameters
        $stmt->bind_param("i", $this->SURVEY_ID);

        // Execute query
        $stmt->execute();

        // Prepare Result
        $stmt->bind_result(
            $SURVEY_ID,
            $SURVEY_QUESTION,
            $SURVEY_CHOICES,
            $SURVEY_ADDED_BY,
            $SURVEY_DATE_ADDED
        );

        // Create empty array
        $survey_arr = array();

        // Fetch result
        while($stmt->fetch()){
            $survey_arr = array(
                SURVEY_ID=>$SURVEY_ID,
                SURVEY_QUESTION=>$SURVEY_QUESTION,
                SURVEY_CHOICES=>$SURVEY_CHOICES,
                SURVEY_ADDED_BY=>$SURVEY_ADDED_BY,
                SURVEY_DATE_ADDED=>$SURVEY_DATE_ADDED
            );
        }

        return $survey_arr;
    }

    /**
     * getAll()
     * @param: None
     * @return: Array
     */
    final public function getAll(){
        // Prepare query
        $query = "SELECT * FROM " . SURVEY_TABLE;
        // Create empty array
        $arr = array();
        // Do Query
        if($result = $this->mysqli->query($query)){
            while($st = $result->fetch_array()){
                $data = array(
                    SURVEY_ID=>$st[SURVEY_ID],
                    SURVEY_QUESTION=>$st[SURVEY_QUESTION],
                    SURVEY_CHOICES=>$st[SURVEY_CHOICES],
                    SURVEY_ADDED_BY=>$st[SURVEY_ADDED_BY],
                    SURVEY_DATE_ADDED=>$st[SURVEY_DATE_ADDED]
                );

                $arr[] = $data; 
            }
        }

        return $arr;
    }

    /**
     * delete()
     * @param: Int $survey_id
     * @return: Bool
     */
    final public function delete(Int $survey_id){
        // Check empty fields
        if(empty($survey_id)) return "Survey ID is Required";

        // Set props
        $this->survey_id = $survey_id;

        // Prepare Statement
        $stmt = $this->mysqli->prepare("DELETE FROM " . SURVEY_TABLE . " WHERE " . SURVEY_ID . "=? LIMIT 1");

        // Bind parameters
        $stmt->bind_param("i", $this->SURVEY_ID);

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
        if(empty($array[SURVEY_QUESTION])) return "Survey Question is Required";
        if(empty($array[SURVEY_CHOICES])) return "Survey Choices is Required";

        // Set params
        if(!empty($array[SURVEY_QUESTION])) $this->survey_question = strip_tags($array[SURVEY_QUESTION]);
        if(!empty($array[SURVEY_CHOICES])) $this->survey_choices = strip_tags($array[SURVEY_CHOICES]);
        if(!empty($array[SURVEY_ADDED_BY])) $this->survey_date_added = strip_tags($array[SURVEY_ADDED_BY]);
        
        // Prepare statement
        $stmt = $this->mysqli->prepare("INSERT INTO " . SURVEY_TABLE . "(" .
            SURVEY_QUESTION . "," .
            SURVEY_CHOICES . "," .
            SURVEY_ADDED_BY . "," .
            SURVEY_DATE_ADDED . 
            ") VALUES(?,?,?,?)");

        // Bind Parameters
        $stmt->bind_param("ssss",
            $this->survey_question,
            $this->survey_choices,
            $this->survey_added_by,
            $this->survey_date_added
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
        if(empty($array[SURVEY_QUESTION])) return "Survey Question is Required";
        if(empty($array[SURVEY_CHOICES])) return "Survey Choices is Required";

        // Set props
        if(!empty($array[SURVEY_QUESTION])) $this->survey_question = strip_tags($array[SURVEY_QUESTION]);
        if(!empty($array[SURVEY_CHOICES])) $this->survey_choices = strip_tags($array[SURVEY_CHOICES]);

        // Prepare statement
        $stmt = $this->mysqli->prepare("UPDATE " . SURVEY_TABLE . " SET " . 
            SURVEY_QUESTION . "=?," . 
            SURVEY_CHOICES . "=? WHERE " . 
            SURVEY_ID . "=? LIMIT 1");

        $stmt->bind_param("sss",
            $this->survey_question,
            $this->survey_choices,
            $this->survey_id
        );
        
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

}

?>