<?php

require_once(__DIR__.'/config/Config.php');

require_once(__DIR__.'/config/Autoload.php');
Autoload::charger();

$cont = new FrontController();
?>