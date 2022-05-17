<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statiqtisues</title>
    <link rel="shortcut icon" href="img/petition_logo.webp" type="image/png">
    <link rel="stylesheet" href="css/statistiquesStyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php
    session_start();
    $vID = $_SESSION['id'];
    ?>
    <header>
        <nav>
            <div class="left-nav">
                <a href="#"><img src="img/petition_logo.webp" alt=""></a>
                <ul id="list">
                    <a href="espaceAdmin.php"><li>Liste des pétitions</li></a>
                    <a href="#"><li>Statistiques</li></a>
                </ul>
            </div>
            <div class="right-nav">
                <a href="index.php" class="Dec">Déconnexion</a>
                    <?php
                        require 'MyClasses/connexion.php';
                        
                        $c = new connexion();
                        $dbco = $c->connexion();
                        $sth = $dbco->prepare("SELECT nom, prenom, image FROM admin where num_a=".$vID);
                        $sth->execute();
                        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
                        
                        echo '<img src="data:image/jpg;base64,'.base64_encode( $resultat[0]['image'] ).'"/>';
                        echo '<ul>';
                        echo '<li>'.$vID.'</li>';
                        echo '<li>'.$resultat[0]["nom"].' '.$resultat[0]["prenom"].'</li>';    
                    ?>
                    
                </ul>
                <a href="#" onclick="togglemenu();"><i class="bi bi-list"></i></a>
            </div>                 
        </nav>
    </header>

    <section id="stat">
        <div class="container">
            <div class="row">
                <h2 class="titre"><i class="bi bi-people-fill"></i> Ressources humaines</h2>
                <div class="col">
                    <h3>Nombre totale des membres</h3>
                    <div class="cercle">
                        <?php
                        require 'MyClasses/membre.php';

                        $m = new membre();
                        echo '<h5>'.$m->nbMemebre().'</h5>';
                        ?>
                    </div>
                </div>
                <div class="col">
                    <h3>Nombre des étudiants</h3>
                    <div class="cercle">
                        <?php
                        echo '<h5>'.$m->nbEtudiant().'</h5>';
                        ?>
                    </div>
                </div>
                <div class="col">
                    <h3>Nombre des Professeurs</h3>
                    <div class="cercle">
                        <?php
                        echo '<h5>'.$m->nbProf().'</h5>';
                        ?>
                    </div>
                </div>
                <div class="col">
                    <h3>Nombre des personnels administratif</h3>
                    <div class="cercle">
                        <?php
                        echo '<h5>'.$m->nbPresA().'</h5>';
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <h2 class="titre"><i class="bi bi-file-text-fill"></i> Statistiques sur les pétitions</h2>
                <div class="col">
                    <h3>Nombre de pétitions</h3>
                    <div class="cp">
                        <?php
                        require 'MyClasses/petition.php';
                        $p = new petition();
                        echo '<h5>'.$p->nbPetition().'</h5>';
                        ?>                        
                    </div>
                </div>
                <div class="col">
                    <h3>Taux de signature</h3>
                    <div class="cp">
                        <?php
                        require 'MyClasses/editer.php';
                        $somme = 0;
                        $c = new connexion();
                        $dbco = $c->connexion();
                        $sth = $dbco->prepare("SELECT * from petition");
                        $sth->execute();
                        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
                        for ($i=0; $i < count($resultat); $i++) { 
                            $e = new editer();
                            $e->setNum_P($resultat[$i]["num_p"]);
                            $somme = $somme + $e->nbSParP();
                        }
                        echo '<h5>'.round($somme / $p->nbPetition(),2).'</h5>';
                        ?>
                    </div>
                </div>
                <div class="col">
                    <h3>Nombre des participations par pétition</h3>
                    <div class="cp">
                        <?php
                        
                        $somme = 0;
                        $c = new connexion();
                        $dbco = $c->connexion();
                        $sth = $dbco->prepare("SELECT * from petition");
                        $sth->execute();
                        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
                        for ($i=0; $i < count($resultat); $i++) { 
                            $e = new editer();
                            $e->setNum_P($resultat[$i]["num_p"]);
                            $somme = $somme + $e->nbPParP();
                        }
                        echo '<h5>'.round($somme / $p->nbPetition() ,2).'</h5>';
                        ?>
                    </div>
                </div>
                <div class="col">
                    <h3>Nombre de pétitions gagnantes</h3>
                    <div class="cp">
                        <?php
                        $nb=0;
                        $c = new connexion();
                        $dbco = $c->connexion();
                        $sth = $dbco->prepare("SELECT * from petition");
                        $sth->execute();
                        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
                        for ($i=0; $i < count($resultat); $i++) { 
                            $e = new editer();
                            $e->setNum_P($resultat[$i]["num_p"]);
                            if ($e->nbSParP() > ($m->nbMemebre() / 2)){
                                $nb++;
                            }
                        }
                        echo '<h5>'.$nb.'</h5>';
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
     
    <footer>
        <ul>
            <li><a href="https://github.com/samix44" target="_blank"><i class="bi bi-github"></i></a></li>
            <li><a href="https://www.facebook.com/sami.farhat.14/" target="_blank"><i class="bi bi-facebook"></i></a></li>
            <li><a href="https://www.instagram.com/farhatsamii/?hl=id" target="_blank   "><i class="bi bi-instagram"></i></a></li>
            <
        </ul>
        <p>Copyright ©2022 Sami Farhat, all rights reserved</p>
    </footer>  
</body>
<script src="js/toggleMenu.js"></script>
</html>