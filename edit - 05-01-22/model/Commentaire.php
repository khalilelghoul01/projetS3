<?php
require_once("config/Connexion.php");
Connexion::connect();

class Commentaire {
  
    private $CommentaireID;
    private $Text;
    private $RecetteID;
    private $UserID;
    private $Note;
    private $Date;

    //getters and setters
    public function getCommentaireID() {
        return $this->CommentaireID;
    }

    public function getText() {
        return $this->Text;
    }

    public function getRecetteID() {
        return $this->RecetteID;
    }

    public function getUserID() {
        return $this->UserID;
    }

    public function getNote() {
        return $this->Note;
    }

    public function getDate() {
        return $this->Date;
    }

    public function setCommentaireID($CommentaireID) {
        $this->CommentaireID = $CommentaireID;
    }

    public function setText($Text) {
        $this->Text = $Text;
    }

    public function setRecetteID($RecetteID) {
        $this->RecetteID = $RecetteID;
    }

    public function setUserID($UserID) {
        $this->UserID = $UserID;
    }

    public function setNote($Note) {
        $this->Note = $Note;
    }

    public function setDate($Date) {
        $this->Date = $Date;
    }





    public static function checkInsult($text){
        $params = array(
            'text' => $text,
            'lang' => 'fr',
            'opt_countries' => 'us,gb,fr',
            'mode' => 'standard',
            'api_user' => '1117381528',
            'api_secret' => 'cYJpZUcVSut3yC7YGngD',
        );
        $ch = curl_init('https://api.sightengine.com/1.0/text/check.json');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $response = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($response, true);
        if(isset($output["profanity"]["matches"])){
            return true;
        }
        else{
            return false;
        }
    }
}

?>