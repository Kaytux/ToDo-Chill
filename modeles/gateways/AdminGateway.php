<?php

class AdminGateway{
    private $con;

    public function __construct($con){
        $this->con=$con;
    }

    public function createTable(){
        $query='CREATE TABLE Inscrit(
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            mail varchar(40),
            mdp varchar(40)
        );';

        $this->con->executeQueryWithoutParameters($query);

        $query='CREATE TABLE TasksList(
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            idUser INT,
            name varchar(40),
            FOREIGN KEY (idUser) REFERENCES Inscrit(id)
        );';

        $this->con->executeQueryWithoutParameters($query);

        $query='CREATE TABLE Task(
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            name varchar(40),
            status INT NOT NULL,
            idTasksList INT,
            FOREIGN KEY (idTasksList) REFERENCES TasksList(id)
        );';

        $this->con->executeQueryWithoutParameters($query);
    }
}

?>