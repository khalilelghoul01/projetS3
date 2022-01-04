<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Accueil (avant connection)</title>
	</head>
	<body>
		<?php 
		
			include 'view/navbar.php';
			if(!isset($_SESSION['username'])){
				echo "<a href='routeur.php?action=Login'> Se connecter</a>";
			}else{
				echo "hello ".$_SESSION['username'];
				echo "<a href='routeur.php?action=Logout'> Se déconnecter</a>";
			}
		?>
		
		<h3>Liste des recettes de la base de données</h3>
		<?php
			//echo "<ul>";
			foreach ($lesRecettes as $recette){
				$NomRecette = $recette->getTitre();
				echo "
				<a href='routeur.php?action=ViewRecette&id=".$recette->getId()."' class='text-reset'>
					<div class='card' style='width: 18rem;'>
						<img src='".$recette->getThumbnail()."' class='card-img-top' alt='$NomRecette'>
						<div class='card-body'>
							<p class='card-text'><strong>$NomRecette</strong></p>
						</div>
					</div>
					</a>";
					echo "<br>";
			}
			//echo "</ul>";
		?>
	</body>
	<img src= >
</html>