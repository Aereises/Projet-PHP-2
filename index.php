<?php
session_start();

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
        <li><a href="">Emprunts</a></li>
        <li><a href="">Auteurs</a></li>
        <li><a href="">Livres</a></li>
    </menu>
    <hr>
    <h2>Mes informations</h2>
    <form action="index.php" method="post">
        <table>
            <tr>
                <td><label for="nom"> Nom: </label></td>
                <td><input type="text" id="nom" name="nom" value="<?=$_SESSION['nom']?>"></td>
                <td> <input type="submit" value="Modifier"> </td>
            </tr>
            <tr>
                <td><label for="prenom"> Prenom: </label></td>
                <td><input type="text" id="prenom" name="prenom" value="<?=$_SESSION['prenom']?>"></td>
                <td> <input type="submit" value="Modifier"> </td>
            </tr>
            <tr>
                <td><label for="email"> Email: </label></td>
                <td><input type="email" id="email" name="email" value="<?=$_SESSION['email']?>"></td>
                <td> <input type="submit" value="Modifier"> </td>
            </tr>
            <tr>
                <td><label for="motdepasse"> Mot de passe : </label></td>
                <td><input type="password" id="motdepasse" name="motdepasse" value="<?=$_SESSION['mot_de_passe']?>"></td>
                <td> <input type="submit" value="Modifier"> </td>
            </tr>
            <tr>
                <td><label for="telfixe"> Numero de Telephone fixe: </label></td>
                <td><input type="tel"  id="telfixe" name="telfixe" value="<?=$_SESSION['telfixe']?>"></td>
                <td> <input type="submit" value="Modifier"> </td>
            </tr>
            <tr>
                <td><label for="telportable"> Numero de Telephone portable: </label></td>
                <td><input type="tel"  id="telportable" name="telportable" value="<?=$_SESSION['telportable']?>"></td>
                <td> <input type="submit" value="Modifier"> </td>
            </tr>
            <tr>
                <td><label for="rue"> Rue:  </label></td>
                <td><input type="text" id="rue" name="rue" value="<?=$_SESSION['rue']?>"></td>
                <td> <input type="submit" value="Modifier"> </td>
            </tr>
            <tr>
                <td><label for="cp"> Code postal: </label></td>
                <td><input type="text" id="cp" name="cp" value="<?=$_SESSION['cp']?>"></td>
                <td> <input type="submit" value="Modifier"> </td>
            </tr>
            <tr>
                <td><label for="ville"> Ville: </label></td>
                <td><input type="text" id="ville" name="ville" value="<?=$_SESSION['ville']?>"></td>
                <td> <input type="submit" value="Modifier"> </td>
            </tr>
    </table>
    <p></p>
</form>
</body>
</html>
<?php
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
?>