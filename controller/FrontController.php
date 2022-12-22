<?php

class FrontControler{
    
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
                    new AdminControler();
                }
            }else{
                if($user != null){
                    new UserControler();
                }else{
                    new VisitorControler();
                }
            }
            

        }catch(Exception $e){
            echo "<p>A faire $e</p>";
        }
    }
}
?>