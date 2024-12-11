<?php
session_start();
if(isset($_POST["desinscription"])) {
    if ($_SESSION['admin'] == "admin") {
        echo"Desolé mais vous etes admin. Vous ne pouvez pas vous desinscrire.";
    }
    else {
        $bdd = new PDO('mysql:host=localhost;dbname=rmr_bibliotheque; charset=utf8', 'root', '');
        $req = $bdd->prepare("DELETE FROM inscrit WHERE id_inscrit=:id");
        $req->execute(array(
            'id' => $_SESSION["id"]
        ));
        session_destroy();
        header('Location:register.php');

    }
}

