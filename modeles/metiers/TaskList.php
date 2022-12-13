<?php

class TaskList{
    private string $id;
    private string $name;
    private string $userMail;

    public function __construct($id ,$name, $userMail){
        $this->id=$id;
        $this->name=$name;
        $this->userMail=$userMail;
    }

    public function getName(){
        return $this->name;
    }

    public function getUserMail(){
        return $this->userMail;
    }

    public function getId(){
        return $this->id;
    }

    public function __toString(){
        return $this->name;
    }
}

?>