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
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>	
	<form method="post" class="btn-right-corner">
		<input class="btn" type="submit" value="Se deconnecter"/>	
		<input type="hidden" name="action" value="disconnectFromUser"/>
	</form>

	<?php
		if(isset($dVueError) && count($dVueError)>0){
			foreach($dVueError as $row){?>
			<h1><?=$row?></h!>
	<?php
			}
		}
	?>

	<div class="page-container">
		<div class="list-container">
			<div class="list-name-container">
				<?php
					if(isset($_SESSION['list']) && count($_SESSION['list']) > 0){
						foreach($_SESSION['list'] as $row){
							$id = $row->getId();
				?>
					<div class="list-focus">
					<form method='post' class='list-form-container'>
						<input class='list-text-container' type='submit' value=<?=$row?> name='listTargeted'>
						<input type='hidden' name='id' value=<?=$id?>>
						<input type='hidden' name='action' value='targetAList'>
					</form>
					<form class="list-delete-container" method="post">
						<input class="delete material-symbols-outlined" type="submit" value="delete">
						<input type="hidden" name="action" value="deleteList">
						<input type="hidden" name="id" value=<?=$id?>> 
					</form>
					</div>
				<?php
						}
					}
				?>
			</div>
			<div class="list-adding-form-container">
				<form method="post" class="list-add-container">
					<input class="form-entry" type="text" placeholder="Nom de la liste" name="name">
					<input class="btn-add" type="submit" value="+"/>	
					<input type="hidden" name="action" value="addAList"/>
				</form>
			</div>
		</div>
		<div class="task-container">
			<?php
				if(isset($_SESSION['task']) && count($_SESSION['task']) > 0){
					foreach($_SESSION['task'] as $row){
						$name = $row->getName();
						$id = $row->getId();
			?>
			<div class="task-name-container">
				<form class="task-form-container" method="post">
					<?php
						if($row->getStatus()==0){
					?>
					<input type="checkbox" onChange="submit()">
					<input type="hidden" name="action" value="checkTask">
					<input type="hidden" name="id" value=<?=$id?>> 
					<h2><?=$name?></h2>
				</form>
				<form class="task-delete-container" method="post">
					<input class="delete material-symbols-outlined" type="submit" value="delete">
					<input type="hidden" name="action" value="deleteTask">
					<input type="hidden" name="id" value=<?=$id?>> 
				</form>
				<?php
					}
				?>
				<?php
					if($row->getStatus()==1){
				?>
				<form class="task-name-container" method="post">
					<input type="checkbox" onChange="submit()" checked>
					<input type="hidden" name="action" value="uncheckTask">
					<input type="hidden" name="id" value=<?=$id?>> 
					<h2 style="text-decoration:line-through;"><?=$name?></h2>
				</form>
				<form class="task-delete-container" method="post">
					<input class="delete material-symbols-outlined" type="submit" value="delete">
					<input type="hidden" name="action" value="deleteTask">
					<input type="hidden" name="id" value=<?=$id?>> 
				</form>
				<?php
					}
				?>
			</div>
			<?php
				}
			}
			?>
			<div class="task-adding-form-container">
				<form method="post" class="task-add-container">
					<input class="form-entry" type="text" placeholder="Nom de la tâche" name="name">
					<input class="btn-add" type="submit" value="+"/>	
					<input type="hidden" name="action" value="addATask"/>
				</form>
			</div>
		</div>
	</div>
	</body>
</html>