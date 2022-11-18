<?php

class TaskGateway{
    private $con;

    public function __construct($con){
        $this->con=$con;
    }

    public function getAllTasksListFromMail($userMail): array{
        $query='SELECT tl.id, tl.name FROM TasksList tl, Inscrit i WHERE i.mail=:mail AND tl.idUser=i.id';

        $this->con->executeQuery($query, array(':mail'=>array($userMail, PDO::PARAM_STR)));
        return $this->con->getResults();
    }

    public function getAllTaskFromTasksList($idTasksList): array{
        $query='SELECT t.id, t.name, t.content, t.status FROM Task t, TasksList tl WHERE tl.id=:idTasksList AND t.idTasksList=tl.id';

        $this->con->executeQuery($query, array(':idTasksList'=>array($idTasksList,PDO::PARAM_INT)));
        return $this->con->getResults();
    }
}
?>