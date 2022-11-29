<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf8"/>
	<title>Accueil</title>
	<!--<base href="https://codefirst.iut.uca.fr/containers/todo-chill-vincentastolfi/">-->
    <link rel="stylesheet" href="styles/homePage.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/form.css">
</head>
<body>	
	<form method="post" class="btn-right-corner">
		<input class="btn" type="submit" value="Se deconnecter"/>	
		<input type="hidden" name="action" value="disconnectFromUser"/>
	</form>
	<form method="post">
		<input class="form-entry" type="text" placeholder="Nom de la liste" name="name">
		<input class="btn" type="submit" value="Ajouter une liste"/>	
		<input type="hidden" name="action" value="addAList"/>
	</form>

	<?php
	global $connectedUser;
	if($connectedUser['user']->isListSet()){
		$lists=$connectedUser->getTaskList();
		foreach($lists as $row){
			echo $row['name'];
		}
	}

	?>
</body>
</html>