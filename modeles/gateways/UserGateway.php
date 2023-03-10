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

    public function getData(?string $email){
        if($email == null){
            $query='SELECT * FROM TasksList WHERE mailUser IS NULL';
            $this->con->executeQueryWithoutParameters($query);
        }else{
            $query='SELECT * FROM TasksList WHERE mailUser=:id';
            $this->con->executeQuery($query, array(':id'=>array($email, PDO::PARAM_STR)));
        }
        return $this->con->getResults();
    }
    
    public function getCredentials($email){
        $query='SELECT mdp FROM Inscrit WHERE mail=:login';
        if($this->con->executeQuery($query, array(':login'=>array($email, PDO::PARAM_STR)))){
            $results = $this->con->getResults();
            if(count($results) == 0){
                return false;
            }
            return $results[0];
        }else{
            throw newException();
        }
    }
    
    public function getListFromTask($id){
        $query = 'SELECT idTasksList FROM Task WHERE id=:id';
        
        $this->con->executeQuery($query, array(
            ':id'=>array($id, PDO::PARAM_INT)
        ));
        return $this->con->getResults();
    }
}
?>