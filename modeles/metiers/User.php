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
        print_r($this->taskList);
        echo "<br>";
    }

    public function getTaskList(){
        print_r($this->taskList);
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