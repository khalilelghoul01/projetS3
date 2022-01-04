<?php
	require_once("model/Recette.php");
	require_once("model/Utilisateur.php");
	require_once("config/Connexion.php");
	Connexion::connect();
	class handler{
		public static function Accueil(){ 
			$lesRecettes=Recette::getAllRecettes();
			include("view/recettes.php");
		}

		public static function Signup(){
						
			if(isset($_SESSION['username'])){
				header("Location: routeur.php?action=Recettes&warning=vous êtes déjà connecté");
			}
			include("view/signup.php");
		}

		public static function Login(){
			
			if(isset($_SESSION['username'])){
				header("Location: routeur.php?action=Recettes&warning=vous êtes déjà connecté");
			}
			include("view/login.php");
		}

		public static function Logout(){
			
			session_destroy();
			header("Location: routeur.php?action=Recettessuccess=vous êtes déconnecté");
		}

		public static function CreateAccount(){
			
			if(isset($_SESSION['username'])){
				header("Location: routeur.php?action=Recettes&warning=vous êtes déjà connecté");
			}
			if(isset($_POST['envoyer'])){
				$email = $_POST['email'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$bio = $_POST['bio'];
				$target_dir = "images/users/".$username."/";
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$target_file = $target_dir . basename($_FILES["photo"]["name"]);
				$check = getimagesize($_FILES["photo"]["tmp_name"]);
				$valid = $username!='' && $password!='' && $email!='' && $bio!='' && $username != $email && strlen($password)>=8 && strlen($username)>=4;
				if($valid){
					if($check !== false) {
						mkdir($target_dir, 0777);
						$photo = $target_file;
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
						&& $imageFileType != "gif" ){
							header("Location: routeur.php?action=Signup&error=Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés");
						}
						if($_FILES["photo"]["size"] > 50000){
							header("Location: routeur.php?action=Signup&error=Désolé, votre fichier est trop volumineux");
						}
						if(file_exists($target_file)){
							header("Location: routeur.php?action=Signup&error=Désolé, le fichier existe déjà");
						}
						move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
					} else {
						$photo = "default";
						header("Location: routeur.php?action=Signup&error=Désolé, votre fichier n'a pas été téléchargé");
					}
				
					if(Utilisateur::addUtilisateur($username,$bio,$password,$email,$photo)){
						$_SESSION['username'] = $username;
						$_SESSION['email'] = $email;
						$_SESSION['image'] = Utilisateur::getImageFromUser($username);
						header("Location: routeur.php?action=Recettes");
					}else{
						header('Location:  routeur.php?action=Signup&error=le compte existe déjà');
					}	
				}
				else{
					$error = "
		if(isset($_SESSION['username'])){
			header("Location: routeur.php?action=Recettes&warning=vous êtes déjà connecté");
		}
		if(isset($_POST['envoyer'])){
			$email = $_POST['username'];
			$password = $_POST['password'];
			if(Utilisateur::checkUser($email,$password)){
				$_SESSION['email'] = Utilisateur::getUser($email)['Email'];
				$username = Utilisateur::getUser($email)['Username'];
				$_SESSION['username'] = $username;
				$_SESSION['image'] = Utilisateur::getImageFromUser($username);
				header("Location: routeur.php?action=Recettes&success=Vous êtes connecté");
			}else{
				header('Location:  routeur.php?action=Login&error=Mauvais identifiants');
			}il faut que le mot de passe soit supérieur à 8 caractères, que le nom d'utilisateur soit supérieur à 4 caractères, que le nom d'utilisateur et l'email soient différents"; 
					header("Location:  routeur.php?action=Signup&error=$error");
				}
			}
		}
	public static function LoginAccount(){
		
		}
	}
	public static function ViewRecette($id){
		$recette=Recette::getRecette($id);
		include("view/recette.php");
	}

	public static function Profile(){
		if(isset($_SESSION['username'])){
			if(isset($_SESSION['image']) ){
				$image = $_SESSION['image'];
				if($image == null){
				  $image = "images/users/default.png";
				}
			}
			$username = $_SESSION['username'];
			$email = $_SESSION['email'];
			$user = Utilisateur::getUser($email);
			$bio = $user['Bio'];
			//$recettes = Recette::getRecettesFromUser($username);
			include("view/profile.php");
		}else{
			header("Location: routeur.php?action=Recettes&warning=vous devez être connecté");
		}
	
	}
}
?>