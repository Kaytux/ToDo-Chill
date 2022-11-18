<head>
	<meta charset="utf8"/>
	<title>Accueil</title>
	<!--<base href="https://codefirst.iut.uca.fr/containers/todo-chill-vincentastolfi/">-->
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/homePage.css">
    <link rel="stylesheet" href="styles/form.css">
</head>
<body>
	<div class="btn-left-corner">
		<form method="post">
			<input class="btn" type="submit" value="Inscription"/>	
			<input type="hidden" name="action" value="signIn"/>
		</form>
		<form method="post">
			<input class="btn" type="submit" value="Connexion"/>	
			<input type="hidden" name="action" value="logIn"/>
		</form>
	</div>


	<?php
		global $dsn,$usr,$mdp;

        $con = new Connection($dsn, $usr, $mdp);
        $gateway = new TaskGateway($con);

		$taskList=$gateway->getAllTasksListFromMail("unknown");
		echo '<div class="test">';
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
		echo '</div>';
	?>
	<form method="post">
			<input class="btn" type="submit" value="Ajouter une liste"/>	
			<input type="hidden" name="action" value="displayAskingNameDiv"/>
	</form>
	<?php
		if(isset($vueSpecificities) && count($vueSpecificities)>0){
			echo'
			<div>
			<form method="post">
				<input type="texte" placeholder="Nom de la liste">
				<input type="submit" value="Valider"/>	
				<input type="hidden" name="action" value="CreateNewList"/>
			</form>
		</div>
		';
		}
	?>
		
</body>
