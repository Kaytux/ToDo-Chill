<?php
    class MdlUser{

        public static function connection($mail, $password, &$dVue){
            global $dsn, $usr, $mdp;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new UserGateway($con);
            if(!$hash = $gateway->getCredentials($mail)){
                return false;
            }

            if(password_verify($password, $hash['mdp'])){
                $_SESSION['login'] = $mail;
                $_SESSION['role'] = 'user';
                return true;
            }else{
                $dVue['credentials'] = "mot de passe incorect";
                return false;
            }
        }
        
        public static function isUser(): ?User{
            if(isset($_SESSION['login']) && isset($_SESSION['role']) && $_SESSION['role'] == "user"){
                return new User($_SESSION['login']);
            }
            return null;
        }

        public static function getData($mail){
            global $dsn, $usr, $mdp;
            $results = array();
            
            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new UserGateway($con);
            $data = $gateway->getData($mail);
            foreach($data as $row){
                array_push($results, new TaskList($row['id'], $row['name'], $row['mailUser']));
            }
            return $results;
        }

        public static function addAListToUser($task){
            global $dsn, $usr, $mdp;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $list = new TaskList("null", $task, $_SESSION['login']);
            $gateway->createNewListBdd($list);
        }

        public static function addATask($name, $id){
            global $dsn, $usr, $mdp;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $task = new Task("null", $name, false, $id);
            $gateway->addTaskBdd($task);
        }

        public static function getDataTask($idList){
            global $dsn, $usr, $mdp;
            $results = array();

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $data = $gateway->getTaskFromList($idList);

            foreach($data as $row){
                array_push($results, new Task($row['id'], $row['name'], $row['status'], $row['idTasksList']));
            }
            return $results;
        }
        
        public static function changeStatus($id, $status){
            global $dsn, $usr, $mdp;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $gateway->changeTaskStatus($id, $status);
        }

        public static function deleteTask($id){
            global $dsn, $usr, $mdp;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $gateway->deleteTaskBdd($id);
        }

        public static function deleteList($id, &$dVue){
            global $dsn, $usr, $mdp;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $nbTask = $gateway->getNbTask($id);

            if($nbTask[0]["count(*)"] != 0){
                $dVue['nonEmptyList'] = "Vous ne pouvez pas supprimer une liste non vide";
                return;
            }

            $gateway->deleteListBdd($id);
        }

        public static function getActualListFromTaskId($id){
            global $dsn, $usr, $mdp ;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new UserGateway($con);
            $results = $gateway->getListFromTask($id);
            
            return $results[0]['idTasksList'];
        }

        public static function deconnection(){
            session_unset();
            session_destroy();
            $_SESSION = array();
        }
    }
?>