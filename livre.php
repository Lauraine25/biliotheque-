<?php 
include("connexion/connexion.php");
if(isset($_GET["idModif"])){
    $id=$_GET["idModif"];
    $titre="Modifier les informations sur le livre";
    $btn="Modifier";
    $getlivre=$connexion->prepare("SELECT * FROM livre where id=?");
    $getlivre->execute([$id]);
    $Afficher_up=$getlivre-> fetch();
    $action="traitement/modifier.php?idModif=$id";

}else{
    $titre="Ajouter un livre";
    $btn="Enregistrer";
    $action="traitement/ajouter.php";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>livre</title>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="modal modal-signin position-static d-block bg-secondary py-5" tabindex="-1" role="dialog"
        id="modalSignin">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-5 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <!-- <h5 class="modal-title">Modal title</h5> -->
                    <h2 class="fw-bold mb-0"><?php echo $titre?></h2>
                    <a href="index.php"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
                    
                </div>

                <div class="modal-body p-5 pt-0">
                    <form class="" action="<?php echo $action?>" method="POST">
                        <div class="form-floating ">
                            <div class="col-12">
                                <label for="floatingInput">Titre du livre</label>
                                <input type="text" class="form-control rounded-4" id="floatingInput"placeholder="Titre du livre" name="titre"  <?php if(isset($_GET["idModif"])) {?>value="<?=$Afficher_up[1];?>"<?php }?>>
                            </div>
                            <div class="col-12">
                                <label for="floatingInput">Auteur</label>
                                <input type="text" class="form-control rounded-4" id="floatingInput"placeholder="Auteur" name="auteur"  <?php if(isset($_GET["idModif"])) {?>value="<?=$Afficher_up[2];?>"<?php }?>>
                            </div>
                            
                           <div class="col-12">
                                <label for="floatingInput">Année de publication</label>
                                <input type="date" class="form-control rounded-4" id="floatingInput"placeholder="Annee" name="annee"  <?php if(isset($_GET["idModif"])) {?>value="<?=$Afficher_up[3];?>"<?php }?>>
                           </div>
                            <div class="col-12">
                                <label for="floatingInput">categorie</label>
                                <input type="text" class="form-control rounded-4" id="floatingInput"placeholder="Genre" name="genre"  <?php if(isset($_GET["idModif"])) {?>value="<?=$Afficher_up[4];?>"<?php }?>>
                            </div>
                         
                        </div>
                        
                        

                        <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit" name="enregistrer"><?php echo $btn?></button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>