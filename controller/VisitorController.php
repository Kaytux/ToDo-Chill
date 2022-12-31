<?php

class VisitorController extends ControllerMethods{

    function __construct(){
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
                case "disconnectFromUser":
                    MdlUser::deconnection();
                    require($rep.$vues['homePage']);
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
                case "addAList":
                    $this->addAList();
                    break;
                case "targetAList":
                    $this->changeTargetedList();
                    break;
                case "addATask":
                    $this->addATask();
                    break;
                case "checkTask":
                    $this->changeStatus("1");
                    break;
                case "uncheckTask":
                    $this->changeStatus("0");
                    break;
                case "deleteTask":
                    $this->deleteTask();
                    break;
                case "deleteList":
                    $this->deleteList();
                    break;
                case "goToPrivate":
                    $this->goToPrivate();
                    break;
                case "goToHomePage":
                    $this->Reinit();
                    break;
                default:
                    $dVueError['error'] = "error 404 : Page not found";
                    require($rep.$vues['errorPage']);
                    break;
            }
        }catch(PDOException $e){
            $dVueError['error'] = "error 500 : unreachable database";
            require($rep.$vues['errorPage']);
        }
    }

    function connection(){
        global $rep, $vues;

        $variable = ["email", "password"];
        if(!Validation::valideData($_REQUEST, $variable, $dVueError)){
            require($rep.$vues['homePage']);
            exit;
        }       

        $mail = Validation::clean($_POST['email']);
        $password = Validation::clean($_POST['password']);

        try{
            if(MdlAdmin::connection($mail, $password, $dVueError)){
                $this->display('adminPage', null, $dVueError);
            }elseif(MdlUser::connection($mail, $password, $dVueError)){
                $this->display('userInterface', null, $dVueError);
            }else{
                require($rep.$vues['homePage']);
            }
        }catch(PDOException $e){
            $dVueError['error'] = "error 500 : unreachable database";
            require($rep.$vues['errorPage']);
        }
    }
    
    function createNewAccount(){
        global $rep, $vues;

        $mail = Validation::clean($_POST['email']);
        $password = Validation::clean($_POST['password']);
        $variable = ["email", "password"];

        if(!Validation::valideData($_REQUEST, $variable, $dVueError)){
            require($rep.$vues['signIn']);
            exit;
        }

        try{
            if(MdlVisitor::existPseudonym($mail)){
                $dVueError['alreadyExist'] = "Pseudo déjà utiliser, veuillez en choisir un autre";
                require($rep.$vues['signIn']);
                exit;
            }
            if(MdlVisitor::createNewAccount($mail, $password, $dVueError)){
                require($rep.$vues['homePage']);
                exit;
            }else{
                require($rep.$vues['signIn']);
                exit;
            }
        }catch(PDOException $e){
            $dVueError['error'] = "error 500 : unreachable database";
            require($rep.$vues['errorPage']);
        }
        
    }

    function continueAsAnonymous(){
        MdlVisitor::connection();
        $this->display('userInterface', null, null);
    }

    function goToPrivate(){
        $_SESSION['login'] = $_SESSION['loginHolder'];
        $_SESSION['role'] = 'user';
        unset($_SESSION['loginHolder']);

        $this->display('userInterface', null, null);
    }
}

?>