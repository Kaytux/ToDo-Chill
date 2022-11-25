<?php
    class MdlAdmin{
        public static function connection($login, $mdp){
            $_SESSION['role'] =  'admin';
            $_SESSION['login'] = $login;
        }

        public static function deconnection(){
            session_unset();
            session_destroy();
            $_SESSION = array();
        }

        public static function isAdmin(){
            if(isset($_SESSION['login']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
                return new Admin($_SESSION['login'], $_SESSION['role']);
            }
            return null;
        }
    }
?>