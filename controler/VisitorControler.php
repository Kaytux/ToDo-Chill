<?php

class VisitorControler{

    function __construct() {
        $dVueError = array();

        try{
            if(isset($_REQUEST['action'])){
                $action=$_REQUEST['action'];
            }else{
                $action=NULL;
            }

            switch($action){
                case NULL:
                    $this->Reinit();
                    break;
                case "connect":
                    $this->connection();
                    break;
                default:
                    echo "erreur page inconnue";
                    break;
            }
        }catch(PDOException $e){
            echo $e;
        }
    }

    function Reinit(){
        global $rep, $vues;
        require($rep.$vues['homePage']);
    }
    
    function connection(){
        global $rep, $vues;
        if(MdlAdmin::connection($_POST['email'], $_POST['password'], $dVueError)){
            require($rep.$vues['adminPage']);
        }elseif(MdlUser::connection($_POST['email'], $_POST['password'], $dVueError)){
            require($rep.$vues['userInterface']);
        }else{
            require($rep.$vues['homePage']);
        }
    }
}

?>