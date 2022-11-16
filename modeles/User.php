<?php

class User{
    private int $id;
    private string $email;
    private string $password;

    function __construct($email, $password){
        $this->email=$email;
        $this->password=$password;
    }

    public function getId():int{
        return $this->id;
    }

    public function getEmail():string{
        return $this->email;
    }

    public function getPassword():string{
        return $this->password;
    }
}

?>