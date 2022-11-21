<?php

class Validation{
    
    static function valideFormRegister(&$email, &$password, &$dataVueError){
        global $dsn,$usr,$mdp;
        if(!isset($email) || $email==""){
            $dataVueError['email'] = "veuillez renseigner un email";
            return;
        }

        if(!isset($password) || $password==""){
            $dataVueError['password'] = "Veuillez renseigner un mot de passe";
            return;
        }

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new UserGateway($con);
        $user = new User($email, $password);
        $gateway->addUserBdd($user);
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
        if($gateway->searchUserIdentidiant($user)){
            return true;
        }else{
            $dataVueError['unknonw'] = "identifiant inconnue";
            return false;
        }
    }
}
?>