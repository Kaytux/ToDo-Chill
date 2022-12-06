<?php

class Validation{
    
    static function valideForm(&$email, &$password, &$dataVueError):bool{
        if(!isset($email) || $email==""){
            $dataVueError['email'] = "veuillez renseigner un email";
            return false;
        }

        if(!isset($password) || $password==""){
            $dataVueError['password'] = "Veuillez renseigner un mot de passe";
            return false;
        }
        
        return true;
    }

    static function clean($string){
        return htmlspecialchars($string);
    }
}
?>