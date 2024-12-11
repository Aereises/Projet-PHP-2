<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=rmr_bibliotheque; charset=utf8', 'root', '');
$req = $bdd->query("SELECT * FROM inscrit");
$response=$req->fetchAll();
var_dump($response);
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Inscrits</title>
    </head>
    <body>
    <h1>Liste des inscrits</h1>
    <hr>
    <menu>
        <li><a href="index.php">Mon compte</a></li>
        <li><a href="inscrit.php">Inscrits</a></li>
        <li><a href="emprunt.php">Emprunts</a></li>
        <li><a href="auteur.php">Auteurs</a></li>
        <li><a href="livre.php">Livres</a></li>
    </menu>
    <hr>
    <form action="inscrit.php" method="post">
    <table class="table table-hover">
       <thead>
       <tr>
           <?php
           if($_SESSION['Admin']=="admin"){
               echo "<th>Supprimer</th>";

           }
           ?>
           <th>Nom</th>
           <th>Prenom</th>
           <th>Email</th>
           <?php
           if($_SESSION['Admin']=="admin"){
               echo "<th>Mot De Passe</th>";

           }
           ?>
           <th>Numero de Telephone fixe</th>
           <th>Numero de Telephone portable</th>
           <th>Rue</th>
           <th>Code postal</th>
           <th>Ville</th>
       </tr>
       </thead>
        <tbody>
        <?php
        if($_SESSION['Admin']=="admin") {
            foreach ($response as $row) {
                echo " <tr>
                <td><input type='checkbox' name='suppression'></td>
                <td><input type='text' name='nom' value='".$row['nom']."'></td>
                <td><input type='text' name='prenom' value='".$row['prenom']."'></td>
                <td><input type='email' name='email' value='".$row['email']."'></td>
                <td><input type='password' name='motdepasse' value='".$row['mot_de_passe']."'></td>
                <td><input type='tel' name='telfixe' value='".$row['tel_fixe']."'></td>
                <td><input type='tel' name='telportable' value='".$row['tel_portable']."'></td>
                <td><input type='text' name='rue' value='".$row['rue']."'></td>
                <td><input type='text' name='cp' value='".$row['cp']."'></td>
                <td><input type='text' name='ville' value='".$row['ville']."'></td>
            </tr>";
            }
            echo "<tr><td><input type='submit' name='suppression' value='Supprimer'></td>
                <td></td><input type='submit' name='modification' value='Modifier'></td></tr>";
        } else {
            foreach ($response as $row) {
                echo " <tr>
                <td>" . $row['nom'] . "</td>
                <td>" . $row['prenom'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['tel_fixe'] . "</td>
                <td>" . $row['tel_portable'] . "</td>
                <td>" . $row['rue'] . "</td>
                <td>" . $row['cp'] . "</td>
                <td>" . $row['ville'] . "</td>
            </tr>";
            }
        }
        ?>
        </tbody>
    </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
<?php
$bdd = new PDO('mysql:host=localhost;dbname=rmr_bibliotheque; charset=utf8', 'root', '');
if(isset($_POST["nom"]) && isset($_POST["prenom"]) &&
    isset($_POST["email"]) && isset($_POST["motdepasse"]) &&
    isset($_POST["telfixe"]) && isset($_POST["telportable"]) &&
    isset($_POST["rue"]) && isset($_POST["cp"]) &&
    isset($_POST["ville"]) && isset($_POST["modification"])) {
    $req = $bdd->prepare('UPDATE inscrit SET nom=:nom, prenom=:prenom,email =:email,mot_de_passe=:motdepasse,
        tel_fixe=:telfixe,tel_portable= :telportable,cp=:cp,rue=:rue,ville=:ville WHERE id=:id  ');
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
        'id' => $response["id"]
    ));
    $res=$req->fetchall();
}
elseif(isset($_POST["nom"]) && isset($_POST["prenom"]) &&
    isset($_POST["email"]) && isset($_POST["motdepasse"]) &&
    isset($_POST["telfixe"]) && isset($_POST["telportable"]) &&
    isset($_POST["rue"]) && isset($_POST["cp"]) &&
    isset($_POST["ville"]) && isset($_POST["suppression"])){
    if($_POST["nom"]==$_SESSION['nom'] && $_POST["prenom"]==$_SESSION['prenom'] && $_POST["email"]==$_SESSION['email']
    && $_POST["motdepasse"]==$_SESSION['mot_de_passe'] && $_POST["telfixe"]==$_SESSION['telfixe'] &&
        $_POST["telportable"]==$_SESSION['telportable'] && $_POST["rue"]==$_SESSION['rue'] && $_POST["cp"]==$_SESSION['cp'] &&
    $_POST["ville"]==$_SESSION['ville']){
        echo'Vous etes administrateur. Vous ne pouvez pas vous supprimer.';
    }
    else{
    $bdd = new PDO('mysql:host=localhost;dbname=rmr_bibliotheque; charset=utf8', 'root', '');
    $req = $bdd->prepare("DELETE FROM inscrit WHERE nom=:nom, prenom=:prenom,email =:email,mot_de_passe=:motdepasse,
        tel_fixe=:telfixe,tel_portable= :telportable,cp=:cp,rue=:rue,ville=:ville ");
    $req->execute(array(
        'nom' => $_POST["nom"],
        'prenom' => $_POST["prenom"],
        'email' => $_POST["email"],
        'motdepasse' => $_POST["motdepasse"],
        'telfixe' => $_POST["telfixe"],
        'telportable' => $_POST["telportable"],
        'rue' => $_POST["rue"],
        'ville' => $_POST["ville"],
        'cp' => $_POST["cp"]
    ));
    session_destroy();
    header('Location:register.php');
    }
}
