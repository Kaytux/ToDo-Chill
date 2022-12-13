<?php
    class MdlUser{
        public static function connection($login, $password, &$dVue){
            global $dsn, $usr, $mdp;

            $mail = Validation::clean($login);
            $password = Validation::clean($password);

            if(!Validation::valideForm($mail, $password, $dVue)){return false;}

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new UserGateway($con);
            if(!$hash = $gateway->getCredentials($mail)){
                return false;
            }
                
            if(password_verify($password, $hash['mdp'])){
                $_SESSION['login'] = $mail;
                $_SESSION['role'] = 'admin';
                $_SESSION['list'] = MdlUser::getData($mail);
                var_dump($_SESSION['list'][0]);
                $_SESSION['task'] = MdlUser::getDataTask($_SESSION['list'][0]->getId());
                return true;
            }else{
                $dVue['credentials'] = "mot de passe incorect";
                return false;
            }
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
            $list = new TaskList($task, $_SESSION['login']);
            $gateway->createNewListBdd($list);
            $_SESSION['list'] = MdlUser::getData($_SESSION['login']);
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

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $data = $gateway->getTaskFromList($idList);

            return $data;
        }
        
        public static function deconnection(){
            session_unset();
            session_destroy();
            $_SESSION = array();
        }
    }
?>