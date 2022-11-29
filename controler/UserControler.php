<?php

class UserControler{
    
    function __construct(){

        global $rep,$vues;

        try{
            if(isset($_REQUEST['action'])){
                $action=$_REQUEST['action'];
            }
            else{
                $action=NULL;
            }        
            switch($action){
                case NULL:
                    $this->Reinit();
                    break;        
                case "connect":
                    $this->connection();
                    break;
                case "SignIn":
                    require($rep.$vues['signIn']);
                    break;
                case "createNewAccount":
                    $this->createNewAccount();
                    break;
                case "disconnectFromUser":
                    MdlUser::deconnection();
                    require($rep.$vues['homePage']);
                    break;
                case "addAList":
                    $this->addAList();
                    break;
                default:
                    echo "erreur page inconnue";
                    break;
            }
        }catch(PDOException $e){
            echo "$e";
        }
        
    } // fin constructeur
    
    function Reinit(){
        global $rep, $vues;
        require($rep.$vues['homePage']);
    }
    
    function connection(){
        global $rep, $vues, $connectedUser;
        $email = $_POST['email'];
        $mdp = $_POST['password'];


        if(Validation::valideFormLogin($email, $mdp, $dVueError)){
            if(isset($dVueError['spec'])){
                MdlAdmin::connection($email, $mdp);
                require($rep.$vues['adminPage']);
                exit;
            }
            MdlUser::connection($email, $mdp);
            $connectedUser['user'] = new User($email);
            echo($connectedUser['user']);
            require($rep.$vues['userInterface']);
        }
        else{
            if(isset($dVueError['email']) || isset($dVueError['password'])){
                require($rep.$vues['homePage']);
            }
        }
    }

    function createNewAccount(){
        global $rep, $vues;
        $email = $_POST['email'];
        $mdp = $_POST['password'];

        if(Validation::valideFormRegister($email, $mdp, $dVueError)){
            require($rep.$vues['homePage']);
        }else{
            require($rep.$vues['signIn']);
        }
    }

    function addAList(){
        global $rep, $vues, $connectedUser;
        echo ($connectedUser['user']);
        $name = $_POST['name'];
        $list= new TaskList($name);
        $connectedUser->addAList($list);
        require($rep.$vues['userInterface']);
    }

       /*
       function createNewList(){
        global $dsn, $usr, $mdp, $connectedUser;

        $name = $_POST['listName'];
        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new TaskGateway($con);
        $gateway->createNewListBdd($connectedUser['email'], $name);
        return;
    }

    function createAllBddTable(){
        global $dsn, $usr, $mdp;

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new AdminGateway($con);
        $gateway->createTable();
        return;
    }
    */
    } // fin classe

?>