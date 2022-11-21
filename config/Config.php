<?php
//prefixe
$rep=__DIR__.'/../';

//BD
//$dsn = "mysql:host=localhost; dbname=bdToDoChill";
//$usr = "viastolfi";
//$mdp = "MhhLeCaca1!";

$dsn='mysql:host=10.9.0.67;dbname='.getenv("MARIADB_DATABASE");
$dbname=getenv("MARIADB_DATABASE");
$username=getenv("MARIADB_USER");
$passwordBD=getenv("MARIADB_PASSWORD");


//Vues
$vues['homePage']='vues/homePage.php';
$vues['signIn']='vues/signIn.php';
$vues['logIn']='vues/logIn.php';
$vues['mainPage']='vues/mainPage.php';

$connectedUser = array();
$connectedUser['email'] = "unknown";
?>
