<?php

class UserControler extends ControllerMethods{
    
    function __construct(){
        global $rep,$vues;

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
                    MdlUser::deconnection();
                    $this->Reinit();
                    break;        
                case "disconnectFromUser":
                    MdlUser::deconnection();
                    require($rep.$vues['homePage']);
                    break;
                case "addAList":
                    $this->addAList();
                    break;
                case "targetAList":
                    $this->changeTargetedList();
                    break;
                case "addATask":
                    $this->addATask();
                    break;
                case "checkTask":
                    $this->changeStatus("1");
                    break;
                case "uncheckTask":
                    $this->changeStatus("0");
                    break;
                case "deleteTask":
                    $this->deleteTask();
                    break;
                case "deleteList":
                    $this->deleteList();
                    break;
                default:
                    echo "erreur page inconnue";
                    break;
            }
        }catch(PDOException $e){
            echo "$e";
        }
        
    } // fin constructeur
} // fin classe

?>
