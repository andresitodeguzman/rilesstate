<?php
/**
 * RailTime
 * 2018
 * 
 * API
 * Class
 * 
 * Forum
 */

namespace RailTime;

final class Forum{

    // Properties
    private $mysqli;

    public $forum_id;
    public $forum_station_id;
    public $forum_comment;
    public $forum_comment_by;
    public $forum_date_added;

    const FORUM_TABLE = "forum";
    const FORUM_ID = "forum_id";
    const FORUM_STATION_ID = "forum_station_id";
    const FORUM_COMMENT = "forum_comment";
    const FORUM_COMMENT_BY = "forum_comment_by";
    const FORUM_DATE_ADDED = "forum_date_added";

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
     * @param: Int $forum_id
     * @return: Array
     */
    final public function get(Int $forum_id){
        // Check for empty param
        if(empty($forum_id)) return "Forum ID is Required";
        // Set props
        $this->forum_id = $forum_id;

        // Prepare Statement
        $stmt = $this->mysqli->prepare(
            "SELECT * FROM forum WHERE forum_id=? LIMIT 1");

        // Bind Parameters
        $stmt->bind_param("i", $this->forum_id);

        // Execute query
        $stmt->execute();

        // Prepare Result
        $stmt->bind_result(
            $forum_id,
            $forum_station_id,
            $forum_comment,
            $forum_comment_by,
            $forum_date_added
        );

        // Create empty array
        $forum_arr = array();

        // Fetch result
        while($stmt->fetch()){
            $forum_arr = array(
                'forum_id'=>$forum_id,
                'forum_station_id'=>$forum_station_id,
                'forum_comment'=>$forum_comment,
                'forum_comment_by'=>$forum_comment_by,
                'forum_date_added'=>$forum_date_added
            );
        }

        return $forum_arr;
    }

    /**
     * getAll()
     * @param: None
     * @return: Array
     */
    final public function getAll(){
        // Prepare query
        $query = "SELECT * FROM forum";
        // Create empty array
        $arr = array();
        // Do Query
        if($result = $this->mysqli->query($query)){
            while($st = $result->fetch_array()){
                $data = array(
                    'forum_id'=>$st['forum_id'],
                    'forum_station_id'=>$st['forum_station_id'],
                    'forum_comment'=>$st['forum_comment'],
                    'forum_comment_by'=>$st['forum_comment_by'],
                    'forum_date_added'=>$st['forum_date_added']
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
    final public function delete(Int $forum_id){
        // Check empty fields
        if(empty($forum_id)) return "Forum ID is Required";
        // Set props
        $this->forum_id = $forum_id;
        // Prepare Statement
        $stmt = $this->mysqli->prepare("DELETE FROM forum WHERE forum_id=? LIMIT 1");
        // Bind parameters
        $stmt->bind_param("i", $this->forum_id);
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
        if(empty($array['forum_comment'])) return "Forum Comment is Required";

        // Set params
        if(!empty($array['forum_station_id'])) $this->forum_station_id = strip_tags($array[FORUM_STATION_ID]);
        if(!empty($array[FORUM_COMMENT])) $this->forum_comment = strip_tags($array[FORUM_COMMENT]);
        if(!empty($array['forum_comment_by'])) $this->forum_comment_by = strip_tags($array[FORUM_COMMENT_BY]);
        
        // Prepare statement
        $stmt = $this->mysqli->prepare("INSERT INTO forum(forum_station_id,forum_comment,forum_comment_by,forum_date_added) VALUES(?,?,?,?)");

        // Bind Parameters
        $stmt->bind_param("ssss",
            $this->forum_station_id,
            $this->forum_comment,
            $this->forum_comment_by,
            $this->forum_date_added
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
        if(empty($array['forum_comment'])) return "Forum Comment is Required";

        // Set props
        $this->forum_id = strip_tags($array[FORUM_ID]);
        if(!empty($array['forum_comment'])) $this->forum_comment = strip_tags($array['forum_comment']);

        // Prepare statement
        $stmt = $this->mysqli->prepare("UPDATE forum SET forum_comment=? WHERE forum_id=? LIMIT 1");

        $stmt->bind_param("ss",
            $this->forum_comment,
            $this->forum_id
        );
        
        if($stmt->execute()){
            return True;
        } else {
            return False;
        }
    }

}

?>