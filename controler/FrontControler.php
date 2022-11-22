<?php

class FrontControler{
    
    function __construct(){
        global $rep, $vues;

        $listeAction_Admin = array('deconnecter', 'supprimer', 'ajouter');
        // MdlAdmin::connection('admin', 'admin');

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