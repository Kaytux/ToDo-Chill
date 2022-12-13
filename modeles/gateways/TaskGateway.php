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
}
?>