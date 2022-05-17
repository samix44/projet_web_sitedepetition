<?php

class connexion{

    private $server="localhost";
    private $username="root";
    private $con;


    function connexion(){
        try {
            $this->con = new PDO("mysql:host=".$this->server.";dbname=projetpweb", $this->username, "");
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $this->con;
    }

}

?>