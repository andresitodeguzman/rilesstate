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
    
    public function passwordValid($password){
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

    public function passwordHash($password){
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        return $password_hash;
    }

    public function passwordVerify($password,$hash){
        if(password_verify($password,$hash)){
            return True;
        } else {
            return False;
        }
    }

    public function usernameSanitize($username){
        $username = strtolower(str_replace(' ','',$username));
        return $username;
    }

}

?>