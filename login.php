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
        $_SESSION['mot_de_passe'] = $response['motdepasse'];
        $_SESSION['telfixe'] = $response['tel_fixe'];
        $_SESSION['telportable'] = $response['tel_portable'];
        $_SESSION['rue'] = $response['rue'];
        $_SESSION['cp'] = $response['cp'];
        $_SESSION['ville'] = $response['ville'];
        header("location:index.php");
    }

    else{
        echo "Vous n'etes pas encore inscrit. Veuillez vous inscrire pour acceder au site";
        header('location:register.html');
    }

}else{
    Echo"Veuillez remplir tous les champs";
}