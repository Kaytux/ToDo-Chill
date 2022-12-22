<?php

class MdlVisitor{
    public static function connection(){
        $_SESSION['role'] = 'anonymous';
        $_SESSION['login'] = null;
        $_SESSION['list'] = MdlVisitor::getListData();
        $_SESSION['targetedList'] = $_SESSION['list'][0]->getId();
        $_SESSION['task'] = MdlUser::getDataTask($_SESSION['targetedList']);
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
    
    public static function createNewAccount($login, $email, &$dVue){
            global $dsn, $usr, $mdp;

            $mail = htmlspecialchars($login);
            $pass = password_hash(htmlspecialchars($email),PASSWORD_DEFAULT);

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new UserGateway($con);
            if($gateway->addUserBdd($mail, $pass)){
                return true;
            }else{
                $dVue['error'] = 'impossible de se connecter à la bdd';
                return false;
            }
        }


}

?>