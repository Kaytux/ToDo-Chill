<?php

class TaskGateway{
    private $con;

    public function __construct($con){
        $this->con=$con;
    }
    
    public function createNewListBdd($userMail, $newListName){
        $query='INSERT INTO TasksList (name, mailUser) VALUES (:name, :mail)';
        $this->con->executeQuery($query, array(':mail'=>array($userMail, PDO::PARAM_STR), 
                                                ':name'=>array($newListName, PDO::PARAM_STR)));
        return;
    }

    public function getTaskFromList($id){
        $query='SELECT * FROM Task WHERE idTasksList=:id';
        $this->con->executeQuery($query, array(':id'=>array($id, PDO::PARAM_INT)));
        return $this->con->getResults();
    }

    public function getIdFromListName($name){
        $query='SELECT id FROM TasksList WHERE name=:name';
        $this->con->executeQuery($query, array(':name'=>array($name, PDO::PARAM_STR)));
        return $this->con->getResults();
    }
}
?>