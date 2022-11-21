<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf8"/>
	<title>Accueil</title>
	<base href="https://codefirst.iut.uca.fr/containers/todo-chill-vincentastolfi/">
    <link rel="stylesheet" href="styles/homePage.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/form.css">
</head>
<body>	

	<form method="post">
		<input class="btn" type="submit" value="Test"/>	
		<input type="hidden" name="action" value="createAllBddTable"/>
	</form>

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


	<div class="list">
		<h1 class="title">To-Do Chill</h1>
		<div class="displayList">
			<h2 class="title">Liste de tâche publique</h2>
			<form method="post">
				<input class="btn" type="submit" value="Ajouter une liste"/>	
				<input type="hidden" name="action" value="displayAskingNameDiv"/>
			</form>
			<?php
				if(isset($vueSpecificities) && count($vueSpecificities)>0){
					echo'
					<div class="list">
					<form method="post">
						<input type="text" placeholder="Nom de la liste" name="listName">
						<input type="submit" value="Valider"/>	
						<input type="hidden" name="action" value="createNewList"/>
					</form>
					</div>';
				}
			?>
			<?php
				global $dsn,$usr,$mdp;

				$con = new Connection($dsn, $usr, $mdp);
				$gateway = new TaskGateway($con);

				$taskList=$gateway->getAllTasksListFromMail("unknown");
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
	</div>	
</body>
</html>