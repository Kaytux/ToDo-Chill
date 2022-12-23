<?php

class ControllerMethods{
    
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
        if(!Validation::valideNewData($name, $dVueError)){
            $this->display('userInterface', null, $dVueError);
            exit;
        }
        try{
            MdlUser::addAListToUser($name);
        }catch(PDOException){
            $dVueError['error'] = "error 500 : unreachable database";
            require($rep.$vues['errorPage']);
            exit;
        }
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
        if(isset($_POST['id'])){
            $id = Validation::clean($_POST['id']);
        }

        if(!Validation::valideData($_REQUEST, $variable, $dVueError)){
            $this->display('userInterface', null, $dVueError);
            exit;
        }
        if(!Validation::valideNewData($name, $dVueError)){
            $this->display('userInterface', null, $dVueError);
            exit;
        }
        try{
            MdlUser::addATask($name, $id);
        }catch(PDOException){
            $dVueError['error'] = "error 500 : unreachable database";
            require($rep.$vues['errorPage']);
            exit;
        }
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
        try{
            MdlUser::changeStatus($id, $status);
        }catch(PDOException){
            $dVueError['error'] = "error 500 : unreachable database";
            require($rep.$vues['errorPage']);
            exit;
        }
        $this->display('userInterface', MdlUser::getActualListFromTaskId($id), null);
    }

    function deleteTask(){
        global $rep, $vues;
        $id = Validation::clean($_POST['id']);
        $listId =  MdlUser::getActualListFromTaskId($id);
        if(!Validation::valideData($_REQUEST, 'id', $dVueError)){
            this->display('ErrorVue', $_POST['id'], $dVueError);
        }
        try{
            MdlUser::deleteTask($id);
        }catch(PDOException){
            $dVueError['error'] = "error 500 : unreachable database";
            require($rep.$vues['errorPage']);
            exit;
        }
        $this->display('userInterface', $listId, null);
    }

    function deleteList(){
        global $rep, $vues;
        try{
            MdlUser::deleteList($_POST['id'], $dVueError);
        }catch(PDOException){
            $dVueError['error'] = "error 500 : unreachable database";
            require($rep.$vues['errorPage']);
            exit;
        }
        $this->display('userInterface', $_POST['id'], $dVueError);
    }

    function display($page, ?string $actualList, ?array $dVueError){
        global $rep, $vues;
        $dataVue = [];

        if(isset($_SESSION['login'])){
            $dataVue['list'] = MdlUser::getData($_SESSION['login']);
            $dataVue['task'] = MdlUser::getDataTask($actualList);
            $dataVue['targetedList'] = $actualList;
        }

        require($rep.$vues[$page]);
    }
}