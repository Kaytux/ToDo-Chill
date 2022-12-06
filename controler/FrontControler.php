<?php

class FrontControler{
    
    function __construct(){
        global $rep, $vues;

        session_start();

        $listeAction_admin=array("disconnectFromAdmin","createTableBdd","createUser","deleteAllDataBdd","deleteAllTableBdd");

        // MdlAdmin::connection('admin', 'admin');
        // MdlAdmin::deconnection();

        try{
            $admin = MdlAdmin::isAdmin();
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
                new UserControler();
            }
            

        }catch(Exception $e){
            echo "<p>A faire $e</p>";
        }
    }
}
?>