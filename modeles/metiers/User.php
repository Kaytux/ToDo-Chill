<?php

class User{
    private string $email;
    private array $taskList;

    function __construct($email){
        $this->email=$email;
        $taskList = array();
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

    public function isListSet(){
        if(isset($taskList) && count($taskList)>0){return true;}
        return false;
    }

    public function __toString(){
        return $this->email;
    }
}

?>