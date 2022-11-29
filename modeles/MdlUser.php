<?php
    class MdlUser{
        public static function connection($login, $mdp){
            $_SESSION['role'] =  'user';
            $_SESSION['login'] = $login;

            global $dsn, $usr, $mdp;
            $con = new connection($dsn, $usr, $mdp);
            $gateway = new UserGateway($con);

            $data = $gateway->getData($login);
        }

        public static function deconnection(){
            session_unset();
            session_destroy();
            $_SESSION = array();
        }
    }
?>