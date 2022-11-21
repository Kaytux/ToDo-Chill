<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf8"/>
	<title>Inscription</title>
	<base href="https://codefirst.iut.uca.fr/containers/todo-chill-vincentastolfi/">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/form.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
	<form class="form-login" method="post">
		<input class="form-entry" type="email" placeholder="Entrer votre email" name="email">
		<input class="form-entry" type="password" placeholder="Entrer votre mot de passe" name="password">
		<div>
			<input class="btn form-validation-btn" type="submit" value="Valider"/>	
			<input type="hidden" name="action" value="createUser"/>
		</div>
	</form>

	<?php
		if(isset($dVueError) && count($dVueError) > 0){
			foreach ($dVueError as $value){
				echo "Error : $value <br>";
			}
		}
	?>
</body>
</html>