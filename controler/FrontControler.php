<?php

class FrontControler{
    
    function __construct(){
        global $rep, $vues;

        session_start();

        $listeAction_Admin = array('deconnecter', 'supprimer', 'ajouter');

        // MdlAdmin::connection('admin', 'admin');
        // MdlAdmin::deconnection();

        try{
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
}
?>