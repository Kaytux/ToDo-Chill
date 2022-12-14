<?php

class TaskGateway{
    private $con;

    public function __construct($con){
        $this->con=$con;
    }
    
    public function createNewListBdd($list){
        $query='INSERT INTO TasksList (name, mailUser) VALUES (:name, :mail)';
        $this->con->executeQuery($query, array(':mail'=>array($list->getUserMail(), PDO::PARAM_STR), 
                                                ':name'=>array($list->getName(), PDO::PARAM_STR)));
        return;
    }

    public function getTaskFromList($id){
        $query='SELECT * FROM Task WHERE idTasksList=:id';
        $this->con->executeQuery($query, array(':id'=>array($id, PDO::PARAM_INT)));
        return $this->con->getResults();
    }

    public function addTaskBdd($task){
        $query='INSERT INTO Task (name, idTasksList) VALUES (:name, :idTasksList)';

        $this->con->executeQuery($query, array(
            ':name'=>array($task->getName(), PDO::PARAM_STR),
            ':idTasksList'=>array($task->getIdTaskList(), PDO::PARAM_STR)
        ));
        return;
    }

    public function checkTaskBdd($id){
        $query='UPDATE Task SET status=1 WHERE id=:id';

        $this->con->executeQuery($query, array(':id'=>array($id, PDO::PARAM_STR)));
        return;
    }
}
?>