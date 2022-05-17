<?php

class membre{

    private $num_M;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $fonction;
    private $image;

    public function __construct()
    {
        $this->num_M = 0;
        $this->nom = "";
        $this->prenom = "";
        $this->email = "";
        $this->mdp = "";
        $this->fonction = "";
    }

    public function getNum_M(){
        return $this->num_M;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getMdp(){
        return $this->mdp;
    }

    public function getFonction(){
        return $this->fonction;
    }

    public function getImage(){
        return $this->image;
    }

    public function setNum_M($num_M){
        $this->num_M = $num_M;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setMdp($mdp){
        $this->mdp = $mdp;
    }

    public function setFonction($fonction){
        $this->fonction = $fonction;
    }

    public function setImage($image){
        $this->image = $image;
    }

    public function insert(){
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("INSERT INTO membre(Nom,Prenom,email,mdp,fonction,image) VALUES (?,?,?,?,?,?) ");
        $sth->execute(array($this->nom, $this->prenom, $this->email, $this->mdp, $this->fonction, $this->image));
    }

    public function updateWithFile(){
        $conn=mysqli_connect("localhost","root","","projetpweb");
        $imageData = mysqli_real_escape_string($conn ,$this->image);
        $UpdateQuery = "update membre set nom='".$this->nom."', prenom='".$this->prenom."', email='".$this->email."', mdp='".$this->mdp."', fonction='".$this->fonction."', image='$imageData' where num_M=".$this->num_M;
        mysqli_query($conn,$UpdateQuery);
    }

    public function updateWithoutFile()
    {
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("update membre set nom='".$this->nom."', prenom='".$this->prenom."', email='".$this->email."', mdp='".$this->mdp."', fonction='".$this->fonction."' where num_M=".$this->num_M);
        $sth->execute();
    }

    public function isExist(){
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("SELECT email from membre where email='".$this->email."' and num_M != ".$this->num_M);
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (count($resultat) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function nbMemebre(){
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("SELECT COUNT(*) as nb FROM membre");
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $resultat[0]["nb"];
    }

    public function nbEtudiant(){
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("SELECT COUNT(*) as nb FROM membre where fonction='etudiant'");
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $resultat[0]["nb"];
    }

    public function nbProf(){
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("SELECT COUNT(*) as nb FROM membre where fonction='prof'");
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $resultat[0]["nb"];
    }

    public function nbPresA(){
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("SELECT COUNT(*) as nb FROM membre where fonction='pAdmin'");
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $resultat[0]["nb"];
    }

}

?>