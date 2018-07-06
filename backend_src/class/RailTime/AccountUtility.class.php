<?php
/**
 * RailTime
 * 2018
 * 
 * API
 * Class
 * 
 * AccountUtility
 */

namespace RailTime;

class AccountUtility {
    
    public function passwordValid(String $password){
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

    public function passwordHash(String $password){
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        return $password_hash;
    }

    public function passwordVerify(String $password, String $hash){
        if(password_verify($password,$hash)){
            return True;
        } else {
            return False;
        }
    }

    public function usernameSanitize(String $username){
        $username = strtolower(str_replace(' ','',$username));
        return $username;
    }

    public function generateID(){
        return uniqid('',true);
    }

}

?>