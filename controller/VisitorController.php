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

                default:
                    echo "erreur page inconnue";
                    break;
            }
        }catch(PDOException $e){
            echo $e;
        }
    }

    function connection(){
        global $rep, $vues;
        
        $mail = Validation::clean($_POST['email']);
        $password = Validation::clean($_POST['password']);
        $variable = ["email", "password"];

        if(!Validation::valideData($_REQUEST, $variable, $dVueError)){
            require($rep.$vues['homePage']);
            exit;
        }

        if(MdlAdmin::connection($mail, $password, $dVueError)){
            $this->display('adminPage', null, $dVueError);
        }elseif(MdlUser::connection($mail, $password, $dVueError)){
            $this->display('userInterface', null, $dVueError);
        }else{
            $this->display('homePage', null, $dVueError);
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

        if(MdlVisitor::createNewAccount($_POST['email'], $_POST['password'], $dVueError)){
            require($rep.$vues['homePage']);
        }else{
            require($rep.$vues['signIn']);
        }
    }

    function continueAsAnonymous(){
        global $rep, $vues;
        MdlVisitor::connection();
        $this->display('userInterface', null, null);
    }
    
    /*
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

    function changeStatus($status){
        global $rep, $vues;
        MdlUser::changeStatus($_POST['id'], $status);
        require($rep.$vues['userInterface']);
    }

    function deleteTask(){
        global $rep, $vues;
        MdlUser::deleteTask($_POST['id']);
        require($rep.$vues['userInterface']);
    }

    function deleteList(){
        global $rep, $vues;
        MdlUser::deleteList($_POST['id'], $dVueError);
        require($rep.$vues['userInterface']);
    }
    
    function display($page){
        global $rep, $vues;
        $dataVue = [];

        $dataVue['list'] = MdlUser::getData($_SESSION['login']);
        count($dataVue['list'])==0 ? $dataVue['task'] = null : $dataVue['task'] = MdlUser::getDataTask($dataVue['list'][0]->getId());
        count($dataVue['list'])==0 ? $dataVue['targetedList'] = null : $dataVue['targetedList'] = $dataVue['list'][0]->getId();

        require($rep.$vues[$page]);
    }
    */
}

?>