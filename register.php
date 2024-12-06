<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <h2>Inscription</h2>
        <form method="post" action="register.php">
            <table>
                <tr>
                    <td><label for="nom"> Nom: </label></td>
                    <td><input type="text" id="nom" name="nom"></td>
                </tr>
                <tr>
                    <td><label for="prenom"> Prenom: </label></td>
                    <td><input type="text" id="prenom" name="prenom"></td>
                </tr>
                <tr>
                    <td><label for="email"> Email: </label></td>
                    <td><input type="email" id="email" name="email"></td>
                </tr>
                <tr>
                    <td><label for="motdepasse"> Mot de passe : </label></td>
                    <td><input type="password" id="motdepasse" name="motdepasse"></td>
                </tr>
                <tr>
                    <td><label for="telfixe"> Numero de Telephone fixe: </label></td>
                    <td><input type="tel"  id="telfixe" name="telfixe"></td>
                </tr>
                <tr>
                    <td><label for="telportable"> Numero de Telephone portable: </label></td>
                    <td><input type="tel"  id="telportable" name="telportable"></td>
                </tr>
                <tr>
                    <td><label for="rue"> Rue:  </label></td>
                    <td><textarea id="rue" name="rue"></textarea></td>
                </tr>
                <tr>
                    <td><label for="cp"> Code postal: </label></td>
                    <td><input type="text" id="cp" name="cp"></td>
                </tr>
                <tr>
                    <td><label for="ville"> Ville: </label></td>
                    <td><input type="text" id="ville" name="ville"></td>
                </tr>
            </table>
            <p>
                <input type="submit" name=inscription>
            </p>
        </form>
        <hr>
        <p class="lien"><a href="login.php"> Vous avez deja un compte ? Connectez vous.</a></p>
    </body>
</html>

<?php
//CONNEXION A LA BASE DE DONNEE
$bdd = new PDO('mysql:host=localhost;dbname=rmr_bibliotheque; charset=utf8', 'root', '');
//CONDITION SI LES CHAMPS SONT REMPLIS
if(isset($_POST["nom"]) && isset($_POST["prenom"]) &&
    isset($_POST["email"]) && isset($_POST["motdepasse"]) &&
isset($_POST["telfixe"]) && isset($_POST["telportable"]) &&
    isset($_POST["rue"]) && isset($_POST["cp"]) &&
isset($_POST["ville"])) {
    //ON INITIALISE NOS VARIABLES
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $mdp = $_POST["motdepasse"];
    $tel_fixe = $_POST["telfixe"];
    $tel_portable = $_POST["telportable"];
    $rue = $_POST["rue"];
    $cp = $_POST["cp"];
    $ville = $_POST["ville"];
    //ON EXECUTE UNE REQUETE PREPARE POUR ENTRER NOS DONNEES DANS LA BASE
    $req = $bdd->prepare('INSERT INTO inscrit(nom,prenom,email,mot_de_passe,
        tel_fixe,tel_portable,cp,rue,ville) VALUES(:nom,:prenom,:email,:motdepasse,:telfixe,:telportable,:cp,:rue,:ville)');
    //TABLEAU QUI VA EXECUTER NOTRE REQUETE
    $req->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'motdepasse' => $mdp,
        'telfixe' => $tel_fixe,
        'telportable' => $tel_portable,
        'rue' => $rue,
        'cp' => $cp,
        'ville' => $ville
    ));
    //AFFICHE LA CONFIRMATION DE L'INSCRIPTION
    echo ' Vous avez bien été inscrit !';
    header('Location: login.php');
}
else{ // SI ON A PAS REMPLLIS LES CHAMPS
    echo"Veuillez remplir tous les champs";//ON DEMANDE A CE QUE TOUS LES CHAMPS SOIT REMPLIS
}



