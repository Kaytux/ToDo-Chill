<?php

class Task{
    private string $id;
    private string $name;
    private bool $isCompleted;
    private string $idTaskList;

    public function __construct($id, $name, $isCompleted, $idTaskList){
        $this->id=$id;
        $this->name=$name;
        $this->isCompleted=$isCompleted;
        $this->idTaskList=$idTaskList;
    }

    public function getName(){
        return $this->name;
    }

    public function getIdTaskList(){
        return $this->idTaskList;
    }
}

?>