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
    header('Location: login.html');
}
else{ // SI ON A PAS REMPLLIS LES CHAMPS
    echo"Veuillez remplir tous les champs";//ON DEMANDE A CE QUE TOUS LES CHAMPS SOIT REMPLIS
}



