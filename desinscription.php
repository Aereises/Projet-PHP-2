<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Desinscription</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <h1>Desinscription</h1>
        <hr>
        <menu>
            <li><a href="index.php">Mon compte</a></li>
            <li><a href="inscrit.php">Inscrits</a></li>
            <li><a href="emprunt.php">Emprunts</a></li>
            <li><a href="auteur.php">Auteurs</a></li>
            <li><a href="livre.php">Livres</a></li>
        </menu>
        <hr>
        <h2>Formulaire de desinscription</h2>
        <p>Nous sommes triste de vous voir partir</p>
        <form>
            <table>
                <tr>
                    <td><label for="desinscrire">Voulez vous vraiment partir ?</label></td>
                    <td><input type="text" id="desinscrire" name="desinscrire"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Se desinscrire"></td>
                </tr>
            </table>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>

<?php
if(isset($_POST["desinscrire"])){
    $suppression = $_POST["desinscrire"];
    $bdd = new PDO('mysql:host=localhost;dbname=rmr_bibliotheque; charset=utf8', 'root', '');
    $req=$bdd->prepare("DELETE FROM inscrit WHERE id_inscrit=:id");
    $req -> execute(array(
            'id' => $_SESSION["id"]
    ));

}

