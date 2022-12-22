<?php

class Autoload{
    private static $_instance = null;
    
    public static function charger(){
        if(null!==self::$_instance){
            throw new RuntimeException(sprintf("%s is already started",__CLASS__));
        }
        
        self::$_instance=new self();
        if(!spl_autoload_register(array(self::$_instance,'_autoload'),true)){
            throw new RuntimeException(sprintf("%s : Could not start the autoload",__CLASS__));
        }
    }
    
    private static function _autoload($class){
        global $rep;
        $filename = $class.'.php';
        $dir=array("modeles/","./","config/","controller/","modeles/gateways/","modeles/metiers/");
        
        foreach($dir as $d){
            $file=$rep.$d.$filename;
            // echo "<p>$file</p>";
            if(file_exists($file)){
                include $file;
            }
        }
    }
}

?>