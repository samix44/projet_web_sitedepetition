<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="shortcut icon" href="img/petition_logo.webp" type="image/png">
    <link rel="stylesheet" href="css/profile.css">
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
                    <form action="creerPetition.php" method="post"> 
                        <li>
                            <input type="submit" class="sbtn" value="créer une pétition">
                        </li>
                    </form>
                    <form action="" method="post">
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
                        $sth = $dbco->prepare("SELECT nom, prenom,image FROM membre where num_M=".$vID);
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
    
    <section id="profile" class="center">
        <h2>Modifier votre profile</h2>

        <?php

        $c = new connexion();
        $dbco = $c->connexion();
        $sth = $dbco->prepare("SELECT * from membre where num_M=".$vID);
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);

        echo '<form action="profile.php" method="post" enctype="multipart/form-data">
                <div class="block_txt">
                    <div class="txt">
                        <input type="text" value="'.$resultat[0]["nom"].'" name="nom" id="nom" required>
                        <span></span>
                        <label>Nom</label>
                    </div>
                    <div class="txt">
                        <input type="text" id="prenom" name="prenom" value="'.$resultat[0]["prenom"].'" required>
                        <span></span>
                        <label>Prénom</label>
                    </div>
                </div>
                <div class="txt">
                    <input type="text" value="'.$resultat[0]["email"].'" id="email" name="email" required>
                    <span></span>
                    <label>Email</label>
                </div>
                <div class="block_txt">
                    <div class="txt">
                        <input type="text" id="mdp" value="'.$resultat[0]["mdp"].'" name="mdp" required>
                        <span></span>
                        <label>Mot de passe</label>
                    </div>
                    <div class="txt">
                        <input type="text" id="cmdp" value="'.$resultat[0]["mdp"].'" required>
                        <span></span>
                        <label>Confirmation</label>
                    </div>
                </div>
                <div class="radio">';

                if ($resultat[0]["fonction"] == 'etudiant'){
                    echo'    <p>Vous êtes ?</p>
                    <input type="radio" id="etd" name="fonct" checked value="etudiant">
                    <label for="etd">étudiant</label><br>
                    <input type="radio" id="prof" name="fonct" value="prof">
                    <label for="prof">prof</label><br>
                    <input type="radio" id="pa" name="fonct" value="pAdmin">
                    <label for="pa">personnel administratif</label>';
                }else{
                    if ($resultat[0]["fonction"] == 'prof'){
                        echo'    <p>Vous êtes ?</p>
                            <input type="radio" id="etd" name="fonct" value="etudiant">
                            <label for="etd">étudiant</label><br>
                            <input type="radio" id="prof" name="fonct" checked value="prof">
                            <label for="prof">prof</label><br>
                            <input type="radio" id="pa" name="fonct" value="pAdmin">
                            <label for="pa">personnel administratif</label>';
                    }else{
                        echo'    <p>Vous êtes ?</p>
                            <input type="radio" id="etd" name="fonct" value="etudiant">
                            <label for="etd">étudiant</label><br>
                            <input type="radio" id="prof" name="fonct" value="prof">
                            <label for="prof">prof</label><br>
                            <input type="radio" id="pa" name="fonct" checked value="pAdmin">
                            <label for="pa">personnel administratif</label>';
                    }
                }

                echo' </div>
                <div class="file">
                    <label class="custom-file-upload" id="upl" oninput="file_selected();">
                        <input type="file" id="file" name="file">
                        <i class="bi bi-cloud-arrow-up-fill"></i> Photo de profile
                    </label>
                </div>
                <input type="submit" class="btnn" onclick="return verif();" value="Modifier">
            </form>';


        ?>

        <?php

        require 'MyClasses/membre.php';

        if (isset($_POST['nom'])){
            
            $m = new membre();
            $m->setNum_M($vID);
            $m->setNom($_POST['nom']);
            $m->setPrenom($_POST['prenom']);
            $m->setEmail($_POST['email']);
            $m->setMdp($_POST['mdp']);
            $m->setFonction($_POST['fonct']);

            if (! $m->isExist()){
                if ($_FILES['file']['name'] != ""){
                    $m->setImage(file_get_contents($_FILES['file']['tmp_name']));
                    $m->updateWithFile();
                }else{
                    $m->updateWithoutFile();
                }
                echo "<p class='success'>votre profile est modifié avec success !</p>";
            }else{
                echo "<p class='success erreur'>Email déja existe !</p>";
            }
            
        }

        ?>
    </section>
</body>
<script src="js/modifierProfile.js"></script>
<script src="js/toggleMenu.js"></script>
</html>