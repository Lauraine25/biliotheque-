<?php 
include('../../connexion/connexion.php');
if(isset($_GET['iddel']))
{
    $id=$_GET['iddel'];
    $req=$connexion->prepare("DELETE FROM categorie where id=?");
    $req->execute(array($id));
    if($req){
        $_SESSION['notif']="suppression  reussie";
        header("location:../../views/categorie.php?new");
    }
}
