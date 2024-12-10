<?php
if(isset($_POST["desinscription"])){
    $bdd = new PDO('mysql:host=localhost;dbname=rmr_bibliotheque; charset=utf8', 'root', '');
    $req=$bdd->prepare("DELETE FROM inscrit WHERE id_inscrit=:id");
    $req -> execute(array(
            'id' => $_SESSION["id"]
    ));
    session_destroy();
header('Location:inscription.php');
var_dump($req);
}
session_start();

