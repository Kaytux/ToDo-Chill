<?php

class Task{
    private $id;
    private $name;
    private $status;
    private $idTaskList;

    public function __construct($id, $name, $status, $idTaskList){
        $this->id=$id;
        $this->name=$name;
        $this->status=$status;
        $this->idTaskList=$idTaskList;
    }

    public function getName(){
        return $this->name;
    }

    public function getIdTaskList(){
        return $this->idTaskList;
    }

    public function getId(){
        return $this->id;
    }

    public function getStatus(){
        return $this->status;
    }
}

?>