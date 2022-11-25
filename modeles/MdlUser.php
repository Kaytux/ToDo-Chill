<?php
    class MdlUser{
        public static function connection($login, $mdp){
            $_SESSION['role'] =  'user';
            $_SESSION['login'] = $login;
        }

        public static function deconnection(){
            session_unset();
            session_destroy();
            $_SESSION = array();
        }
    }
?>