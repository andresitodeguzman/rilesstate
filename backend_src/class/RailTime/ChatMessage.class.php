<?php
/**
 * RailTime
 * 2018
 * 
 * API
 * Class
 * 
 * ChatMessage
 */

namespace RailTime;

class ChatMessage extends AccountUtility{

    // Properties
    private $mysqli;

    public $message_id;
    public $chatroom_id;
    public $customer_id;
    public $body;
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
     * @param: String $message_id
     * @return: Array
     */
    final public function get(String $message_id){
        // Check for empty param
        if(empty($message_id)) return "Message ID is Required";
        // Set props
        $this->message_id = $message_id;
        // Prepare statement
        $stmt = $this->mysqli->prepare("SELECT `message_id`,`chatroom_id`,`customer_id`,`body`,`timestamp` FROM `chatmessage` LIMIT 1");
        // Bind parameters
        $stmt->bind_param("s",$this->message_id);
        // Execute query
        $stmt->execute();
        // Bind the results
        $stmt->bind_result($message_id,$chatroom_id,$customer_id,$body,$timestamp);

        // Create empty array
        $array = array();

        while($stmt->fetch()){
            $array = array(
                "message_id"=>$message_id,
                "chatroom_id"=>$chatroom_id,
                "customer_id"=>$customer_id,
                "body"=>$body,
                "timestamp"=>$timestamp
            );
        }

        return $array;

    }

    /**
     * getByChatroomId()
     * @param: Int $chatroom_id
     * @return: Array
     */
    final public function getByChatroomId(Int $chatroom_id){
        if(empty($chatroom_id)) return "Chatroom ID is Required";
        $this->chatroom_id = $chatroom_id;
        $stmt = $this->mysqli->prepare("SELECT `message_id`,`chatroom_id`,`customer_id`,`body`,`timestamp` FROM `chatmessage` WHERE `chatroom_id`=? LIMIT 50");
        $stmt->bind_param("i", $this->chatroom_id);
        $stmt->execute();
        $stmt->bind_result($message_id,$chatroom_id,$customer_id,$body,$timestamp);
        $array = array();
        while($stmt->fetch_array()){
            $data = array(
                "message_id"=>$message_id,
                "chatroom_id"=>$chatroom_id,
                "customer_id"=>$customer_id,
                "body"=>$body,
                "timestamp"=>$timestamp
            );
            $array[] = $data;
        }

        return $array;
    }

    final public function getAll(){
        $query = "SELECT `message_id`,`chatroom_id`,`customer_id`,`body`,`timestamp` FROM `chatmessage` LIMIT 200";

        $array = array();

        if($result = $this->mysqli->query($query)){
            while($cht = $result->fetch_array()){
                $data = array(
                    "message_id"=>$cht['message_id'],
                    "chatroom_id"=>$cht['chatroom_id'],
                    "customer_id"=>$cht['customer_id'],
                    "body"=>$cht['body'],
                    "timestamp"=>$cht['timestamp']
                );

                $array[] = $data;
            }
        }

        return $array;

    }

    final public function add(Array $array){
        if(empty($array['chatroom_id'])) return array("code"=>500,"message"=>"Chatroom ID is Required");
        if(empty($array['customer_id'])) return array("code"=>500,"message"=>"Customer ID is Required");
        if(empty($array['body'])) return array("code"=>500,"message"=>"Content is Required");

        $this->message_id = $this->generateID();
        $this->chatroom_id = $array['chatroom_id'];
        $this->customer_id = $array['customer_id'];
        $this->body = $array['body'];

        $stmt = $this->mysqli->prepare("INSERT INTO `chatmessage`(`message_id`,`chatroom_id`,`customer_id`,`body`) VALUES(?,?,?,?)");
        $stmt->bind_param("siis",$this->message_id,$this->chatroom_id,$this->customer_id,$this->body);
        
        if($stmt->execute()){
            return array(
                "code"=>200,
                "message"=>"OK",
                "type"=>"community-chat",
                "ChatMessage"=>array(
                    "message_id"=>$this->message_id,
                    "chatroom_id"=>$this->chatroom_id,
                    "customer_id"=>$this->customer_id,
                    "body"=>$this->body,
                    "timestamp"=>date("Y-m-d H:i:s")
                )
            );
        } else {
            return array("code"=>500,"message"=>"A problem occurred");
        }

    }

    final public function delete(String $message_id){
        if(empty($message_id)) return "Message ID is Required";
        $this->message_id = $message_id;
        $stmt = $this->mysqli->prepare("DELETE FROM `chatmessage` WHERE `message_id`=? LIMIT 1");
        $stmt->bind_param("s",$this->message_id);
        if($stmt->execute()) {
            return True;
        }  else {
            return False;
        }
    }

}
?>