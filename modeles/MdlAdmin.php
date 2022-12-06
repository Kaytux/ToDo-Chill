<?php
    class MdlAdmin{
        public static function connection($login, $password, &$dVue){
            global $dsn, $usr, $mdp;

            $mail = Validation::clean($login);
            $password = Validation::clean($password);

            if(!Validation::valideForm($mail, $password, $dVue)){return false;}

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new AdminGateway($con);
            $hash = $gateway->getCredentials($mail);
                
            if(password_verify($password, $hash['mdp']) && $hash['isAdmin']===1){
                $_SESSION['login'] = $mail;
                $_SESSION['role'] = 'admin';
                return true;
            }else{
                return false;
            }
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