<?php

class commenter{

    private $num_M;
    private $num_P;
    private $contenu;

    public function __construct()
    {
        $this->num_M = 0;
        $this->num_P = 0;
        $this->contenu = "";
    }

    public function getNum_M(){
        return $this->num_M;
    }

    public function getNum_P(){
        return $this->num_P;
    }

    public function getContenu(){
        return $this->contenu;
    }

    public function setNum_M($num_M){
        $this->num_M = $num_M;
    }

    public function setNum_P($num_P){
        $this->num_P = $num_P;
    }

    public function setContenu($contenu){
        $this->contenu = $contenu;
    }

    public function insert(){
        $c = new connexion();
        $dbco = $c->connexion();

        $sth = $dbco->prepare("INSERT INTO commenter(num_m, num_p, contenu) VALUES (?,?,?) ");
        $sth->execute(array($this->num_M,$this->num_P,$this->contenu));
    }

    public function deleteAll(){
        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("DELETE from commenter where num_p=".$this->num_P);
        $sth->execute();
    }

}

?>