<?php

session_start();
require_once('offer.php');
require_once('chef.php');
require_once('fournisseur.php');
require_once('admin.php');

if(isset($_POST['addoffer'])){
    $quantite = $_POST['quantite'];
    $prixunitaire = $_POST['prixunitaire'];
    $datedelivery = $_POST['datedelivery'];
    $latedatedelivery = $_POST['latedatedelivery'];
    $state = "Not Accepted" ;
    $id = $_SESSION['id'] ;
    $idorder = $_SESSION['orderid'] ;
    $dt = date('Y-m-d');

    if($dt > $datedelivery || $datedelivery > $latedatedelivery ){
        header('location:../addoffer.php?errornum=1');
    }else{
        $offer = new Offer($quantite,$prixunitaire,$datedelivery,$latedatedelivery,$state,$idorder,$id);
        $offer->save();header('location: ../foffertable.php');
    }
        
    
}

if(isset($_POST['updateoffer'])){
    $quantite = $_POST['quantite'];
    $prixunitaire = $_POST['prixunitaire'];
    $datedelivery = $_POST['datedelivery'];
    $latedatedelivery = $_POST['latedatedelivery'];
    $state = "Not Accepted" ;
    $id = $_SESSION['id'] ;
    $idorder = $_SESSION['orderid'] ;
    $ofr = $_SESSION['idoff'];
    $dt = date('Y-m-d');

    if($dt > $datedelivery || $datedelivery > $latedatedelivery ){
        header('location:../updateoffer.php?errornum=1');
    }else{
        $offer = new Offer($quantite,$prixunitaire,$datedelivery,$latedatedelivery,$state,$idorder,$id);
        $offer->update($ofr);header('location: ../foffertable.php');
    }


        
}



?>