<?php
include_once('../connexion/connexion.php');

if (isset($_POST["enregistrer"])) {
    $titre = htmlspecialchars($_POST['titre']);
    $auteur = htmlspecialchars($_POST['auteur']);
    $annee= htmlspecialchars($_POST['annee']);
    $genre = htmlspecialchars($_POST['genre']);
    if (!empty($titre) && !empty( $auteur) && !empty($annee) && !empty($genre)) {
        $req = $connexion->prepare('INSERT INTO livre(titre,auteur,annee,genre) VALUES (?, ?, ?, ?)');
        $test = $req->execute(array($titre, $auteur, $annee, $genre));
        if ($test==true) {
            $_SESSION['message']="enregistrement reussi";
            header("Location: ../index.php");
           
        } else {
            header("Location: ../index.php");
        }
    } else {

        header("Location: ../index.php");
    }
}
?>