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
                    $_SESSION['list'] = MdlUser::getData($mail);
                    if(count($_SESSION['list'])!=0){
                        $_SESSION['task'] = MdlUser::getDataTask($_SESSION['list'][0]->getId());
                        $_SESSION['targetedList'] = $_SESSION['list'][0]->getId();
                    }
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
            $_SESSION['list'] = MdlUser::getData($_SESSION['login']);
            foreach($_SESSION['list'] as $row){
                if($row->getName() == $list->getName()){
                    $_SESSION['targetedList'] = $row->getId();
                    $_SESSION['task'] = MdlUser::getDataTask($_SESSION['targetedList']);
                }
            }
        }

        public static function addATask($name){
            global $dsn, $usr, $mdp;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $task = new Task("null", $name, false, $_SESSION['targetedList']);
            $gateway->addTaskBdd($task);
            $_SESSION['task'] = MdlUser::getDataTask($_SESSION['targetedList']);
        }

        public static function createNewAccount($login, $email, &$dVue){
            global $dsn, $usr, $mdp;

            if(!Validation::valideForm($login, $email, $dVue)){
                return false;
            }

            $mail = htmlspecialchars($login);
            $pass = password_hash(htmlspecialchars($email),PASSWORD_DEFAULT);

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new UserGateway($con);
            if($gateway->addUserBdd($mail, $pass)){
                return true;
            }else{
                $dVue['error'] = 'impossible de se connecter à la bdd';
                return false;
            }
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

            $_SESSION['task'] = MdlUser::getDataTask($_SESSION['targetedList']);
        }

        public static function deleteTask($id){
            global $dsn, $usr, $mdp;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $gateway->deleteTaskBdd($id);

            $_SESSION['task'] = MdlUser::getDataTask($_SESSION['targetedList']);
        }

        public static function deleteList($id, &$dVue){
            global $dsn, $usr, $mdp;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $nbTask = $gateway->getNbTask($id);

            if($nbTask[0]["count(*)"] != 0){
                $dVue['error'] = "Vous ne pouvez pas supprimer une liste non vide";
                return;
            }

            $gateway->deleteListBdd($id);
            $_SESSION['list'] = MdlUser::getData($_SESSION['login']);
        }

        public static function deconnection(){
            session_unset();
            session_destroy();
            $_SESSION = array();
        }
    }
?>