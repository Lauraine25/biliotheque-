<?php
    include_once("connexion/connexion.php");

    $page=isset($_GET['page'])? intval($_GET['page']):1;
    $nb_element_page=20;
    
    if($page<1)
    {
        $page=1;
    }
    $afficher=($page-1)*$nb_element_page;
    if(isset($_GET['recherche']))

    {
        $recherche=$_GET['recherche'];
        $count_element=$connexion->prepare("SELECT count(id)  as total FROM livre  where titre  LIKE ? OR auteur  LIKE ?  OR genre  LIKE ?");
        $count_element->execute(array("%".$recherche."%","%".$recherche."%","%".$recherche."%")); 

        $nb=$count_element->fetch();
       
        


        $req=$connexion->prepare("SELECT * FROM livre where titre  LIKE ? OR auteur  LIKE ?  OR genre  LIKE ? limit $afficher,$nb_element_page");
        $req->execute(array("%".$recherche."%","%".$recherche."%","%".$recherche."%")); 

    }
    else
    {
        $count_element=$connexion->prepare("SELECT count(id)  as total FROM livre ");
        $count_element->execute();
        $nb=$count_element->fetch();
       
        


        $req=$connexion->prepare("SELECT * FROM livre limit $afficher,$nb_element_page");
        $req->execute();
    }
   

    $total_element=$nb['total'];

    
    $totalpage=ceil($total_element/$nb_element_page);
    if($page>$totalpage)
    {
        $page=$totalpage;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
</head>
<body>
    <thead>
        <h1 style="text-align: center;">GESTION BILIOTHEQUE</h1>
    </thead>
    <div>

    <div class="row">
                <div class="col-12">
                    <form action="" method="get" >

                     <div class="row">
                     <div class="col-xl-3 col-lg-3 ">
                        <?php if(isset($_GET['recherche'])){?>
                            <a href="index.php" class="btn btn-dark col-12">Annuler</a>
                        <?php } else { ?>
                             <input type="submit" name="submit" class="btn btn-success col-12" value="search">
                        <?php } ?>          
                    </div>
                    <div class="col-xl-9 col-lg-9 ">
                        <input type="text"  required name="recherche" placeholder="rechercher.................... " class="form-control">
                    </div>
                     </div>
                    

                    </form>

                </div>
            </div>
        <a href="livre.php" class="btn btn-dark">Ajouter un livre</a>
              <?php
                            if(isset($_SESSION['message'])){
                                
                                ?> 
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['message'];unset($_SESSION['message']);?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php
                            }
                        ?>   
    </div>
    
    <div>
        <div class="col-12">
            <p>pagination</p>
            <?php 
       for($i=1;$i<=$totalpage;$i++)
          {
              
              if(isset($_GET['recherche']))
                {
                     $rec=$_GET['recherche'];
                     $href="?recherche=".$rec."&page=$i";
                 }
                 else
                  {
                    $href="?page=$i";
                 }
                                    
                      echo '<a class="btn btn-success" href="'.$href.'">'.$i.'</a>';
                 }
                              
   ?>
        </div>
   
        <table class="table table-striped">
            <thead>
            <tr>
              <th scope="col">Numero</th>
              <th scope="col">Tire du livre</th>
              <th scope="col">Auteur</th>
              <th scope="col">Année de publication</th>
              <th scope="col">Categorie</th>
              <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
                    
                    $num=0;
                     while ($affichage=$req->fetch()) {
                      $num++;
                      ?>
            <tr>
              <td><?php echo $num?></td>
              <td><?php echo $affichage[1]?></td>
              <td><?php echo $affichage[2]?></td>
              <td><?php echo $affichage[3]?></td>
              <td><?php echo $affichage[4]?></td>
              
              <td><a href="livre.php?idModif=<?php echo $affichage[0]?>" class="btn btn-success">Modifier</a>
              <a href="traitement/supprimer.php?IdSup=<?php echo $affichage[0]?>" onclick="return confirm('Voulez-vous vraiment supprimer?')" class="btn btn-danger">Supprimer</a></td>
            
            <?php
                   }
                   ?>
            </tbody>
          </table>
    </div>
    <script src=""></script>
</body>
</html>