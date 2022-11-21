<?php

class Controler{
    
    function __construct(){

        global $rep,$vues;
        session_start();
        $dVueError = array();
        $vueSpecificities = array();

        try{
            if(isset($_REQUEST['action'])){
                $action=$_REQUEST['action'];
            }
            else{
                $action=NULL;
            }        
            switch($action){
                case NULL:
                    $this->Reinit();
                    break;        
                case "signIn":
                    require($rep.$vues['signIn']);
                    break;
                case "logIn":
                    require($rep.$vues['logIn']);
                    break;
                case "createUser":
                    $this->validateRegisterForm();
                    break;
                case "accessAccount":
                    $this->validateLoginForm();
                    break;
                case "signOut":
                    $this->Reinit();
                    break;
                case "displayAskingNameDiv":
                    $vueSpecificities['visibility'] = "display";
                    require($rep.$vues['homePage']);
                    break;
                case "createNewList":
                    $this->createNewList();
                    require($rep.$vues['homePage']);
                    break;
                case "test":
                    $this->test();
                    break;
                default:
                    break;
            }
        }catch(PDOException $e){
            echo "";
        }
        
    } // fin constructeur
    
    function Reinit(){
        global $rep, $vues;
        require($rep.$vues['homePage']); 
        }

    function validateRegisterForm(){
        global $rep, $vues;

        $email=$_POST['email'];
        $password=$_POST['password'];

        Validation::valideFormRegister($email, $password, $dVueError);

        if(isset($dVueError['email']) || isset($dVueError['password'])){
            require($rep.$vues['signIn']);
        }
        else{
            require($rep.$vues['homePage']);
        }
    }

    function validateLoginForm(){
        global $rep, $vues;

        $email=$_POST['email'];
        $password=$_POST['password'];

        if(Validation::valideFormLogin($email, $password, $dVueError)){
            require($rep.$vues['mainPage']);
        }else{
            require($rep.$vues['logIn']);
        }
    }

    function createNewList(){
        global $dsn, $usr, $mdp, $connectedUser;

        $name = $_POST['listName'];
        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new TaskGateway($con);
        $gateway->createNewListBdd($connectedUser['email'], $name);
        return;
    }

    function test(){
        global $dsn, $usr, $mdp;

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new AdminGateway($con);
        $gateway->createTable();
        return;
    }

    } // fin classe

?>