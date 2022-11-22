<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf8"/>
	<title>Admin Page</title>
	<base href="https://codefirst.iut.uca.fr/containers/todo-chill-vincentastolfi/">
    <link rel="stylesheet" href="styles/homePage.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/form.css">
</head>
<body>
    <h1>Bienvenue Mr. l'Admin</h1>
    <form method="post">
		<input class="btn" type="submit" value="Recréer les tables"/>	
		<input type="hidden" name="action" value="createTableBdd"/>
	</form>

	<form class="form-login" method="post">
		<input class="form-entry" type="text" placeholder="Entrer votre email" name="email">
		<input class="form-entry" type="password" placeholder="Entrer votre mot de passe" name="password">
        <input class="form-entry" type="checkbox" name="isAdmin"/>
		<div>
			<input class="btn form-validation-btn" type="submit" value="Créer un nouveau user"/>	
			<input type="hidden" name="action" value="createUser"/>
		</div>
	</form>
    
    <form method="post">
		<input class="btn" type="submit" value="Quitter le mode admin"/>	
		<input type="hidden" name="action" value="disconnectFromAdmin"/>
	</form>
    

    <form method="post">
		<input class="btn" type="submit" value="VIDER LA BDD"/>	
		<input type="hidden" name="action" value="deleteAllDataBdd"/>
	</form>

    <form method="post">
		<input class="btn" type="submit" value="DETRUIRE TOUTE LES TABLES"/>	
		<input type="hidden" name="action" value="deleteAllTableBdd"/>
	</form>
</body>
</html>