<?php
    class MdlUser{
        public static function connection($login, $mdp){
            $_SESSION['role'] =  new User($login);
            $_SESSION['login'] = $login;
        }

        public static function deconnection(){
            session_unset();
            session_destroy();
            $_SESSION = array();
        }

        public static function getData($id){
            global $dsn, $usr, $mdp;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new UserGateway($con);
            return $gateway->getData($id);
        }
    }
?>