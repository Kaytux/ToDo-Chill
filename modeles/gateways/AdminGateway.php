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

        $this->con->executeQueryWhitoutParameters($query);

        $query='CREATE TABLE TasksList(
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            INDEX idUser (Inscrit_id),
            name varchar(40),
            FOREIGN KEY (Inscrit_id)
                REFERENCES Isncrit(id)
        );';

        $this->con->executeQueryWhitoutParameters($query);

        $query='CREATE TABLE Task(
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            name varchar(40),
            status INT NOT NULL,
            INDEX idTasksList (TasksList_id),
            FOREIGN KEY (TasksList_id)
                REFERENCES TasksList(id)
        );';

        $this->con->executeQueryWhitoutParameters($query);
    }
}

?>