<?php

class AdminGateway{
    private $con;

    public function __construct($con){
        $this->con=$con;
    }

    function createTable(){
        $query='CREATE TABLE IF NOT EXISTS Inscrit(
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            mail varchar(40),
            mdp varchar(40),
            isAdmin boolean default false
        );';

        $this->con->executeQueryWithoutParameters($query);

        $query='CREATE TABLE IF NOT EXISTS TasksList(
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            idUser INT,
            name varchar(40),
            FOREIGN KEY (idUser) REFERENCES Inscrit(id)
        );';

        $this->con->executeQueryWithoutParameters($query);

        $query='CREATE TABLE IF NOT EXISTS Task(
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            name varchar(40),
            status INT NOT NULL,
            idTasksList INT,
            FOREIGN KEY (idTasksList) REFERENCES TasksList(id)
        );';

        $this->con->executeQueryWithoutParameters($query);
    }

    function deleteAllBdd(){
        $query='DELETE FROM Task';
        $this->con->executeQueryWithoutParameters($query);

        $query='DELETE FROM TasksList';
        $this->con->executeQueryWithoutParameters($query);

        $query='DELETE FROM Inscrit';
        $this->con->executeQueryWithoutParameters($query);
    }

    function createNewAdmin($user){
        $query='INSERT INTO Inscrit (mail, mdp, isAdmin) VALUES (:mail, :password, true)';
        $this->con->executeQuery($query, array(
            ':mail'=>array($user->getEmail(), PDO::PARAM_STR),
            ':password'=>array($user->getPassword(), PDO::PARAM_STR)
        ));
    }
}

?>