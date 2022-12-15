<?php

class User{
    private string $email;

    function __construct($email){
        $this->email=$email;
    }

    public function getEmail():string{
        return $this->email;
    }

    public function __toString(){
        return $this->email;
    }
}

?>