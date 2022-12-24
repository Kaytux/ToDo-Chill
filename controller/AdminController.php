<?php

class AdminController{

    function __construct(){

        global $rep, $vues;

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
                case "disconnectFromAdmin":
                    MdlAdmin::deconnection();
                    require($rep.$vues['homePage']);
                    break;
                case "createTableBdd":
                    $this->createTableBdd();
                    $this->Reinit();
                    break;
                case "createUser":
                    $this->createUser();
                    $this->Reinit();
                    break;
                case "deleteAllDataBdd":
                    $this->deleteAllDataBdd();
                    $this->Reinit();
                    break;
                case "deleteAllTableBdd":
                    $this->deleteAllTableBdd();
                    $this->Reinit();
                    break;
                default:
                    $dVueError['error'] = "error 404 : Page not found";
                    require($rep.$vues['errorPage']);
                    break;
            }
        }catch(PDOException $e){
            echo $e;
            $dVueError['error'] = "error 500 : unreachable database";
            require($rep.$vues['errorPage']);
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

        $mail = Validation::clean($_POST['email']);
        $password = Validation::clean($_POST['password']);
        $variable = ["email", "password"];

        if(!Validation::valideData($_REQUEST, $variable, $dVueError)){
            $this->display('adminPage', null, $dVueError);
            exit;
        }

        $pass = password_hash($password,PASSWORD_DEFAULT);
        $con = new Connection($dsn, $usr, $mdp);
        $user = new User($mail, $pass);

        if(isset($_POST['isAdmin'])){
            $gateway = new AdminGateway($con);
            $gateway->createNewAdmin($user);
        }else{
            $gateway = new UserGateway($con);
            $gateway->addUserBdd($user);
        }
        return;
    }

    function deleteAllDataBdd(){
        global $dsn, $usr, $mdp;

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new AdminGateway($con);
        $gateway->deleteAllDataBdd();
        return;
    }

    function deleteAllTableBdd(){
        global $dsn, $usr, $mdp;

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new AdminGateway($con);
        $gateway->deleteAllTableBdd();
        return;
    }
}

?>