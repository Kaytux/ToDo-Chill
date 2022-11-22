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
        $query='SELECT * FROM Inscrit where mail=:mail AND mdp=:mdp';

        $this->con->executeQuery($query, array(':mail'=>array($user->getEmail(), PDO::PARAM_STR), ':mdp'=>array($user->getPassword(), PDO::PARAM_STR)));
        $results=$this->con->getResults();

        foreach($results as $row){
            if($row['isAdmin']===1){
                return "test";
            }
            return "true";
        }
        return "false";
    }
}
?>