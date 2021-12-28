<?php
	require_once("config/Connexion.php");
	Connexion::connect();

	class Recette{
		private $ID;
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

		//Constructeur
		public function __construct($IdR=NULL,$NomR=NULL,$AuteurR=NULL,$DecR=NULL,$AdrPhoto=NULL,$TempsPrepaMin=NULL,$NvDifficulte=NULL,$Ingredient=NULL,$NbPersonne=NULL,$Categorie=NULL,$Date=NULL){
			if(!is_null($IdR)){
				$this->ID = $IdR;
				$this->Titre = $NomR;
				$this->Auteur = $AuteurR;
				$this->Etapes = $DecR;
				$this->Thumbnail= $AdrPhoto;
				$this->Duree= $TempsPrepaMin;
				$this->Niveau_Difficulte=$NvDifficulte;
				$this->Ingredients=$Ingredient;
				$this->NB_Personnes=$NbPersonne;
				$this->Categorie=$Categorie;
				$this->Date=$Date;
			}
		}

		//Getter
		public function getID() {
			return $this->ID;
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
			return "images/recettes/".$this->Thumbnail;
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
		public function setID($IdR){
			$this->ID=$IdR;
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
		public function afficher(){
			echo "<p>Recette $this->ID de marque $this->Auteur et son nom $this->Titre</p>";
		}
		public static function NombreRecette(){
			$requete = "SELECT max(ID) as id FROM `recette`;";
			$con = Connexion::con();
			$resultat = mysqli_query($con,$requete);
			$ligne = mysqli_fetch_array($resultat);
			$id = intval($ligne['id'])+1;
			return $id;
		}

		public static function getAllRecettes(){
			$requete = "SELECT * FROM Recette;";
			$reponse = Connexion::pdo()->query($requete);
			$reponse -> setFetchMode(PDO::FETCH_CLASS,'Recette');
			$tab = $reponse->fetchAll();
			return $tab;
		}
		public static function getRecette($id){
			$requete = "SELECT * FROM Recette WHERE ID = $id;";
			$reponse = Connexion::pdo()->query($requete);
			$reponse -> setFetchMode(PDO::FETCH_CLASS,'Recette');
			$tab = $reponse->fetchAll();
			if(count($tab)==0){
				return null;
			}
			return $tab[0];
		}
	}

?>