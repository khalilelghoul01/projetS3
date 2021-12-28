<?php
	require_once("config/Connexion.php");
	Connexion::connect();
	Connexion::sqlConnect();

	class Utilisateur{
		private $IDUser;
		private $Statut;
		private $UserName;
		private $Bio;
		private $MotDePasse;
		private $AdresseMail;
		private $Photo;

		//Constructeur
		public function __construct($IdU=NULL,$S=NULL,$P=NULL,$DecU=NULL,$Mdp=NULL,$M=NULL,$adressPhotoProfil=NULL){
			if(!is_null($IdU)){
				$this->IDUser = $IdU;
				$this->Statut = $S;
				$this->UserName= $P;
				$this->Bio = $DecU;
				$this->MotDePasse = password_hash($Mdp, PASSWORD_BCRYPT);
				$this->AdresseMail= $M;
				$this->Photo= $adressPhotoProfil;
			}
		}

		//Getter
		public function getIDUser() {
			return $this->IDUser;
		}
		public function getStatut() {
			return $this->Statut;
		}
		public function getUserName() {
			return $this->UserName;
		}
		public function getBio() {
			return $this->Bio;
		}
		public function getMotDePasse() {
			return $this->MotDePasse;
		}
		public function getAdresseMail() {
			return $this->AdresseMail;
		}
		public function getPhoto() {
			return $this->Photo;
		}
		//Setter
		public function setIDUser($IdU){
			$this->IDUser=$IdU;
		}
		public function setStatut($S){
			$this->Statut=$S;
		}
		public function setUserName($P){
			$this->UserName=$P;
		}
		public function setBio($DecU){
			$this->Bio=$DecU;
		}
		public function setMotDePasse($Mdp){
			$this->MotDePasse=$Mdp;
		}
		public function setAdresseMail($M){
			$this->AdresseMail=$M;
		}
		public function setPhoto($adressPhotoProfil){
			$this->Photo=$adressPhotoProfil;
		}

		//METHODES
		public static function NombreUtilisateur(){
			$requete = "SELECT max(IDUtilisateur) as id FROM `utilisateur`;";
			$con = Connexion::con();
			$resultat = mysqli_query($con,$requete);
			$ligne = mysqli_fetch_array($resultat);
			$id = intval($ligne['id'])+1;
			return $id;
		}
		public static function getUser($user){
			if( strpos($user,"@")>0 ){
				$requete = "SELECT Pseudo FROM `utilisateur` WHERE Mail = '$user';";
				$con = Connexion::con();
				$resultat = mysqli_query($con,$requete);
				$ligne = mysqli_fetch_array($resultat);
				return $ligne['Pseudo'];
			}
			return $user;
		}
		public static function addUtilisateur($P,$DecU,$Mdp,$M,$adressPhotoProfil="none"){
			if(Utilisateur::checkUserExist($P,$M)){
				return false;
			}
			$requetePreparee = "INSERT INTO Utilisateur VALUES(:tag_IDUser, :tag_Statut, :tag_UserName, :tag_Bio,:tag_MotDePasse,:tag_Mail,:tag_AdrrPhotoProfil,NOW(),:tag_IDCommentaire);";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$con = Connexion::con();
			$valeurs = array(
				"tag_Statut" =>"0",
				"tag_UserName" =>$P,
				"tag_Bio" =>$DecU,
				"tag_MotDePasse" =>hash('ripemd160',mysqli_real_escape_string($con,htmlspecialchars(stripslashes($Mdp)))),
				"tag_Mail" =>$M,
				"tag_AdrrPhotoProfil" =>$adressPhotoProfil,
				"tag_IDCommentaire" =>NULL
			);
			
			$IdU = Utilisateur::NombreUtilisateur();
			$valeurs["tag_IDUser"] = $IdU;
			echo $valeurs["tag_IDUser"];

			try{
				$req_prep->execute($valeurs);
				return true;
			} catch (PDOException $e){
				echo "erreur : ".$e->getMessage()."<br>";
				return false;
			}
		}

		public static function checkUser($username,$password){
			$con = Connexion::con();
			$username = mysqli_real_escape_string($con,htmlspecialchars(stripslashes($username)));
			$password = hash('ripemd160',mysqli_real_escape_string($con,htmlspecialchars(stripslashes($password))));
			$queryUsername = "SELECT * FROM `utilisateur` WHERE Pseudo = '$username' AND Mot_de_passe = '$password';";
			$queryEmail = "SELECT * FROM `utilisateur` WHERE Mail = '$username' AND Mot_de_passe = '$password';";
			$resultUsername = mysqli_query($con,$queryUsername) or die(mysql_error());
			$resultEmail = mysqli_query($con,$queryEmail) or die(mysql_error());
			$rowsUsername = mysqli_num_rows($resultUsername);
			$rowsEmail = mysqli_num_rows($resultEmail);
			if($rowsUsername!=1 && $rowsEmail!=1)
				return false;
			else
				return true;
			return false;	
		}
		public static function checkUserExist($username,$email){
			$con = Connexion::con();
			$username = mysqli_real_escape_string($con,htmlspecialchars(stripslashes($username)));
			$email = mysqli_real_escape_string($con,htmlspecialchars(stripslashes($email)));
			$query = "SELECT * FROM `utilisateur` WHERE Pseudo = '$username' AND Mail = '$email';";
			$result = mysqli_query($con,$query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			if($rows == 0)
				return false;
			else
				return true;
			return false;	
		}

		public static function getImageFromUser($user){
			$con = Connexion::con();
			$query = "SELECT * FROM `utilisateur` WHERE Pseudo = '$user' OR Mail = '$user';";
			$result = mysqli_query($con,$query) or die(mysql_error());
			$rows = mysqli_fetch_array($result);
			if($rows['Addr_Photo_Profil']=="none")
				return "images/user/default.png";
			return "images/".$rows["Addr_Photo_Profil"];
		}
	}

?>