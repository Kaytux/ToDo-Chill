<head>
	<meta charset="utf8"/>
	<title>Inscription</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/login.css">
	  <base href="https://codefirst.iut.uca.fr/containers/todo-chill-vincentastolfi/">
</head>
<body class="test">
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
