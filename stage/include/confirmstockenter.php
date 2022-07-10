<?php

session_start();
require_once('stock.php');
require_once('chef.php');
require_once('fournisseur.php');
require_once('admin.php');
require_once('stockenter.php');

if(isset($_POST['addstockenter'])){
    $email = $_POST['email'];
    $date = $_POST['date'];
    $quantite = $_POST['quantite'];
    $prixunitaire = $_POST['prixunitaire'];
    $ref = $_SESSION['pref'];

    if(Fournisseur::counte($email)==0){
        header('location:../addstockenter.php?errornum=2');
    }else{
        $fournisseur = Fournisseur::getOne3($email);
        if(Stockenter::count($ref,$fournisseur->id,$date)>0){
            header('location:../addstockenter.php?errornum=1');
        }else{
            $stockenter = new Stockenter($ref,$fournisseur->id,$date,$quantite,$prixunitaire);
            $stockenter->save();
    
            header('location: ../stockentertable.php');
        }
    }

}

if(isset($_POST['updatestockenter'])){
    $email = $_POST['email'];
    $date = $_POST['date'];
    $quantite = $_POST['quantite'];
    $prixunitaire = $_POST['prixunitaire'];

    


    $oldref = $_SESSION['oldref'];
    $oldid = $_SESSION['oldid'];
    $olddate = $_SESSION['olddate'];

    if(Fournisseur::counte($email)==0){
        header('location:../updatestockenter.php?errornum=2');
    }else{
        $fournisseur = Fournisseur::getOne3($email);
        $count = Stockenter::count($oldref,$fournisseur->id,$date);
        $stock = Stockenter::getone($oldref,$fournisseur->id,$date);
        if($count >0 && ($stock->id!=$oldid || $stock->date!=$olddate)){
            header('location:../updatestockenter.php?errornum=1');
        }else{
            $stockenter = new Stockenter($oldref,$fournisseur->id,$date,$quantite,$prixunitaire);
            $stockenter->update($oldref,$oldid,$olddate);
        
            header('location: ../stockentertable.php');
        }
    }


}



?>