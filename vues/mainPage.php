<head>
	<meta charset="utf8"/>
	<title>MainPage</title>
	<!--<base href="https://codefirst.iut.uca.fr/containers/todo-chill-vincentastolfi/">-->
    <link rel="stylesheet" href="styles/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <?php
        global $connectedUser;
        $test = "Bienvenue ".$connectedUser['email'];
        echo "<h1>$test</h1>";    
    ?>
    <div>
        <h3>Liste de vos tâches</h3>
        <?php
            global $dsn,$usr,$mdp,$connectedUser;

            $con = new Connection($dsn, $usr, $mdp);
            $gateway = new TaskGateway($con);
            $taskList = $gateway->getAllTaskFromMail($connectedUser['email']);
            foreach($taskList as $row){
                $string = "Tâche numéro : ".$row['id']." Nom : ".$row['name'].", Content : ".$row['content'];
                if($row['status']===0){
                    echo "<p>$string</p>";
                }
                if($row['status']===1){
                    echo "<strike>$string</strike>";
                }
            }
        ?>
    </div>
<body>