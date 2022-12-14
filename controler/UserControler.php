<?php

class UserControler{
    
    function __construct(){
        global $rep,$vues;

        $dVueError = array();

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
                case "connect":
                    $this->connection();
                    break;
                case "SignIn":
                    require($rep.$vues['signIn']);
                    break;
                case "createNewAccount":
                    $this->createNewAccount();
                    break;
                case "disconnectFromUser":
                    MdlUser::deconnection();
                    require($rep.$vues['homePage']);
                    break;
                case "addAList":
                    $this->addAList();
                    break;
                case "targetAList":
                    $this->changeTargetedList();
                    break;
                case "addATask":
                    $this->addATask();
                    break;
                default:
                    echo "erreur page inconnue";
                    break;
            }
        }catch(PDOException $e){
            echo "$e";
        }
        
    } // fin constructeur
    
    function Reinit(){
        global $rep, $vues;
        require($rep.$vues['homePage']);
    }
    
    function connection(){
        global $rep, $vues;
        if(MdlAdmin::connection($_POST['email'], $_POST['password'], $dVueError)){
            require($rep.$vues['adminPage']);
        }elseif(MdlUser::connection($_POST['email'], $_POST['password'], $dVueError)){
            require($rep.$vues['userInterface']);
        }else{
            require($rep.$vues['homePage']);
        }
    }

    function createNewAccount(){
        global $rep, $vues;
        if(MdlUser::createNewAccount($_POST['email'], $_POST['password'], $dVueError)){
            require($rep.$vues['homePage']);
        }else{
            require($rep.$vues['signIn']);
        }
    }

    function addAList(){
        global $rep, $vues;
        $name = $_POST['name'];
        MdlUser::addAListToUser($name);
        require($rep.$vues['userInterface']);
    }

    function changeTargetedList(){
        global $rep, $vues;
        $_SESSION['task'] = MdlUser::getDataTask($_POST['id']);
        $_SESSION['targetedList'] = $_POST['id'];
        require($rep.$vues['userInterface']);
    }

    function addATask(){
        global $rep, $vues;
        MdlUser::addATask($_POST['name']);
        require($rep.$vues['userInterface']);
    }
} // fin classe

?>