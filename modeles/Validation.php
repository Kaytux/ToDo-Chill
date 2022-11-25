<?php

class Validation{
    
    static function valideFormRegister(&$email, &$password, &$dataVueError):bool{
        global $dsn,$usr,$mdp;
        if(!isset($email) || $email==""){
            $dataVueError['email'] = "veuillez renseigner un email";
            return false;
        }

        if(!isset($password) || $password==""){
            $dataVueError['password'] = "Veuillez renseigner un mot de passe";
            return false;
        }

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new UserGateway($con);
        $user = new User($email, $password);
        $gateway->addUserBdd($user);
        return true;
    }

    static function valideFormLogin(&$email, &$password, &$dataVueError):bool{
        global $dsn, $usr, $mdp;
        if(!isset($email) || $email==""){
            $dataVueError['email'] = "veuillez renseigner un email";
            return false;
        }

        if(!isset($password) || $password==""){
            $dataVueError['password'] = "Veuillez renseigner un mot de passe";
            return false;
        }

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new UserGateway($con);
        $user = new User($email, $password);
        $test=$gateway->searchUserIdentidiant($user);

        if($test==="test"){
            $dataVueError['spec']="admin";
            return true;
        }
        if($test==="false"){
            $dataVueError['unknonw'] = "identifiant inconnue";
            return false;
        }
        return $test;
    }
}
?>