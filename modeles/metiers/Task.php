<?php

class Task{
    private string $name;
    private bool $isCompleted;

    public function __construct($name){
        $this->name=$name;
        $this->isComppleted=false;
    }

    public function getTaskName(){
        return $this->name;
    }
}

?>