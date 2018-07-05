<?php
$pw = $_REQUEST['password'];

function passwordValid(String $password){
    if(strlen($password) < 8){
        return False;
    } else {
        if(preg_match('/[A-Z]/',$password)){
            if(preg_match('/\d/',$password)){
                return True;
            } else {
                return False;
            }
        } else {
            return False;
        }
    }
}

$a = passwordValid($pw);
if($a){
    echo "haha";
} else {
    echo "hehe";
}

?>