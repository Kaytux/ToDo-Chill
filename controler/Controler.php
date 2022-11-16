<?php

class Controler{
    
    function __construct(){

        global $rep,$vues;
        session_start();
        $dVueError = array();

        try{
            if(isset($_REQUEST['action'])){
                $action=$_REQUEST['action'];
            }
            else{
                $action=NULL;
            }        
            switch($action){
                case NULL:
                    $this->Reinit();
                    break;        
                case "signIn":
                case "logIn":
                    require($rep.$vues['signIn']);
                    break;
                case "createUser":
                    $this->validateRegisterForm();
                    break;
            }
        }catch(PDOException $e){
            echo 'a faire plus tard';
        }
        
    } // fin constructeur
    
    function Reinit(){
        global $rep, $vues;
        require($rep.$vues['acceuil']); 
        }

    function validateRegisterForm(){
        global $rep, $vues;

        $email=$_POST['email'];
        $password=$_POST['password'];

        Validation::valideFormRegister($email, $password, $dVueError);

        if(isset($dVueError['email']) || isset($dVueError['password'])){
            require($rep.$vues['signIn']);
        }
        else{
            require($rep.$vues['acceuil']);
        }
    }

    } // fin classe
?>