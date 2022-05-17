<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pétitions</title>
    <link rel="shortcut icon" href="img/petition_logo.webp" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <?php
        session_start();
        if (isset($_SESSION['id'])){
            session_unset();
        }
    ?>

    <!--HEADER-->

    <header>
        <nav>
            <div class="left-nav">
                <a href="#"><img src="img/petition_logo.webp" alt=""></a>
                <ul id="list">
                    <a href="#how-section"><li>Découvrez la plateforme</li></a>
                    <a href="inscription.php"><li>Inscription</li></a>
                    <a href="LoginAdmin.php"><li>Espace Admin</li></a>
                </ul>
            </div>
            <div class="right-nav">
                <a href="LoginMembre.php"><button class="btnn-c">Connecter</button></a>
                <div class="social">
                    <a href="#"><i class="bi bi-github"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
                <a href="#" onclick="togglemenu();"><i class="bi bi-list"></i></a>
            </div>                 
        </nav>

        <div id="slider">
            <div class="contenu">
                <h2><span>GESTION </span>DES<span> PETITIONS</span></h2>
                <?php
                require 'MyClasses/connexion.php';

                $c = new connexion();
                $dbco = $c->connexion();
                $req = $dbco->query("SELECT COUNT(*) as nb FROM editer WHERE participe=1");
                $donnees = $req->fetch();
                $req->closeCursor();

                echo '<p>Déjà '.$donnees["nb"].' signatures</p>';

                ?>
                
                <a href="LoginMembre.php"><button type="button" class="btn btn-outline-light">Lancer une Pétition</button></a>
            </div>   
            <figure>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </figure>
        </div>
    </header>

    <!--QOUTE SECTION-->
    
    <section id="qoute">
        <div class="contenu-qo">
            <img src="img/quote.webp" alt="">
            <h3>to improve is to <b><font color="#f44336">change</font></b>; to be perfect is to <b><font color="#f44336">change</font></b> often</h3>
            <i class="bi bi-dash-lg"></i><p>Winston Churchill</p>
        </div>
    </section>

    <!--comment ça marche-->

    <section id="how-section">
        <div class="contenu-how">
            <h4>Comment marche cette plateforme ?</h4>
            <p>Découvrez comment déposer ou signer une pétition</p>
        </div>
    </section>

    <section id="steps">
        <div class="container">
            <div class="row">
                <div class="col">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <h4>inscrivez-vous</h4>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing.</p>
                </div>
                <div class="col">
                    <i class="bi bi-pencil-square"></i>
                    <h4>créer votre pétition</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>
                <div class="col">
                    <i class="bi bi-pen"></i>
                    <h4>signer des pétitions</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
    </section>

    <!--FOOTER-->
     
    <footer>
        <ul>
            <li><a href="https://github.com/samix44" target="_blank"><i class="bi bi-github"></i></a></li>
            <li><a href="https://www.facebook.com/sami.farhat.14/" target="_blank"><i class="bi bi-facebook"></i></a></li>
            <li><a href="https://www.instagram.com/farhatsamii/?hl=id" target="_blank   "><i class="bi bi-instagram"></i></a></li>
            <
        </ul>
        <p>Copyright ©2022 Sami Farhat, all rights reserved</p>
    </footer>  
    <?php
    ?>
</body>
<script src="js/toggleMenu.js"></script>
</html>