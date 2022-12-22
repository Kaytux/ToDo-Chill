<?php

class AdminGateway{
    private $con;

    public function __construct($con){
        $this->con=$con;
    }

    function createTable(){
        $query='CREATE TABLE Inscrit (
        mail varchar(40) NOT NULL,
        mdp varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
        isAdmin tinyint(1) DEFAULT 0
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

        INSERT INTO Inscrit (mail, mdp, isAdmin) VALUES
        ("admin", "$2y$10$kS0exZw6F2ZJkeBfXzti9OUh1QR.yePlOSxLo/9NRInX33q4z2ndi", 1),
        
        CREATE TABLE Task (
        id int NOT NULL,
        name varchar(40) DEFAULT NULL,
        status int NOT NULL DEFAULT 0,
        idTasksList int DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

        CREATE TABLE TasksList (
        id int NOT NULL,
        name varchar(40) DEFAULT NULL,
        mailUser varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

        ALTER TABLE Inscrit
        ADD PRIMARY KEY (mail);

        ALTER TABLE Task
        ADD PRIMARY KEY (id),
        ADD KEY idTasksList (idTasksList);

        ALTER TABLE TasksList
        ADD PRIMARY KEY (id),
        ADD KEY mailUser (mailUser);
        
        ALTER TABLE Task
        MODIFY id int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
        
        ALTER TABLE TasksList
        MODIFY id int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;
        
        ALTER TABLE Task
        ADD CONSTRAINT Task_ibfk_1 FOREIGN KEY (idTasksList) REFERENCES TasksList (id);
        
        ALTER TABLE TasksList
        ADD CONSTRAINT TasksList_ibfk_1 FOREIGN KEY (mailUser) REFERENCES Inscrit (mail) ON DELETE RESTRICT ON UPDATE RESTRICT;
        COMMIT;
        ';

        $this->con->executeQueryWithoutParameters($query);
    }

    function deleteAllDataBdd(){
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

    function deleteAllTableBdd(){
        $query='DROP TABLE Task; DROP TABLE TasksList; DROP TABLE Inscrit';
        $this->con->executeQueryWithoutParameters($query);
    }

    function getCredentials($email){
        $query='SELECT mdp, isAdmin FROM Inscrit WHERE mail=:login';
        if($this->con->executeQuery($query, array(':login'=>array($email, PDO::PARAM_STR)))){
            $results = $this->con->getResults();
            if(count($results) == 0){
                return false;
            }
            return $results[0];
        }else{
            throw newException();
        }
    }
}

?>