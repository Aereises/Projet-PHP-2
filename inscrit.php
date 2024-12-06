<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=rmr_bibliotheque; charset=utf8', 'root', '');
$req = $bdd->query("SELECT * FROM inscrit");
$response=$req->fetchAll();
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inscrits</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <table class="table table-striped table-hover">
       <thead>
       <tr>
           <th>Nom</th>
           <th>Prenom</th>
           <th>Email</th>
           <th>Mot de passe</th>
           <th>Numero de Telephone fixe</th>
           <th>Numero de Telephone portable</th>
           <th>Rue</th>
           <th>Code postal</th>
           <th>Ville</th>
       </tr>
       </thead>
        <tbody>
        <?php
        foreach($response as $row){
            echo " <tr>
                <td>".$row['nom']."</td>
                <td>".$row['prenom']."</td>
                <td>".$row['email']."</td>
                <td>".$row['mot_de_passe']."</td>
                <td>".$row['tel_fixe']."</td>
                <td>".$row['tel_portable']."</td>
                <td>".$row['rue']."</td>
                <td>".$row['cp']."</td>
                <td>".$row['ville']."</td>
            </tr>";
        }
        ?>
        </tbody>
    </table>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
