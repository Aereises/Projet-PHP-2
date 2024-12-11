<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Connection</title>
    </head>
    <body>
        <h2>Connexion</h2>
        <form method="post" action="login.php">
            <table>
                <tr>
                    <td><label for="email"> Email : </label></td>
                    <td><input type="email" id="email" name="email"></td>
                </tr>
                <tr>
                    <td><label for="motdepasse"> Mot de passe : </label></td>
                    <td><input type="password" id="motdepasse" name="motdepasse"></td>
                </tr>
            </table>
            <p>
                <input type="submit" name=Connexion>
            </p>

        </form>
        <hr>
        <p class="lien"><a href="register.php"> Vous n'avez pas de compte ? Inscrivez vous.</a></p>
    </body>
</html>

<?php
//CONNECTION A LA BASE DE DONNEE
$bdd = new PDO('mysql:host=localhost;dbname=rmr_bibliotheque; charset=utf8', 'root', '');
// CONDITION SI LES CHAMPS SONT REMPLIS
if (isset($_POST['email']) && isset($_POST['motdepasse'])) {
    //ON INITIALISE NOS VARIABLES
    $email =$_POST['email'];
    $motdepasse =$_POST['motdepasse'];
    $req = $bdd->prepare("SELECT * FROM inscrit WHERE email=:email AND mot_de_passe=:motdepasse");
    $req->execute(array(
        'email'=>$email,
        'motdepasse' => $motdepasse,
    ));
    $response=$req->fetch();
//CONDITION SI LA REPONSE CONTIENT UN RESULTAT
    if($response) {
        session_start();
        $_SESSION['id'] = $response['id_inscrit'];
        $_SESSION['nom'] = $response['nom'];
        $_SESSION['prenom'] = $response['prenom'];
        $_SESSION['email'] = $response['email'];
        $_SESSION['mot_de_passe'] = $response['mot_de_passe'];
        $_SESSION['telfixe'] = $response['tel_fixe'];
        $_SESSION['telportable'] = $response['tel_portable'];
        $_SESSION['rue'] = $response['rue'];
        $_SESSION['cp'] = $response['cp'];
        $_SESSION['ville'] = $response['ville'];
        $_SESSION['Admin'] = $response['Admin'];
        header("location:index.php");
    }

    else{
        echo "Vous n'etes pas encore inscrit. Veuillez vous inscrire pour acceder au site";
        header('location:register.php');
    }

}else{
    Echo"Veuillez remplir tous les champs";
}