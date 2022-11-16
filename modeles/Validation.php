<?php

class Validation{
    
    static function valideFormRegister(&$email, &$password, &$dataVueError){
        global $dsn,$user,$mdp;
        if(!isset($email) || $email==""){
            $dataVueError['email'] = "veuillez renseigner un email";
            return;
        }

        if(!isset($password) || $password==""){
            $dataVueError['password'] = "Veuillez renseigner un mot de passe";
            return;
        }

        $con = new Connection($dsn, $user, $mdp);
        $addUser = new UserGateway($con);
        $user = new User($email, $password);
        $addUser->addUserBdd($user);
    }
}

?>