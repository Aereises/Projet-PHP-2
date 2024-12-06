<?php
session_start();

$_SESSION['id'];
$_SESSION['nom'];
$_SESSION['prenom'];
$_SESSION['email'];
$_SESSION['mot_de_passe'];
$_SESSION['telfixe'];
$_SESSION['telportable'];
$_SESSION['rue'];
$_SESSION['cp'];
$_SESSION['ville'];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Profil</title>
    </head>
    <body>
        <h1>Votre profil</h1>
        <hr>
        <menu>
            <li><a href="inscrit.php">Inscrit</a></li>
            <li><a href="emprunt.php">Emprunts</a></li>
            <li><a href="auteur.php">Auteurs</a></li>
            <li><a href="livre.php">Livres</a></li>
        </menu>
        <hr>
        <h2>Mes informations</h2>
        <form action="index.php" method="POST">
            <table>
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
            </table>
            <input type="submit" value="Modifier">
            <p></p>
        </form>
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