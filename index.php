<?php
session_start();

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profil</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <h1>Mon compte</h1>
        <hr>
        <menu>
            <li><a href="index.php">Mon compte</a></li>
            <li><a href="inscrit.php">Inscrits</a></li>
            <li><a href="emprunt.php">Emprunts</a></li>
            <li><a href="auteur.php">Auteurs</a></li>
            <li><a href="livre.php">Livres</a></li>
        </menu>
        <hr>
        <h2>Mes informations</h2>
        <form action="index.php" method="POST">
            <table class="table table-striped table-hover">
                <tr>
                    <td><label for="nom"> Nom: </label></td>
                    <td><input type="text" id="nom" name="nom" value="<?=$_SESSION['nom']?>"></td>
                </tr>
                <tr>
                    <td><label for="prenom"> Prenom: </label></td>
                    <td><input type="text" id="prenom" name="prenom" value="<?=$_SESSION['prenom']?>"></td>
                </tr>
                <tr>
                    <td><label for="email"> Email: </label></td>
                    <td><input type="email" id="email" name="email" value="<?=$_SESSION['email']?>"></td>
                </tr>
                <tr>
                    <td><label for="motdepasse"> Mot de passe : </label></td>
                    <td><input type="password" id="motdepasse" name="motdepasse" value="<?=$_SESSION['mot_de_passe']?>"></td>
                </tr>
                <tr>
                    <td><label for="telfixe"> Numero de Telephone fixe: </label></td>
                    <td><input type="tel"  id="telfixe" name="telfixe" value="<?=$_SESSION['telfixe']?>"></td>
                </tr>
                <tr>
                    <td><label for="telportable"> Numero de Telephone portable: </label></td>
                    <td><input type="tel"  id="telportable" name="telportable" value="<?=$_SESSION['telportable']?>"></td>
                </tr>
                <tr>
                    <td><label for="rue"> Rue:  </label></td>
                    <td><input type="text" id="rue" name="rue" value="<?=$_SESSION['rue']?>"></td>
                </tr>
                <tr>
                    <td><label for="cp"> Code postal: </label></td>
                    <td><input type="text" id="cp" name="cp" value="<?=$_SESSION['cp']?>"></td>
                </tr>
                <tr>
                    <td><label for="ville"> Ville: </label></td>
                    <td><input type="text" id="ville" name="ville" value="<?=$_SESSION['ville']?>"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Modifier"></td>
                </tr>
            </table>
        </form>
        <form action="deconnection.php" method="post">
        <input type="submit" value="Se deconnecter" name="deconnection">
        </form>
        <form action="desinscription.php" method="post">
            <input type="submit" value="Se desinscrire" name="desinscription">
        </form>
        <p><a href="desinscription.php">Vous voulez vous desinscrire ? Cliquez ici</a></p>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
<?php

if(isset($_POST["nom"]) && isset($_POST["prenom"]) &&
    isset($_POST["email"]) && isset($_POST["motdepasse"]) &&
    isset($_POST["telfixe"]) && isset($_POST["telportable"]) &&
    isset($_POST["rue"]) && isset($_POST["cp"]) &&
    isset($_POST["ville"])) {
    $bdd = new PDO('mysql:host=localhost;dbname=rmr_bibliotheque; charset=utf8', 'root', '');
    $req = $bdd->prepare('UPDATE inscrit SET nom=:nom, prenom=:prenom,email =:email,mot_de_passe=:motdepasse,
        tel_fixe=:telfixe,tel_portable= :telportable,cp=:cp,rue=:rue,ville=:ville WHERE id_inscrit=:id');
    $req->execute(array(
        'nom' => $_POST["nom"],
        'prenom' => $_POST["prenom"],
        'email' => $_POST["email"],
        'motdepasse' => $_POST["motdepasse"],
        'telfixe' => $_POST["telfixe"],
        'telportable' => $_POST["telportable"],
        'rue' => $_POST["rue"],
        'ville' => $_POST["ville"],
        'cp' => $_POST["cp"],
        'id' => $_SESSION["id"]
    ));
    $response=$req->fetch();
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['prenom'] = $_POST['prenom'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['mot_de_passe'] = $_POST['motdepasse'];
    $_SESSION['telfixe'] = $_POST['telfixe'];
    $_SESSION['telportable'] = $_POST['telportable'];
    $_SESSION['rue'] = $_POST['rue'];
    $_SESSION['cp'] =$_POST['cp'];
    $_SESSION['ville'] = $_POST['ville'];

}
?>