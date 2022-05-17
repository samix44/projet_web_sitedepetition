<?php

class petition{

    private $num_P;
    private $titre;
    private $dateC;
    private $text;
    private $num_M;
    private $image;


    public function __construct()
    {
        $this->num_P = 0;
        $this->titre = "";
        $this->dateC = "";
        $this->text = "";
        $this->num_M = 0;
    }

    public function getNum_A(){
        return $this->num_P;
    }

    public function getTitre(){
        return $this->titre;
    }

    public function getDateC(){
        return $this->dateC;
    }

    public function getText(){
        return $this->text;
    }

    public function getNum_M(){
        return $this->num_M;
    }

    public function getImage(){
        return $this->image;
    }

    public function setNum_P($num_P){
        $this->num_P = $num_P;
    }

    public function setTitre($titre){
        $this->titre = $titre;
    }

    public function setDateC($dateC){
        $this->dateC = $dateC;
    }

    public function setText($text){
        $this->text = $text;
    }

    public function setNum_M($num_M){
        $this->num_M = $num_M;
    }

    public function setImage($image){
        $this->image = $image;
    }

    public function insert(){
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("INSERT INTO petition(titre,dateDeCreation,text,num_m,image) VALUES (?,curdate(),?,?,?) ");
        $sth->execute(array($this->titre ,$this->text ,$this->num_M ,$this->image));
    }

    public function supprimer(){
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("DELETE from petition where num_p=".$this->num_P);
        $sth->execute();
    }

    public function nbPetition(){
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("SELECT COUNT(*) as nb FROM petition");
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $resultat[0]["nb"];
    }

}

?>