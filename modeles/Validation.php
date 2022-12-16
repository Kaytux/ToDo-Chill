<?php

class Validation{
    
    static function valideForm($request, $variable, &$dataVueError):bool{
        if(is_string($variable)){
            if(!isset($request[$variable])){
                $dataVueError[$variable] = "Veuillez renseigner un ".$variable;
                return false;
            }else{
                return true;
            }
        }
        foreach($variable as $row){
            if(!isset($request[$row]) || $request[$row] == ""){
                $dataVueError[$row] = "Veuillez renseigner un ".$row;
                return false;
            }
        }
        return true;
        /*
        if(!isset($email) || $email==""){
            $dataVueError['email'] = "veuillez renseigner un email";
            return false;
        }

        if(!isset($password) || $password==""){
            $dataVueError['password'] = "Veuillez renseigner un mot de passe";
            return false;
        }
        
        return true;
        */
    }

    static function clean($string){
        return htmlspecialchars($string);
    }
}
?>