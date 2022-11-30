<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf8"/>
	<title>Accueil</title>
	<!--<base href="https://codefirst.iut.uca.fr/containers/todo-chill-vincentastolfi/">-->
    <link rel="stylesheet" href="styles/homePage.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/form.css">
	<link rel="stylesheet" href="styles/userInterface.css">
</head>
<body>	
	<form method="post" class="btn-right-corner">
		<input class="btn" type="submit" value="Se deconnecter"/>	
		<input type="hidden" name="action" value="disconnectFromUser"/>
	</form>

	<div class="list-container">
		<div class="list-name-container">
			<?php
				if(isset($dVue) && count($dVue) > 0){
					foreach($dVue['list'] as $row){
						$disp = $row['name'];
						echo "<form class='list-form-container'>
								<input class='list-text-container'type='submit' value=$disp>
								<input type='hidden' name='action' value='test'>
							</form>";
					}
				}
			?>
		</div>
		<form method="post" class="list-add-container">
			<input class="form-entry" type="text" placeholder="Nom de la liste" name="name">
			<input class="btn-add" type="submit" value="+"/>	
			<input type="hidden" name="action" value="addAList"/>
		</form>
	</div>
	<?php
		if(isset($dVue) && count($dVue) > 0){
			foreach($dVue['task'] as $row){
				echo $row['name'];
			}
		}
	?>
</body>
</html>