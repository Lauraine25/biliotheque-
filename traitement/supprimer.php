<?php
include("../connexion/connexion.php");
    if(isset($_GET["IdSup"])&& !empty($_GET["IdSup"])){
        $id=$_GET["IdSup"];
            $req=$connexion->prepare("DELETE from livre where id=?");
            $test=$req->execute([$id]);
            if($test==true){
                $_SESSION['message']="suppression reussie";
               header("Location: ../index.php");
            }
            else {
                header("Location: ../index.php");
            }
        }else{
            header("Location: ../index.php");
        }
