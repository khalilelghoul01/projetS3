<?php
	require_once("model/Recette.php");
	require_once("model/Utilisateur.php");
	require_once("config/Connexion.php");
	Connexion::connect();
	class handler{
		public static function Recettes(){ 
			$lesRecettes=Recette::getAllRecettes();
			include("view/recettes.php");
		}

		public static function Signup(){
						
			if(isset($_SESSION['username'])){
				header("Location: routeur.php?action=Recettes");
			}
			include("view/signup.php");
		}

		public static function Login(){
			
			if(isset($_SESSION['username'])){
				header("Location: routeur.php?action=Recettes");
			}
			include("view/login.php");
		}

		public static function Logout(){
			
			session_destroy();
			header("Location: routeur.php?action=Recettes");
		}

		public static function CreateAccount(){
			
			if(isset($_SESSION['username'])){
				header("Location: routeur.php?action=Recettes");
			}
			if(isset($_POST['envoyer'])){
				$email = $_POST['email'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$bio = $_POST['bio'];
				$destination = "";
				if(isset($_FILES['photo'])){
					$photo = $_FILES['photo'];
					$imagetype = $_FILES['pic']['type'];
					$mime_type = mime_content_type($_FILE['input_name']['tmp_name']);
					$allowed_file_types = 'image/*';
					$destination = 'images/user/';
					if($imagetype == $allowed_file_types){
						$destination .= $username.'.'.$imagetype;
						move_uploaded_file($photo['tmp_name'], $destination);
						header('Location:  routeur.php?action=Signup&error=type de fichier non autorisé');
						
					}else{
						header('Location:  routeur.php?action=Signup&error=type de fichier non autorisé');
					}
				}
				else{
					$photo = "";
				}
				
				if(Utilisateur::addUtilisateur($username,$bio,$password,$email,$destination)){
					$_SESSION['username'] = $username;
					$_SESSION['image'] = Utilisateur::getImageFromUser($username);
					header("Location: routeur.php?action=Recettes");
				}else{
					header('Location:  routeur.php?action=Signup');
				}	
			}
		}
	public static function LoginAccount(){
		
		if(isset($_SESSION['username'])){
			header("Location: routeur.php?action=Recettes");
		}
		if(isset($_POST['envoyer'])){
			$pseudo = $_POST['username'];
			$mdp = $_POST['password'];
			if(Utilisateur::checkUser($pseudo,$mdp)){
				$_SESSION['username'] = Utilisateur::getUser($pseudo);
				$_SESSION['image'] = Utilisateur::getImageFromUser($pseudo);
				header("Location: routeur.php?action=Recettes");
			}else{
				header('Location:  routeur.php?action=Login&error=Mauvais identifiants');
			}
		}
	}
	public static function ViewRecette($id){
		$recette=Recette::getRecette($id);
		include("view/recette.php");
	}
}
?>