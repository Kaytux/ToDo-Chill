<?php

class FrontController{
    
    function __construct(){
        global $rep, $vues;

        session_start();

        $listeAction_admin=array("disconnectFromAdmin","createTableBdd","createUser","deleteAllDataBdd","deleteAllTableBdd");

        try{
            $admin = MdlAdmin::isAdmin();
            $user = MdlUser::isUser();

            if(isset($_REQUEST['action'])){
                $action=$_REQUEST['action'];
            }else{
                $action = NULL;
            }

            if(in_array($action, $listeAction_admin)){
                if($admin === null){
                    require($rep.$vues['homePage']);
                }else{
                    $cont = new AdminController();
                }
            }else{
                if($user != null){
                    $cont = new UserController();
                }else{
                    $cont = new VisitorController();
                }
            }
            

        }catch(Exception $e){
            echo "<p>A faire $e</p>";
        }
    }

    function createBdd(){
        global $dsn, $usr, $mdp;

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new AdminGateway($con);
        $gateway->createTable();
    }
}
?>