<?php

require_once(__DIR__.'/config/Config.php');

require_once(__DIR__.'/config/Autoload.php');
Autoload::charger();

// loading a controler
$cont = new FrontControler();
?>