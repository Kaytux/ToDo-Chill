<?php

class FrontControler{
    
    function __construct(){
        global $rep, $vues, $connectedUser;

        $dVueError = array();
        $listeAction_Admin = array('deconnecter', 'supprimer', 'ajouter');
        // MdlAdmin::connection('admin', 'admin');

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
                case "continueAsAnonymous":
                    require($rep.$vues['logIn']);
                    break;
                case "connect":
                    $this->connection();
                    break;
                default:
                    break;
            }

            $admin = MdlAdmin::isAdmin();
            if($admin === null){
                new UserControler();
            }else{
                new AdminControler();
            }

        }catch(Exception $e){
            echo "<p>A faire $e</p>";
        }
    }

    function Reinit(){
        global $rep, $vues;
        require($rep.$vues['homePage']);
        return;
    }

    function connection(){
        global $rep, $vues;
        $email = $_POST['email'];
        $mdp = $_POST['password'];


        if(Validation::valideFormLogin($email, $mdp, $dVueError)){
            if(isset($dVueError['email']) || isset($dVueError['password'])){
                require($rep.$vues['homePage']);
            }
            if(isset($dVueError['spec'])){
                MdlAdmin::connection($email, $mdp);
            }
        }
        else{
            require($rep.$vues['homePage']);
        }
    }
}
?>