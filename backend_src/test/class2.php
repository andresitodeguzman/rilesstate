<?php
/**
 * RailTime
 * 2018
 * 
 * Test for OOP inheritance
 */

namespace HW;

require_once("class1.php");

class DEF extends ABC {
    function hahaha($param){
        return $this->helloWorld($param);
    }
}

$def = new DEF();
echo $def->hahaha("Helllooo");
?>