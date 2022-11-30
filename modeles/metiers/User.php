<?php

class User{
    private string $email;
    private $taskList=array();

    function __construct($email){
        $this->email=$email;
    }

    public function getEmail():string{
        return $this->email;
    }

    public function addAList($list){
        array_push($this->taskList, $list);    
    }

    public function getTaskList(){
        return $this->taskList;
    }

    public function __toString(){
        return $this->email;
    }
}

?>