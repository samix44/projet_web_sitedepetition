<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pétition</title>
    <link rel="shortcut icon" href="img/petition_logo.webp" type="image/png">
    <link rel="stylesheet" href="css/petition.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php
        session_start();
        $vID = $_SESSION['id'];
    ?>
    <form class="retour">
        <input type = "button" value = "Retour"  onclick = "window.location.href = 'http://localhost/gestion%20des%20p%C3%A9titions/espaceMembre.php';">
    </form>
    <section id="petition">
        <div class="container">
            <div class="row">
                <div class="col-4 coll">
                    <?php
                    require 'MyClasses/connexion.php';

                    $numP = $_POST['code'];                   
                        
                    $c = new connexion();
                    $dbco = $c->connexion();
                    $sth = $dbco->prepare("SELECT * from petition where num_p=".$numP);
                    $sth->execute();
                    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);

                    echo '<img src="data:image/jpg;base64,'.base64_encode( $resultat[0]['image'] ).'"/>';

                    $sth1 = $dbco->prepare("SELECT * FROM editer WHERE num_p=".$numP." and participe=1");
                    $sth1->execute();
                    $resultat1 = $sth1->fetchAll(PDO::FETCH_ASSOC);

                    $sth2 = $dbco->prepare("SELECT * FROM editer WHERE num_p=".$numP." and participe=0");
                    $sth2->execute();
                    $resultat2 = $sth2->fetchAll(PDO::FETCH_ASSOC);

                    echo '<h4><span class="vert">'.count($resultat1).'</span> signatures</h4>';
                    echo '<h4><span class="rouge">'.count($resultat2).'</span> désapprouver</h4>';

                    ?>
                    <div class="flex">
                        <form action="petition.php" method="POST">
                            <?php
                            echo '<input class="hide" name="codeP" type="text" value="'.$numP.'">';
                            echo '<input class="hide" name="code" type="text" value="'.$numP.'">';
                            echo '<input class="hide" name="part" type="text" value="S">';
                            ?>
                            <input type="submit" class="button-81" value="Signer">
                        </form>
                        <form action="petition.php" method="POST">
                            <?php
                            echo '<input class="hide" name="codeP" type="text" value="'.$numP.'">';
                            echo '<input class="hide" name="code" type="text" value="'.$numP.'">';
                            echo '<input class="hide" name="part" type="text" value="O">';
                            ?>
                            <input type="submit" class="button-81" value="S’opposer">
                        </form>
                    </div>
                    <?php
                        require 'MyClasses/editer.php';

                        if (isset($_POST['codeP'])){
                            
                            $e = new editer();
                            $e->setNum_M($vID);
                            $e->setNum_P($_POST['codeP']);
                            $e->setParticipe($_POST['part']);
                    
                            if (! $e->isExiste()){
                                $e->participer();
                                echo '<p class="successI">Vous avez participer avec success !</p>';
                            }else{
                                echo '<p class="erreur">vous avez déja participer à cette pétition</p>';;
                            }
                            
                        }
                        ?>
                    <div class="flex">
                        <form action="" method="post">
                            <label for="pet-select">Liste d'approuver</label>
                            <select name="pets" id="pet-select">
                                <?php
                                for ($i=0; $i <count($resultat1) ; $i++) { 
                                    $sth3 = $dbco->prepare("SELECT * from membre where num_m=".$resultat1[$i]['num_m']);
                                    $sth3->execute();
                                    $resultat3 = $sth3->fetchAll(PDO::FETCH_ASSOC);

                                    echo '<option value="'.$resultat3[0]["nom"].' '.$resultat3[0]["prenom"].'">'.$resultat3[0]["nom"].' '.$resultat3[0]["prenom"].'</option>';
                                }
                                ?>
                            </select>
                        </form>
                        <form action="" method="post">
                            <label for="pet-select">Liste de désapprouver</label>
                            <select name="pets" id="pet-select">
                                <?php
                                for ($i=0; $i <count($resultat2) ; $i++) { 
                                    $sth3 = $dbco->prepare("SELECT * from membre where num_m=".$resultat2[$i]['num_m']);
                                    $sth3->execute();
                                    $resultat3 = $sth3->fetchAll(PDO::FETCH_ASSOC);

                                    echo '<option value="'.$resultat3[0]["nom"].' '.$resultat3[0]["prenom"].'">'.$resultat3[0]["nom"].' '.$resultat3[0]["prenom"].'</option>';
                                }
                                ?>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="col-8 coll">
                    <div class="flex">
                        <?php
                        
                        echo '<h2>'.$resultat[0]["titre"].'</h2>';
                        
                        ?>      
                    </div>
                    <?php
                    echo '<p>'.$resultat[0]["dateDeCreation"].'</p>';
                    echo '<p>'.$resultat[0]["text"].'</p>';

                    $sth3 = $dbco->prepare("SELECT * from membre where num_m=".$resultat[0]['num_m']);
                    $sth3->execute();
                    $resultat3 = $sth3->fetchAll(PDO::FETCH_ASSOC);

                    echo '<p>créé par <span class="rouge">'.$resultat3[0]["nom"].' '.$resultat3[0]["prenom"].'</span></p>';
                    
                    ?>
                    <form action="petition.php" method="post">
                        <label for="comnt" class="form-label">écrire un commentaire</label>
                        <textarea class="form-control" name="comnt" id="comnt" rows="3"></textarea>
                        <?php
                            echo '<input class="hide" name="code" type="text" value="'.$numP.'">';
                        ?>
                        <input type="submit" class="btn btn-success" onclick="return verif();" value="commenter">
                    </form>
                    <?php

                    require 'MyClasses/commenter.php';
                    
                    if (isset($_POST['comnt'])) {
                        $co = new commenter();
                        $co->setContenu($_POST['comnt']);
                        $co->setNum_M($vID);
                        $co->setNum_P($numP);
                        $co->insert();
                        echo '<p class="success">votre commentaire est bien ajouté</p>';
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </section>

    <hr>

    <section id="comnts">
        <div class="container">
        <h3>Commentaires</h3>
            <?php

            $c = new connexion();
            $dbco = $c->connexion();
            $sth = $dbco->prepare("SELECT * from commenter where num_p=".$numP);
            $sth->execute();
            $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);

            
            for ($i=0 ; $i<count($resultat);$i++){
                $sth1 = $dbco->prepare("SELECT * from membre where num_m=".$resultat[$i]['num_m']);
                $sth1->execute();
                $resultat1 = $sth1->fetchAll(PDO::FETCH_ASSOC);
                echo '<div class="row">
                        <div class="col-2 coll">';
                        echo '<img src="data:image/jpg;base64,'.base64_encode( $resultat1[0]['image'] ).'"/>';
                        echo'</div>
                        <div class="col-10 coll">
                            <h5>'.$resultat1[0]["nom"].' '.$resultat1[0]["prenom"].'</h5>
                            <p>'.$resultat[$i]["contenu"].'</p>
                        </div>
                    </div>';
            }

            ?>
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
<script src="js/commentaire.js"></script>
</html>