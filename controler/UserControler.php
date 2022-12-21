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
                    MdlUser::deconnection();
                    $this->Reinit();
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
            echo "$e";
        }
        
    } // fin constructeur
    
    function Reinit(){
        global $rep, $vues;
        require($rep.$vues['homePage']);
    }
    
    function addAList(){
        global $rep, $vues;
        $variable = ["name"];
        $name = Validation::clean($_POST['name']);
        if(!Validation::valideData($_REQUEST, $variable, $dVueError)){
            $this->display('userInterface', null, $dVueError);
            exit;
        }
        MdlUser::addAListToUser($name);
        $this->display('userInterface',null, null);
    }

    function changeTargetedList(){
        global $rep, $vues;
        $id = Validation::clean($_POST['id']);
        $variable = ["id"];
        if(!Validation::valideData($_REQUEST, $variable, $dVueError)){
            $this->display('userInterface', null, $dVueError);
            exit;
        }
        $this->display('userInterface', $_POST['id'], null);
    }

    function addATask(){
        global $rep, $vuesData;
        $variable = ["name", "id"];
        $name = Validation::clean($_POST['name']);
        $id = Validation::clean($_POST['id']);
        if(!Validation::valideData($_REQUEST, $variable, $dVueError)){
            $this->display('userInterface', $id, $dVueError);
            exit;
        }
        MdlUser::addATask($name, $id);
        $this->display('userInterface', $id, null);
    }

    function changeStatus($status){
        global $rep, $vues;
        $variable = ["id"];
        $id = Validation::clean($_POST['id']);
        if(!Validation::valideData($_REQUEST, $variable, $dVueError)){
            $this->display('userInterface', null, $dVueError);
            exit;
        }
        MdlUser::changeStatus($id, $status);
        $this->display('userInterface', MdlUser::getActualListFromTaskId($id), null);
    }

    function deleteTask(){
        global $rep, $vues;
        $id = Validation::clean($_POST['id']);
        $listId =  MdlUser::getActualListFromTaskId($id);
        if(!Validation::valideData($_REQUEST, 'id', $dVueError)){
            this->display('ErrorVue', $_POST['id'], $dVueError);
        }
        MdlUser::deleteTask($id);
        $this->display('userInterface', $listId, null);
    }

    function deleteList(){
        global $rep, $vues;
        MdlUser::deleteList($_POST['id'], $dVueError);
        $this->display('userInterface', $_POST['id'], $dVueError);
    }

    function display($page, ?string $actualList, ?array $dVueError){
        global $rep, $vues;
        $dataVue = [];

        $dataVue['list'] = MdlUser::getData($_SESSION['login']);
        $dataVue['task'] = MdlUser::getDataTask($actualList);
        $dataVue['targetedList'] = $actualList;

        require($rep.$vues[$page]);
    }
} // fin classe

?>
