<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="shortcut icon" href="img/petition_logo.webp" type="image/png">
    <link rel="stylesheet" href="css/loginStyle.css">
    <link rel="stylesheet" href="css/LoginStyle2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<?php
if (isset($_SESSION)){
    session_destroy();
}
?>
<body>
    <a class="accueil" href="index.php"><i class="bi bi-arrow-left"></i></a>
    <div class="center">
        <h2>Connexion</h2>
        <form method="post" action="">
            <div class="txt">
                <input type="text" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt">
                <input type="password" name="mdp" required>
                <span></span>
                <label>Mot de passe</label>
            </div>
            <input class="btnn" type="submit" value="se connecter">
        </form>
        <?php
            require 'MyClasses/connexion.php';

            if( (isset($_POST['email'])) && (isset($_POST['mdp'])) ){
                $v_email = $_POST['email'];
                $v_mdp = $_POST['mdp'];

                $c = new connexion();
                $dbco = $c->connexion();
                $sth = $dbco->prepare("SELECT num_M ,email, mdp FROM membre where email='".$v_email."'");
                $sth->execute();
                $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);

                if (count($resultat) == 0){
                    echo "<p class='erreur' >membre n'existe pas !</p>";
                }else{
                    if ($v_mdp != $resultat[0]["mdp"]){
                        echo '<p class="erreur" >mot de passe incorrecte !</p>';
                    }else{
                        session_start();
                        $_SESSION['id'] = $resultat[0]["num_M"];

                        header("Location: espaceMembre.php");
                    }
                        
                }
            }

        ?>
        <div class="signup">
            Vous n'avez pas de compte? <a href="inscription.php">S'inscrire</a>
        </div>
    </div>
</body>
</html>