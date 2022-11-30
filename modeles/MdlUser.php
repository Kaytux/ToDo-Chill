<?php
    class MdlUser{
        public static function connection($login){
            $_SESSION['role'] =  'user';
            $_SESSION['login'] = $login;
        }

        public static function getData($mail){
            global $dsn, $usr, $mdp;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new UserGateway($con);
            $data = $gateway->getData($mail);

            return $data;
        }

        public static function addAListToUser($user, $task){
            global $dsn, $usr, $mdp;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $gateway->createNewListBdd($user, $task->getListName());
        }

        public static function getDataTask($idTask){
            global $dsn, $usr, $mdp;
            $id = $idTask['id'];

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $data = $gateway->getTaskFromList($id);

            return $data;
        }

        /*
        public function isListSet(){
            $taskList = $this->user->getTaskList();
            if(isset($taskList) && count($taskList)>0){return true;}
            return false;
        }

        public function getList(){
            return $this->user->getTaskList();
        }

        public function addAList($list){
            $this->user->addAList($list);
        }
        */

        public static function deconnection(){
            session_unset();
            session_destroy();
            $_SESSION = array();
        }
    }
?>