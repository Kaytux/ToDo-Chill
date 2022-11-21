<?php

class AdminControler{

    function __construct(){

        global $rep, $vues;
        session_start();

        try{
            if(isset($_REQUEST['action'])){
                $action=$_REQUEST['action'];
            }else{
                $action = NULL;
            }

            switch($action){
                case NULL:
                    $this->Reinit();
                    break;
                default:
                    $this->Reinit();
                    break;
            }
        }catch(PDOException $e){
            echo "$e";
        }
    }

    function Reinit(){
        global $rep, $vues;
        require($rep.$vues['adminPage']);
    }
}

?>