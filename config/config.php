<?php
//prefixe
$rep=__DIR__.'/../';

//BD
$dsn = "mysql:host=localhost; dbname=bdToDoChill";
$usr = "viastolfi";
$mdp = "MhhLeCaca1!";

//Vues
$vues['homePage']='vues/homePage.php';
$vues['signIn']='vues/signIn.php';
$vues['logIn']='vues/logIn.php';
$vues['mainPage']='vues/mainPage.php';

$connectedUser = array();
$connectedUser['email'] = "unknown";
?>
