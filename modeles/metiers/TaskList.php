<?php

class TaskList{
    private string $name;
    private array $tasks;

    public function __construct($name){
        $this->name=$name;
    }

    public function addATask($task){
        array_push($this->tasks, $task);
    }
}

?>