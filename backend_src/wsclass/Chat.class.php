<?php
namespace RailTimeSocket;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {

    // Properties
    protected $clients;
    private $mysqli;

    // Methods

    function __construct($mysqli){
        $this->clients = new \SplObjectStorage;
        $this->mysqli = $mysqli;
    }

    public function onOpen(ConnectionInterface $conn){
        $this->clients->attach($conn);
        echo "New Connection! ({$conn->resourceId})\n";

    }

    /*
    public function onMessage(ConnectionInterface $from, $msg){

        $data = json_decode($msg, true);

        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send(json_encode($msg));
            }
        }
    }*/

    public function onMessage(ConnectionInterface $from, $msg){
        $data = json_decode($msg,true);

        if(empty($data['session_id'])){
            foreach($this->clients as $client){
                if($from == $client) $client->send(json_encode(array("code"=>"500","message"=>"User not authenticated")));
            }
        } else {
            if($this->isValidSession($data['session_id']) !== True){
                foreach($this->clients as $client){
                    if($from == $client) $client->send(json_encode(array("code"=>"500","message"=>"Session is already expired")));
                }
            } else {
                if(empty($data['type'])){
                    foreach($this->clients as $client){
                        if($from == $client) $client->send(json_encode(array("code"=>"500","message"=>"Data type is required")));
                    }
                } else {
                    // wait lang
                }
            }
        }
        
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send(json_encode($msg));
            }
        }

    }
    
    public function onClose(ConnectionInterface $conn){
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e){
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

    public function isValidSession(String $session_id){
        $session = new \RailTime\Session($this->mysqli);
        return $session->isValid($session_id);
    }


}

?>