<?php

class editer{

    private $num_M;
    private $num_P;
    private $participe;

    public function __construct()
    {
        $this->num_M = 0;
        $this->num_P = 0;
        $this->participe = -1;
    }

    public function getNum_M(){
        return $this->num_M;
    }

    public function getNum_P(){
        return $this->num_P;
    }

    public function getParticipe(){
        return $this->participe;
    }

    public function setNum_M($num_M){
        $this->num_M = $num_M;
    }

    public function setNum_P($num_P){
        $this->num_P = $num_P;
    }

    public function setParticipe($participe){
        $this->participe = $participe;
    }

    public function isExiste(){
        $c = new connexion();
        $dbco = $c->connexion();

        $sth = $dbco->prepare("SELECT * FROM editer where num_p=".$this->num_P." and num_m=".$this->num_M);
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultat) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function participer(){

        if ($this->participe == 'S'){
            $p = 1;
        }else{
            $p = 0;
        }

        $c = new connexion();
        $dbco = $c->connexion();

        $sth = $dbco->prepare("INSERT INTO editer(num_m, num_p, participe) VALUES (?,?,?) ");
        $sth->execute(array($this->num_M ,$this->num_P ,$p));
    }

    public function deleteAll(){
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("DELETE from editer where num_p=".$this->num_P);
        $sth->execute();
    }

    public function nbSParP(){
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("SELECT COUNT(*) as nb FROM editer where participe=1 and num_p=".$this->num_P);
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $resultat[0]["nb"];
    }

    public function nbPParP(){
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("SELECT COUNT(*) as nb FROM editer where num_p=".$this->num_P);
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $resultat[0]["nb"];
    }

}

?>