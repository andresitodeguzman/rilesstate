<?php
namespace RailTime;

class Customer {

    public $customer_id;

    private $mysqli;

    function construct($mysqli){
        if(!$mysqli) return "Mysqli connection is required";
        $this->mysqli = $mysqli;
    }

    public function get($id){
        return array();
    }

    public function getAll(){
        return array();
    }

    public function add($array){
        return True;
    }

    public function delete($id){
        return True;
    }

    public function update($array){
        return True;
    }
    
}
?>