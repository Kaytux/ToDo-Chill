<?php
//prefixe
$rep=__DIR__.'/../';

//BD
$dsn = "mysql:host=localhost; dbname=deedebdToDoChill";
$usr = "viastolfi";
$mdp = "MhhLeCaca1!";

//$dsn='mysql:host=10.9.0.67;dbname='.getenv("MARIADB_DATABASE");
//$dbname=getenv("MARIADB_DATABASE");
//$usr=getenv("MARIADB_USER");
//$mdp=getenv("MARIADB_PASSWORD");

//Vues
$vues['homePage']='vues/homePage.php';
$vues['signIn']='vues/signIn.php';
$vues['mainPage']='vues/mainPage.php';
$vues['adminPage']='vues/adminPage.php';
$vues['userInterface']='vues/userInterface.php';
$vues['errorPage']='vues/errorPage.php';

$idUser = array();
?>