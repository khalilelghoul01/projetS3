<?php
	require_once("model/Recette.php");
	require_once("model/Utilisateur.php");
	require_once("model/Commentaire.php");
	require_once("model/Utils.php");
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
				$target_file = $target_dir . basename($_FILES["photo"]["name"]);
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
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
						$user = Utilisateur::getUser($email);
						$_SESSION['id'] = $user['UserID'];
						$_SESSION['image'] = Utilisateur::getImageFromUser($username);
						header("Location: routeur.php?action=Recettes");
					}else{
						header('Location:  routeur.php?action=Signup&error=le compte existe déjà');
					}	
				}
				else{
					$error = "il faut que le mot de passe soit supérieur à 8 caractères, que le nom d'utilisateur soit supérieur à 4 caractères, que le nom d'utilisateur et l'email soient différents"; 
					header("Location:  routeur.php?action=Signup&error=$error");
				}
			}
		}
	public static function LoginAccount(){
		
		if(isset($_SESSION['username'])){
			header("Location: routeur.php?action=Recettes&warning=vous êtes déjà connecté");
		}
		if(isset($_POST['envoyer'])){
			$email = $_POST['username'];
			$password = $_POST['password'];
			if(Utilisateur::checkUser($email,$password)){
				$user = Utilisateur::getUser($email);
				$_SESSION['email'] = $user['Email'];
				$_SESSION['id'] = $user['UserID'];
				$username = $user['Username'];
				$_SESSION['username'] = $username;
				$_SESSION['image'] = Utilisateur::getImageFromUser($username);
				header("Location: routeur.php?action=Recettes&success=Vous êtes connecté");
			}else{
				header('Location:  routeur.php?action=Login&error=Mauvais identifiants');
			}
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
			$userId = $_SESSION['id'];
			$nbRecettesPerUser = Recette::getNbRecetteByUserID($userId);
			$username = $_SESSION['username'];
			$email = $_SESSION['email'];
			$user = Utilisateur::getUser($email);
			$bio = $user['Bio'];
			include("view/profile.php");
		}else{
			header("Location: routeur.php?action=Recettes&warning=vous devez être connecté");
		}
	}

	public static function CreateRecette(){
		if(!isset($_SESSION['username'])){
			header("Location: routeur.php?action=Recettes&warning=Il faut être connecté pour créer une recette");
		}
		if(isset($_SESSION["id"])){
			$userId = $_SESSION["id"];
		}else{
			$userId = Utilisateur::getUser($_SESSION["email"])['UserID'];
		}
		if(isset($_POST["envoyer"])){
			$titre = $_POST["titre"];
			$categories = $_POST["categories"];
			$description = $_POST["description"];
			$hours = $_POST["hours"];
			$minutes = $_POST["minutes"];
			$nbpersonnes = $_POST["nbpersonnes"];
			$difficulte = $_POST["difficulte"];	
			$duree = $hours * 60 + $minutes;
			$image = "images/recettes/default.png";
			$etapes = array();
			$countEtape = 0;
			$target_dir = "images/recettes/";
			$basename = basename($_FILES["photo"]["name"]);
			//encrypt the file name
			$basename = md5($basename);
			//add file name to the target file + file extension
			$imageFileType = strtolower(pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION));
			$target_file = $target_dir . $basename . Utils::genString() . ".$imageFileType";
			$check = getimagesize($_FILES["photo"]["tmp_name"]);
				if($check !== false) {
					$image = $target_file;
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ){
						header("Location: routeur.php?action=Profile&error=Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés");
					}
					if($_FILES["photo"]["size"] > 50000){
						header("Location: routeur.php?action=Profile&error=Désolé, votre fichier est trop volumineux");
					}
					if(file_exists($target_file)){
						header("Location: routeur.php?action=Profile&error=Désolé, le fichier existe déjà");
					}
					move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
				} else {
					header("Location: routeur.php?action=Profile&error=Désolé, votre fichier n'a pas été téléchargé");
				}
				
			foreach($_POST as $key => $value){
				if($key == "envoyer"){
					continue;
				}
				if($value == ""){
					header("Location: routeur.php?action=CreateRecette&error=Vous devez remplir tous les champs");
				}
				if(strpos($key,"nom-etape") !== false){
					$etapes[$countEtape]['nom'] = $value;
				}else if(strpos($key,"etape") !== false){
					$etapes[$countEtape]['description'] = $value;
					$countEtape++;
				}
			}
			$description = "<p>".$description."</p>";
			foreach($etapes as $etape){
				$description.= "<strong>".$etape['nom']."</strong><br><p>".$etape['description']."</p><br>";
			}
			if(Recette::addRecette($titre,$userId,$description,$image,$duree,$difficulte,$nbpersonnes,$categories)){
				header("Location: routeur.php?action=Recettes&success=Votre recette a été créée");
			}else{
				header("Location: routeur.php?action=Recettes&error=Une erreur est survenue");
			}
		}
	}
}
?>