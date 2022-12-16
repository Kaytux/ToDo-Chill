<?php

class VisitorControler{

    function __construct() {
        global $rep, $vues;
        $dVueError = array();

        try{
            if(isset($_REQUEST['action'])){
                $action=$_REQUEST['action'];
            }else{
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
                case "continueAsAnonymous":
                    $this->continueAsAnonymous();
                    break;
                default:
                    echo "erreur page inconnue";
                    break;
            }
        }catch(PDOException $e){
            echo $e;
        }
    }

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

    function continueAsAnonymous(){
        global $rep, $vues;
        MdlVisitor::connection();
        require($rep.$vues['userInterface']);
    }
}

?>