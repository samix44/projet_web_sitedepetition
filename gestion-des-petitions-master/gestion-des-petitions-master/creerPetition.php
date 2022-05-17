<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>creer une pétition</title>
    <link rel="shortcut icon" href="img/petition_logo.webp" type="image/png">
    <link rel="stylesheet" href="css/creerPetition.css">
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
                    <form action="espaceMembre.php" method="post">  
                        <li>
                            <input type="submit" class="sbtn" value="liste des pétitions">
                        </li>
                    </form>
                    <form action="" method="post">
                        <li>
                            <input type="submit" class="sbtn" value="créer une pétition">
                        </li>
                    </form>
                    <form action="profile.php" method="post">
                        <li>
                        <input type="submit" class="sbtn" value="profile">
                        </li>
                    </form>
                </ul>
            </div>
            <div class="right-nav">
                <a href="index.php" class="Dec">Déconnexion</a>
                    <?php
                        require 'MyClasses/connexion.php';

                        $c = new connexion();
                        $dbco = $c->connexion();
                        $sth = $dbco->prepare("SELECT nom, prenom, image FROM membre where num_M=".$vID);
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

    <section id="creer">
        <div class="center">
            <h3>Création d'une pétition</h3>
            <form action="" method="post" name="f" enctype="multipart/form-data">
                <div class="txt">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre de la pétition">
                </div>
                <div class="txt">
                    <label for="text-ex" class="form-label">Text explicatif</label>
                    <textarea class="form-control" name="text" id="text" rows="3"></textarea>
                </div>
                <div class="txt">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control form-control-sm" name="image" id="image" type="file">
                </div>
                <input class="btnn" type="submit" id="btnS" onclick="return verif();" value="créer">
            </form>
            <?php
               require 'MyClasses/petition.php';

                if ( (isset($_POST['titre'])) && (isset($_POST['text'])) ){

                    $p = new petition();
                    $p->setTitre($_POST['titre']);
                    $p->setText($_POST['text']);
                    $p->setNum_M($vID);
                    $p->setImage(file_get_contents($_FILES['image']['tmp_name']));
                    $p->insert();

                    echo '<p class="success">pétition creé avec success</p>';
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
<script src="js/creerPetitionScript.js"></script>
<script src="js/toggleMenu.js"></script>
</html>