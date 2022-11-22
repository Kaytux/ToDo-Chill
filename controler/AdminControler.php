<?php

class AdminControler{

    function __construct(){

        global $rep, $vues;
        session_start();

        try{
            if(isset($_REQUEST['action'])){
                $action=$_REQUEST['action'];
            }else{
                $action = NULL;
            }

            switch($action){
                case NULL:
                    $this->Reinit();
                    break;
                case "createTableBdd":
                    $this->createTableBdd();
                    $this->Reinit();
                    break;
                case "createUser":
                    $this->createUser();
                    $this->Reinit();
                    break;
                case "deleteAllBdd":
                    $this->deleteAllBdd();
                    $this->Reinit();
                    break;
                case "disconnectFromAdmin":
                    MdlAdmin::deconnection();
                    break;
                default:
                    $this->Reinit();
                    break;
            }
        }catch(PDOException $e){
            echo "$e";
        }
    }

    function Reinit(){
        global $rep, $vues;
        require($rep.$vues['adminPage']);
    }

    function createTableBdd(){
        global $dsn, $usr, $mdp;

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new AdminGateway($con);
        $gateway->createTable();
        return;
    }

    function createUser(){
        global $dsn, $usr, $mdp;

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new UserGateway($con);
        $user = new User($_POST['email'], $_POST['password']);
        $gateway->addUserBdd($user);
        return;
    }

    function deleteAllBdd(){
        global $dsn, $usr, $mdp;

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new AdminGateway($con);
        $gateway->deleteAllBdd();
        return;
    }
}

?>