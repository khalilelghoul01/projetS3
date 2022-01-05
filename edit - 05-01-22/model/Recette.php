<?php
	require_once("config/Connexion.php");
	Connexion::connect();

	class Recette{
		private $RecetteID;
		private $Titre;
		private $Auteur;
		private $Etapes;
		private $Thumbnail;
		private $Duree;
		private $Niveau_Difficulte;
		private $Ingredients;
		private $NB_Personnes;
		private $Categorie;
		private $Date;

		//Getter
		public function getRecetteID() {
			return $this->RecetteID;
		}
		public function getTitre() {
			return $this->Titre;
		}
		public function getAuteur() {
			return $this->Auteur;
		}
		public function getEtapes() {
			return $this->Etapes;
		}
		public function getThumbnail() {
			return $this->Thumbnail;
		}
		public function getDuree() {
			return $this->Duree;
		}
		public function getNiveau_Difficulte() {
			return $this->Niveau_Difficulte;
		}
		public function getIngredients() {
			return $this->Ingredients;
		}
		public function getNB_Personnes() {
			return $this->NB_Personnes;
		}
		public function getCategorie() {
			return $this->Categorie;
		}
		public function getDate() {
			return $this->Date;
		}
		//Setter
		public function setRecetteID($IdR){
			$this->RecetteID=$IdR;
		}
		public function setTitre($NomR){
			$this->Titre=$NomR;
		}
		public function setAuteur($AuteurR){
			$this->Auteur=$AuteurR;
		}
		public function setEtapes($DecR){
			$this->Etapes=$DecR;
		}
		public function setThumbnail($AdrPhoto){
			$this->Thumbnail=$AdrPhoto;
		}
		public function setDuree($TempsPrepaMin){
			$this->Duree=$TempsPrepaMin;
		}
		public function setNiveau_Difficulte($NvDifficulte){
			$this->Niveau_Difficulte=$NvDifficulte;
		}
		public function setIngredients($Ingredient){
			$this->Ingredients=$Ingredient;
		}
		public function setNB_Personnes($NbPersonne){
			$this->NB_Personnes=$NbPersonne;
		}
		public function setCategorie($Categorie){
			$this->Categorie=$Categorie;
		}
		public function setDate($Date){
			$this->Date=$Date;
		}
		//Methode
		public static function NombreRecette(){
			$requete = "SELECT max(RecetteID) as id FROM `recette`;";
			$con = Connexion::con();
			$resultat = mysqli_query($con,$requete);
			$ligne = mysqli_fetch_array($resultat);
			$id = intval($ligne['id'])+1;
			return $id;
		}

		public static function getAllRecettes(){
			$requete = "SELECT * FROM recette;";
			$reponse = Connexion::pdo()->query($requete);
			$reponse -> setFetchMode(PDO::FETCH_CLASS,'recette');
			$tab = $reponse->fetchAll();
			return $tab;
		}
		public static function getRecette($id){
			$requete = "SELECT * FROM recette WHERE RecetteID  = $id;";
			$reponse = Connexion::pdo()->query($requete);
			$reponse -> setFetchMode(PDO::FETCH_CLASS,'Recette');
			$tab = $reponse->fetchAll();
			if(count($tab)==0){
				return null;
			}
			return $tab[0];
		}

		public static function getRecetteByCategorie($categorie){
			$requete = "SELECT * FROM recette WHERE Categorie = '$categorie';";
			$reponse = Connexion::pdo()->query($requete);
			$reponse -> setFetchMode(PDO::FETCH_CLASS,'Recette');
			$tab = $reponse->fetchAll();
			return $tab;
		}

		public static function getRecetteByAuteur($auteur){
			$requete = "SELECT * FROM recette WHERE Auteur = '$auteur';";
			$reponse = Connexion::pdo()->query($requete);
			$reponse -> setFetchMode(PDO::FETCH_CLASS,'Recette');
			$tab = $reponse->fetchAll();
			return $tab;
		}

		public static function getRecetteByNom($nom){
			$requete = "SELECT * FROM recette WHERE Titre = '$nom';";
			$reponse = Connexion::pdo()->query($requete);
			$reponse -> setFetchMode(PDO::FETCH_CLASS,'Recette');
			$tab = $reponse->fetchAll();
			return $tab;
		}

		public static function getRecetteByNiveau($niveau){
			$requete = "SELECT * FROM recette WHERE Niveau_Difficulte = '$niveau';";
			$reponse = Connexion::pdo()->query($requete);
			$reponse -> setFetchMode(PDO::FETCH_CLASS,'Recette');
			$tab = $reponse->fetchAll();
			return $tab;
		}

		public static function addRecette($titre,$userId,$description,$image,$duree,$difficulte,$nbpersonnes,$categories){
			$con = Connexion::con();
			$requete = "INSERT INTO recette (`Titre`, `UserID`, `Etapes`, `Thumbnail`, `Duree`, `Niveau_Difficulte`, `NB_Personnes`, `Categorie`, `Date`, `Note`) VALUES ('$titre',$userId,'$description','$image',$duree,$difficulte,$nbpersonnes,$categories,NOW(),0);";
			if($con->query($requete) == true){
				return true;
			}
			return false;
		}

		public static function getNbRecetteByUserID($id){
			$requete = "SELECT count(*) as nb FROM recette WHERE UserID = $id;";
			$reponse = Connexion::pdo()->query($requete);
			$reponse -> setFetchMode(PDO::FETCH_CLASS,'Recette');
			$tab = $reponse->fetchAll();
			return $tab[0]->nb;
		}
	}

?>