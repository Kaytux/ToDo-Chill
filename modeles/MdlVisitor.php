<?php

class MdlVisitor{
    public static function connection(){
        $_SESSION['role'] = 'anonymous';
        $_SESSION['login'] = null;
    }

    public static function getListData(){
        global $dsn, $usr, $mdp;
        $results = [];

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new UserGateway($con);
        $data = $gateway->getData($_SESSION['login']);
        
        foreach($data as $row){
            array_push($results, new TaskList($row['id'], $row['name'], "null"));
        }
        return $results;
    }
    
    public static function createNewAccount($login, $pass){
        global $dsn, $usr, $mdp;

        $pass = password_hash($pass,PASSWORD_DEFAULT);

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new UserGateway($con);
        $gateway->addUserBdd($login, $pass);
    }

    public static function existPseudonym($login){
        global $dsn, $usr, $mdp;

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new UserGateway($con);
        $results = $gateway->getCredentials($login);
        if($results!=false){
            return true;
        }
        return false;
    }


}

?>