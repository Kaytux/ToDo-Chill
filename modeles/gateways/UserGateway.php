<?php

class UserGateway{
    private $con;

    public function __construct(Connection $con){
        $this->con=$con;
    }

    public function addUserBdd($email, $mdp){
        $query='INSERT INTO Inscrit (mail, mdp) VALUES (:mail, :password)';
        $this->con->executeQuery($query, array(
            ':mail'=>array($email, PDO::PARAM_STR),
            ':password'=>array($mdp, PDO::PARAM_STR) // TODO
        ));
        return true;
    }

    public function searchUserIdentidiant(User $user){
        $query='SELECT * FROM Inscrit where mail=:mail AND mdp=:mdp';

        //TODO
        $this->con->executeQuery($query, array(':mail'=>array($user->getEmail(), PDO::PARAM_STR), ':mdp'=>array($user->getEmail(), PDO::PARAM_STR)));
        $results=$this->con->getResults();

        foreach($results as $row){
            if($row['isAdmin']===1){
                return "test";
            }
            return "true";
        }
        return "false";
    }

    public function getData($email){
        $query='SELECT * FROM TasksList WHERE mailUser=:id';
        $this->con->executeQuery($query, array(':id'=>array($email, PDO::PARAM_STR)));
        return $this->con->getResults();
    }
}
?>