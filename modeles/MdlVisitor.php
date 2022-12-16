<?php

class MdlVisitor{
    public static function connection(){
        $_SESSION['role'] = 'anonymous';
        $_SESSION['login'] = null;
        $_SESSION['list'] = MdlVisitor::getListData();
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
}

?>