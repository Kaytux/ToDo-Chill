<?php
    class MdlUser{
        public static function connection($login, $password){
            global $dsn, $usr, $mdp;

            $mail = Validation::clean($login);
            $password = Validation::clean($password);

            if(!Validation::valideForm($mail, $password, $dVue)){return false;}

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new UserGateway($con);
            $hash = $gateway->getCredentials($mail);
                
            if(password_verify($password, $hash['mdp'])){
                $_SESSION['login'] = $mail;
                $_SESSION['role'] = 'admin';
                return true;
            }else{
                return false;
            }
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

        public static function getDataTask($idTask){
            global $dsn, $usr, $mdp;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $id = $gateway->getIdFromListName($idTask);
            $data = $gateway->getTaskFromList($id[0]['id']);

            return $data;
        }
        
        public static function deconnection(){
            session_unset();
            session_destroy();
            $_SESSION = array();
        }
    }
?>