<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf8"/>
	<title>Sign in</title>
	<!--<base href="https://codefirst.iut.uca.fr/containers/todo-chill-vincentastolfi/">-->
    <link rel="stylesheet" href="styles/homePage.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/form.css">
</head>

<body>	
    <form method="post" class="btn-right-corner">
		<input class="btn" type="submit" value="Continue as anonymous"/>	
		<input type="hidden" name="action" value="continueAsAnonymous"/>
	</form>
    
    <div class="form">
		<h1 class="title">To-Do Chill</h1>
        <div class="displayForm">
            <h2 class="title">Créez votre compte</h2>
            <form class="form" method="post">
                <input class="form-entry" type="text" placeholder="Entrez votre pseudo" name="email">
            <input class="form-entry" type="password" placeholder="Entrez votre mot de passe" name="password">
            <div>
                <input class="btn form-validation-btn" type="submit" value="Valider"/>	
                <input type="hidden" name="action" value="createNewAccount"/>
            </div>
            </form>
        </div>
    </div>

	<?php
		if(isset($dVueError) && count($dVueError) > 0){
			foreach ($dVueError as $value){
				echo "<p class='error-container'>Error : $value</p> <br>";
			}
		}
	?>

</body>

</html>