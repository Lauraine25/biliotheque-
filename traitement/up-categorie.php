<?php 
include('../../connexion/connexion.php');
if(isset($_POST['valider'])){
    $id=$_GET['id'];
    $designation=htmlspecialchars($_POST['designation']);
   
    $req=$connexion->prepare("UPDATE  categorie SET  designation=? where id=?");
    $req->execute(array($designation,$id));
    if($req){
        $_SESSION['notif']="Modification  reussie";
        header("location:../../views/categorie.php?new");
    }
   

}
?>