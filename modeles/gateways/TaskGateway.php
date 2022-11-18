<?php

class TaskGateway{
    private $con;

    public function __construct($con){
        $this->con=$con;
    }

    public function getAllTaskFromMail($userMail): array{
        $query='SELECT t.id, t.name, t.content, t.status FROM Task t, Inscrit i WHERE i.mail=:mail AND t.idUser=i.id';

        $this->con->executeQuery($query, array(':mail'=>array($userMail,PDO::PARAM_STR)));
        return $this->con->getResults();
    }
}
?>