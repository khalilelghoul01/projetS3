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
		private $AdresseEmail;
		private $Photo;

		//Constructeur
		public function __construct($IdU=NULL,$S=NULL,$P=NULL,$DecU=NULL,$Mdp=NULL,$M=NULL,$adressPhotoProfil=NULL){
			if(!is_null($IdU)){
				$this->IDUser = $IdU;
				$this->Statut = $S;
				$this->UserName= $P;
				$this->Bio = $DecU;
				$this->MotDePasse = password_hash($Mdp, PASSWORD_BCRYPT);
				$this->AdresseEmail= $M;
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
		public function getAdresseEmail() {
			return $this->AdresseEmail;
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
		public function setAdresseEmail($M){
			$this->AdresseEmail=$M;
		}
		public function setPhoto($adressPhotoProfil){
			$this->Photo=$adressPhotoProfil;
		}

		//METHODES
		public static function Nombreutilisateur(){
			$requete = "SELECT max(UserID) as id FROM `utilisateur`;";
			$con = Connexion::con();
			$resultat = mysqli_query($con,$requete);
			$ligne = mysqli_fetch_array($resultat);
			$id = intval($ligne['id'])+1;
			return $id;
		}
		public static function getUser($user){
			$requete = "SELECT * FROM `utilisateur` WHERE Email = '$user';";
			$con = Connexion::con();
			$resultat = mysqli_query($con,$requete);
			$ligne = mysqli_fetch_assoc($resultat);
			return $ligne;
		}

		public static function addutilisateur($P,$DecU,$Mdp,$M,$adressPhotoProfil="none"){
			if(utilisateur::checkUserExist($P,$M)){
				return false;
			}
			$requetePreparee = "INSERT INTO utilisateur (`Statut`, `Username`, `Bio`, `Password`, `Email`, `Photo`, `Date`) VALUES(:tag_Statut, :tag_UserName, :tag_Bio,:tag_MotDePasse,:tag_Email,:tag_AdrrPhotoProfil,NOW());";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$con = Connexion::con();
			$valeurs = array(
				"tag_Statut" =>"0",
				"tag_UserName" =>$P,
				"tag_Bio" =>$DecU,
				"tag_MotDePasse" =>hash('ripemd160',mysqli_real_escape_string($con,htmlspecialchars(stripslashes($Mdp)))),
				"tag_Email" =>$M,
				"tag_AdrrPhotoProfil" =>$adressPhotoProfil,
			);
			

			try{
				$req_prep->execute($valeurs);
				return true;
			} catch (PDOException $e){
				echo "erreur : ".$e->getMessage()."<br>";
				return false;
			}
		}

		public static function addutilisateur_backup($P,$DecU,$Mdp,$M,$adressPhotoProfil="none"){
			if(utilisateur::checkUserExist($P,$M)){
				return false;
			}
			$con = Connexion::con();
			$P = mysqli_real_escape_string($con,$P);
			$DecU = mysqli_real_escape_string($con,$DecU);
			$Mdp = mysqli_real_escape_string($con,$Mdp);
			$M = mysqli_real_escape_string($con,$M);
			$adressPhotoProfil = mysqli_real_escape_string($con,$adressPhotoProfil);
			$requetePreparee = "INSERT INTO utilisateur (`Statut`, `Username`, `Bio`, `Password`, `Email`, `Photo`, `Date`) VALUES(0, $P, $DecU,$Mdp,$M,$adressPhotoProfil,NOW());";
			if($con->query($requetePreparee) == true){
				return true;
			}
			return false;
		}

		public static function checkUser($username,$password){
			$con = Connexion::con();
			$username = mysqli_real_escape_string($con,htmlspecialchars(stripslashes($username)));
			$password = hash('ripemd160',mysqli_real_escape_string($con,htmlspecialchars(stripslashes($password))));
			$queryUsername = "SELECT * FROM `utilisateur` WHERE Username = '$username' AND Password = '$password';";
			$queryEmail = "SELECT * FROM `utilisateur` WHERE Email = '$username' AND Password = '$password';";
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
			$query = "SELECT * FROM `utilisateur` WHERE Username = '$username' OR Email = '$email';";
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
			$query = "SELECT * FROM `utilisateur` WHERE Username = '$user' OR Email = '$user';";
			$result = mysqli_query($con,$query) or die(mysql_error());
			$rows = mysqli_fetch_array($result);
			if($rows['Photo']=="default" || $rows['Photo']=="")
				return "images/users/default.png";
			return $rows["Photo"];
		}

	}

?>