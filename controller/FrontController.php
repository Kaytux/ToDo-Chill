<?php

class FrontController{
    
    function __construct(){
        global $rep, $vues;

        session_start();

        $dVueError = array();
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
            $dVueError['error'] = "error 404 : Page not found";
            require($rep.$vues['errorPage']);
            exit;
        }
    }
}
?>