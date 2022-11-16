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
}

?>