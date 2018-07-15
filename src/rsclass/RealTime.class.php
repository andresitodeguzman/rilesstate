<<<<<<< HEAD:src/rsclass/RealTime.class.php
<?php
/**
 * RailTime
 * 2018
 * 
 * RailTimeSocket
 * Class
 * 
 * RealTime
 */

namespace RailTimeSocket;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class RealTime implements MessageComponentInterface {

    // Properties
    protected $clients;

    private $mysqli;

    // Methods

    /**
     * __construct()
     * @param: $mysqli
     */
    function __construct($mysqli){
        $this->clients = new \SplObjectStorage;
        $this->mysqli = $mysqli;
    }

    /**
     * onOpen()
     * @param: ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn){
        $this->clients->attach($conn);
        echo "New Connection! ({$conn->resourceId})\n";
    }

    /**
     * onMessage()
     * @param: ConnectionInterface $from, $msg
     */
    public function onMessage(ConnectionInterface $from, $msg){
        // json to array
        $data = json_decode($msg,true);

        // Check for empty session_id
        if(empty($data['session_id'])){
            foreach($this->clients as $client){
                if($from == $client) $client->send(json_encode(array("code"=>"500","message"=>"User not authenticated")));
            }
        } else {
            // Check if session is still valid
            if($this->isValidSession($data['session_id']) !== True){
                foreach($this->clients as $client){
                    if($from == $client) $client->send(json_encode(array("code"=>"500","message"=>"Session is already expired")));
                }
            } else {
                // Check if type is empty
                if(empty($data['type'])){
                    foreach($this->clients as $client){
                        if($from == $client) $client->send(json_encode(array("code"=>"500","message"=>"Type is Required")));
                    }
                } else {

                    $type = $data['type'];

                    // Loop along types
                    switch($type){
                        case("community-chat"):
                            $this->sendCommunityChat($from, $data['ChatMessage']);
                            break;
                    }

                }
            }
        }

    }

    /**
     * onClose()
     * @param: ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn){
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    /**
     * onError()
     * @param: ConnectionInterface $conn
     * @param: \Exception $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e){
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    /**
     * isValidSession()
     * @param: String $session_id
     * @return: Bool
     */
    public function isValidSession(String $session_id){
        $session = new \RailTime\Session($this->mysqli);
        return $session->isValid($session_id);
    }


    /**
     * sendCommunityChat()
     * @param: $from
     * @param: $chat
     */
    public function sendCommunityChat($from, $chat){
        $chatmessage = new \RailTime\ChatMessage($this->mysqli);

        $msg = $chatmessage->add($chat);

        if($msg['code'] == 500){
            foreach($this->clients as $client){
                if($from == $client) $client->send(json_encode($msg));
            }
        } else {

            foreach($this->clients as $client){
                if($from == $client) $client->send(json_encode(array("code"=>200,"message"=>"OK","type"=>"community-chat")));
            }

            foreach ($this->clients as $client) {
                if ($from !== $client) {
                    // The sender is not the receiver, send to each client connected
                    $client->send(json_encode($msg));
                }
            }
        }
    }

}
=======
<?php
/**
 * RailTime
 * 2018
 * 
 * RailTimeSocket
 * Class
 * 
 * RealTime
 */

namespace RailTimeSocket;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class RealTime implements MessageComponentInterface {

    // Properties
    protected $clients;

    private $mysqli;

    // Methods

    /**
     * __construct()
     * @param: $mysqli
     */
    function __construct($mysqli){
        $this->clients = new \SplObjectStorage;
        $this->mysqli = $mysqli;
    }

    /**
     * onOpen()
     * @param: ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn){
        $this->clients->attach($conn);
        echo "New Connection! ({$conn->resourceId})\n";
    }

    /**
     * onMessage()
     * @param: ConnectionInterface $from, $msg
     */
    public function onMessage(ConnectionInterface $from, $msg){
        // json to array
        $data = json_decode($msg,true);
        echo $msg;
        // Check for empty session_id
        if(empty($data['session_id'])){
            foreach($this->clients as $client){
                if($from == $client) $client->send(json_encode(array("code"=>"500","message"=>"User not authenticated")));
            }
        } else {
            // Check if session is still valid
            if($this->isValidSession($data['session_id']) !== True){
                foreach($this->clients as $client){
                    if($from == $client) $client->send(json_encode(array("code"=>"500","message"=>"Session is already expired")));
                }
            } else {
                // Check if type is empty
                if(empty($data['type'])){
                    foreach($this->clients as $client){
                        if($from == $client) $client->send(json_encode(array("code"=>"500","message"=>"Type is Required")));
                    }
                } else {

                    $type = $data['type'];

                    // Loop along types
                    switch($type){
                        case("community-chat"):
                            $this->sendCommunityChat($from, $data['ChatMessage']);
                            break;
                        case("share-ride"):
                            $this->shareRide($from,$data['Ride']);
                    }

                }
            }
        }

    }

    /**
     * onClose()
     * @param: ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn){
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    /**
     * onError()
     * @param: ConnectionInterface $conn
     * @param: \Exception $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e){
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    /**
     * isValidSession()
     * @param: String $session_id
     * @return: Bool
     */
    public function isValidSession(String $session_id){
        $session = new \RailTime\Session($this->mysqli);
        return $session->isValid($session_id);
    }


    /**
     * sendCommunityChat()
     * @param: $from
     * @param: $chat
     */
    public function sendCommunityChat($from, $chat){
        $chatmessage = new \RailTime\ChatMessage($this->mysqli);

        $msg = $chatmessage->add($chat);
        print_r($msg);

        if($msg['code'] == 500){
            foreach($this->clients as $client){
                if($from == $client) $client->send(json_encode($msg));
            }
        } else {

            foreach($this->clients as $client){
                if($from == $client) $client->send(json_encode(array("code"=>200,"message"=>"OK","type"=>"community-chat","ChatMessage"=>$msg)));
            }

            foreach ($this->clients as $client) {
                if ($from !== $client) {
                    // The sender is not the receiver, send to each client connected
                    $client->send(json_encode($msg));
                }
            }
        }
    }

    public function shareRide($from,$ride){
        return True;
    }

}
>>>>>>> 97abbe19e8a7027d7d50f3d506d3d9cc87fdf0f6:backend_src/rsclass/RealTime.class.php
?>