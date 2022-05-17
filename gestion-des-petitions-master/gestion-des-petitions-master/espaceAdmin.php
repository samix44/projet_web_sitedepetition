<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin</title>
    <link rel="shortcut icon" href="img/petition_logo.webp" type="image/png">
    <link rel="stylesheet" href="css/espaceAdminStyle.css">
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
                    <a href="#"><li>Liste des pétitions</li></a>
                    <a href="statistiques.php"><li>Statistiques</li></a>
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

    <div class="titre-pt">
        <h2>Liste des pétitions</h2>
    </div>

    <?php
    require 'MyClasses/petition.php';
    require 'MyClasses/editer.php';
    require 'MyClasses/commenter.php';
    
    if (isset($_POST['codeS'])){
        $numP = $_POST['codeS'];
        
        $p = new petition();
        $p->setNum_P($_POST['codeS']);
        $p->supprimer();
        
        $e = new editer();
        $e->setNum_P($_POST['codeS']);
        $e->deleteAll();

        $co = new commenter();
        $co->setNum_P($_POST['codeS']);
        $co->deleteAll();

        echo '<p class="success">supprission fait avec success</p>';
        
    }

    ?>

    <section class="lst-petition">
    <div class="container">
            <?php

                $c = new connexion();
                $dbco = $c->connexion();
                $sth = $dbco->prepare("SELECT * from petition");
                $sth->execute();
                $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);

                

                for ($i=0; $i < count($resultat); $i++) { 
                    if (($i+1) % 3 == 1){
                        echo '<div class="row">';
                    }
                    
                    $req = $dbco->query("SELECT COUNT(*) as nb FROM editer WHERE num_p=".$resultat[$i]['num_p']." and participe=1");
                    $donnees = $req->fetch();
                    $req->closeCursor();

                    echo '<div class="col">
                            <img src="data:image/jpg;base64,'.base64_encode( $resultat[$i]['image'] ).'"/>
                            <h4>'.$resultat[$i]["titre"].'</h4>
                            <p><span>'.$donnees["nb"].'</span> signatures</p>
                            <p class="petition-text">'.$resultat[$i]["text"].'</p>
                            <div class="flex">
                                <form action="espaceAdmin.php" method="POST">
                                    <input class="hide" name="codeS" type="text" value="'.$resultat[$i]["num_p"].'">
                                    <input type="submit" class="button-81" value="Supprimer">
                                </form>
                            </div>
                            <form action="petitionAdmin" method="POST">
                                <input class="hide" name="code" type="text" value="'.$resultat[$i]["num_p"].'">
                                <input type="submit" class="btnn" value="Voir Plus">
                            </form>
                        </div>';

                    if (($i+1) % 3 == 0){
                        echo '</div>';
                    }
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
<script src="js/toggleMenu.js"></script>
</html>