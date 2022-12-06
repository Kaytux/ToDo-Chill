<?php

class UserControler{
    
    function __construct(){

        global $rep,$vues,$idUser;

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
                case "targetAList":
                    $this->changeTargetedList();
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
        global $rep, $vues, $idUser;
        $email = $_POST['email'];
        $mdp = $_POST['password'];

        if(isset($_GET['page'])){
            $dVue['page'] = $_GET['page'];
        }else{
            $dVue['page'] = 1;
        }

        if(Validation::valideFormLogin($email, $mdp, $dVueError)){
            if(isset($dVueError['spec'])){
                MdlAdmin::connection($email, $mdp);
                require($rep.$vues['adminPage']);
                exit;
            }
            MdlUser::connection($email);
            $dVue['list'] = MdlUser::getData($email);
            $_SESSION['list'] = $dVue['list'][0]['name'];
            $this->loadData();
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
        global $rep, $vues, $idUser;
        $name = $_POST['name'];
        $task = new TaskList($name);
        MdlUser::addAListToUser($_SESSION['login'],$task);
        $this->loadData();
    }

    function loadData(){
        global $rep, $vues;
        $dVue['list'] = MdlUser::getData($_SESSION['login']);
        $dVue['task'] = MdlUser::getDataTask($_SESSION['list']);
        require($rep.$vues['userInterface']);
    }

    function changeTargetedList(){
        $_SESSION['list'] = $_POST['listTargeted'];
        $this->loadData();
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