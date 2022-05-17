<?php

class admin{

    private $num_A;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $image;

    public function __construct()
    {
        $this->num_A = 0;
        $this->nom = "";
        $this->prenom = "";
        $this->email = "";
        $this->mdp = "";
    }

    public function getNum_A(){
        return $this->num_A;
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

    public function getImage(){
        return $this->image;
    }

    public function setNum_A($num_A){
        $this->num_A = $num_A;
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

    public function setImage($image){
        $this->image = $image;
    }

}

?>