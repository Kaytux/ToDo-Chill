<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf8"/>
	<title>MainPage</title>
	<!--<base href="https://codefirst.iut.uca.fr/containers/todo-chill-vincentastolfi/">-->
    <link rel="stylesheet" href="styles/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <div class="btn-left-corner">
		<form method="post">
			<input class="btn" type="submit" value="Se déconnecter"/>	
			<input type="hidden" name="action" value="signOut"/>
		</form>
	</div>

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

		$taskList=$gateway->getAllTasksListFromMail($connectedUser['email']);
		foreach($taskList as $row){
			$display="Liste : ".$row['name'];
			echo "<p>$display</p>";

			$tasks = $gateway->getAllTaskFromTasksList($row['id']);
			foreach($tasks as $row){
				$string = "Tâche numéro : ".$row['id']." Nom : ".$row['name'].", Content : ".$row['content'];
				if($row['status']===0){
					echo "<p>&emsp;$string</p>";
				}
				if($row['status']===1){
					echo "<strike>&emsp;$string</strike>";
				}
			}
		}
	?>
    </div>
<body>
</html>