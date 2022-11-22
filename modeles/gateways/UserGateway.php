<?php

class UserGateway{
    private $con;

    public function __construct(Connection $con){
        $this->con=$con;
    }

    public function addUserBdd(User $user){
        $query='INSERT INTO Inscrit (mail, mdp) VALUES (:mail, :password)';
        $this->con->executeQuery($query, array(
            ':mail'=>array($user->getEmail(), PDO::PARAM_STR),
            ':password'=>array($user->getPassword(), PDO::PARAM_STR)
        ));
    }

    public function searchUserIdentidiant(User $user){
        global $connectedUser;
        $query='SELECT * FROM Inscrit where mail=:mail';
        if(!$this->con->executeQuery($query, array(':mail'=>array($user->getEmail(), PDO::PARAM_STR)))){
            return false;
        }
        $results=$this->con->getResults();

        foreach($results as $row){
            $connectedUser['email']=$row['mail'];
            if($row['isAdmin']===true){
                MdlAdmin::connection('admin','admin');
                return true;
            }
        }
        return true;
    }
}
?>