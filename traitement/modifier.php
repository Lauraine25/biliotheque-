<?php
include("../connexion/connexion.php");

if(isset($_POST["enregistrer"]))
{
    if(isset($_GET["idModif"])){
        $id=$_GET["idModif"];
        $titre = htmlspecialchars($_POST['titre']);
        $auteur = htmlspecialchars($_POST['auteur']);
        $annee= htmlspecialchars($_POST['annee']);
        $genre = htmlspecialchars($_POST['genre']);
        if (!empty($titre) && !empty( $auteur) && !empty($annee) && !empty($genre)){

            $req=$connexion->prepare("UPDATE livre SET titre=?,auteur=?,annee=?,genre=? WHERE id=?");
            $test=$req->execute(array($titre, $auteur, $annee, $genre,$id));
            if($test==true){
                $_SESSION['message']="modification  reussie";
                header("location:../index.php");

            }
            else {
                header("location:../index.php");
            }
        }else{
            header("location:../index.php");
        }
    }
    
}else{
    header("location:../index.php");
}