<?php 
include('../../connexion/connexion.php');
if(isset($_POST['valider'])){
    $designation=htmlspecialchars($_POST['designation']);
    echo $designation;
    $sel=$connexion->prepare("SELECT * from categorie where designation=?");
    $sel->execute(array($designation));
    if($existe=$sel->fetch())
    {
        $_SESSION['notif']="cette categorie existe deja";
        header("location:../../views/categorie.php");
    }
    else
    {
        $req=$connexion->prepare("INSERT INTO categorie (designation) values  (?)");
        $req->execute(array($designation));
        if($req){
            $_SESSION['notif']="Enregistrement reussie";
            header("location:../../views/categorie.php");
        }
    }
    
    

}
?>