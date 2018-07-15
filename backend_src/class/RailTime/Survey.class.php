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
        if(empty($survey_id)) return "Survey ID is Required";

        // Set props
        $this->survey_id = $survey_id;

        // Prepare Statement
        $stmt = $this->mysqli->prepare(
            "SELECT * FROM survey WHERE survey_id=? LIMIT 1");

        // Bind Parameters
        $stmt->bind_param("i", $this->survey_id);

        // Execute query
        $stmt->execute();

        // Prepare Result
        $stmt->bind_result(
            $survey_id,
            $survey_question,
            $survey_choices,
            $survey_added_by,
            $survey_date_added
        );

        // Create empty array
        $survey_arr = array();

        // Fetch result
        while($stmt->fetch()){
            $survey_arr = array(
                'survey_id'=>$survey_id,
                'survey_question'=>$survey_question,
                'survey_choices'=>$survey_choices,
                'survey_added_by'=>$survey_added_by,
                'survey_date_added'=>$survey_date_added
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
        $query = "SELECT * FROM survey";
        // Create empty array
        $arr = array();
        // Do Query
        if($result = $this->mysqli->query($query)){
            while($st = $result->fetch_array()){
                $data = array(
                    'survey_id'=>$st['survey_id'],
                    'survey_question'=>$st['survey_question'],
                    'survey_choices'=>$st['survey_choices'],
                    'survey_added_by'=>$st['survey_added_by'],
                    'survey_date_added'=>$st['survey_date_added']
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
        $stmt = $this->mysqli->prepare("DELETE FROM survey WHERE survey_id=? LIMIT 1");

        // Bind parameters
        $stmt->bind_param("i", $this->survey_id);

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
        if(empty($array['survey_question'])) return "Survey Question is Required";
        if(empty($array['survey_choices'])) return "Survey Choices is Required";

        // Set params
        if(!empty($array['survey_question'])) $this->survey_question = strip_tags($array['survey_question']);
        if(!empty($array['survey_choices'])) $this->survey_choices = strip_tags($array['survey_choices']);
        if(!empty($array['survey_added_by'])) $this->survey_date_added = strip_tags($array['survey_added_by']);
        
        // Prepare statement
        $stmt = $this->mysqli->prepare("INSERT INTO survey(survey_question,survey_choices,survey_added_by,survey_date_added) VALUES(?,?,?,?)");

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
        if(empty($array['survey_question'])) return "Survey Question is Required";
        if(empty($array['survey_choices'])) return "Survey Choices is Required";

        // Set props
        if(!empty($array['survey_question'])) $this->survey_question = strip_tags($array['survey_question']);
        if(!empty($array['survey_choices'])) $this->survey_choices = strip_tags($array['survey_choices']);

        // Prepare statement
        $stmt = $this->mysqli->prepare("UPDATE survey SET survey_question=?,survey_choices=? WHERE survey_id=? LIMIT 1");

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