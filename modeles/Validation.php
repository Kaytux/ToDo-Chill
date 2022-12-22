<?php

class Validation{
    
    static function valideData($request, $variable, &$dataVueError):bool{
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
    }

    static function valideNewData($name, &$dataVueError):bool{
        if(strlen($name)>40){
            $dataVueError['nameLenght'] = "Nom trop long, maximum 40 caractères";
            return false;
        }
        return true;
    }

    static function clean($string){
        return htmlspecialchars($string);
    }
}
?>