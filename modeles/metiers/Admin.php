<?php

class Admin{
    private string $login;
    private string $role;

    function __construct($login, $role){
        $this->login = $login;
        $this->role = $role;
    }
}

?>