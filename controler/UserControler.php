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
        $name = $_POST['name'];
        MdlUser::addAListToUser($name);
        $this->display('userInterface',null);
    }

    function changeTargetedList(){
        global $rep, $vues;
        $this->display('userInterface', $_POST['id']);
    }

    function addATask(){
        global $rep, $vuesData;
        MdlUser::addATask($_POST['name'], $_POST['id']);
        $this->display('userInterface', $_POST['id']);
    }

    function changeStatus($status){
        global $rep, $vues;
        MdlUser::changeStatus($_POST['id'], $status);
        $this->display('userInterface', MdlUser::getActualListFromTaskId($_POST['id']));
    }

    function deleteTask(){
        global $rep, $vues;
        if(!Validation::ValideData($_REQUEST, 'id', $dVueError)){
            this->display('ErrorVue');
        }
        $id = Validation::clean($_POST['id']);
        $listId =  MdlUser::getActualListFromTaskId($id);
        MdlUser::deleteTask($id);
        $this->display('userInterface', $listId);
    }

    function deleteList(){
        global $rep, $vues;
        MdlUser::deleteList($_POST['id'], $dVueError);
        $this->display('userInterface',null);
    }

    function display($page, ?string $actualList){
        global $rep, $vues;
        $dataVue = [];

        $dataVue['list'] = MdlUser::getData($_SESSION['login']);
        $dataVue['task'] = MdlUser::getDataTask($actualList);
        $dataVue['targetedList'] = $actualList;

        require($rep.$vues[$page]);
    }
} // fin classe

?>
