<?php

session_start();
require_once('stock.php');
require_once('chef.php');
require_once('user.php');
require_once('admin.php');
require_once('stocksortie.php');

if(isset($_POST['addstocksortie'])){
    $email = $_POST['email'];
    $date = $_POST['date'];
    $quantite = $_POST['quantite'];
    $ref = $_SESSION['pref'];

    
    $stock = Stock::getOne($ref);

    if($quantite > $stock->quantite){
        header('location:../addstocksortie.php?errornum=2');
    }else if(User::counte($email)==0){
        header('location:../addstocksortie.php?errornum=3');
    }else{
        $user = User::getOne3($email);
        if(Stocksortie::count($ref,$user->id,$date)>0){
            header('location:../addstocksortie.php?errornum=1');
        }else{
            $stocksortie = new Stocksortie($ref,$user->id,$date,$quantite);
            $stocksortie->save();
        
            header('location: ../stocksortietable.php'); 
        }
    }

}

if(isset($_POST['updatestocksortie'])){
    $email = $_POST['email'];
    $date = $_POST['date'];
    $quantite = $_POST['quantite'];

    



    $oldref = $_SESSION['oldref'];
    $oldid = $_SESSION['oldid'];
    $olddate = $_SESSION['olddate'];
    $oldquantite = $_SESSION['oldquantite'];
    $stock = Stock::getOne($oldref);

    if($quantite > $stock->quantite + $oldquantite){
        header('location:../updatestocksortie.php?errornum=2');
    }else if(User::counte($email)==0){
        header('location:../updatestocksortie.php?errornum=3');
    }else{
        $user = User::getOne3($email);
        $count = Stocksortie::count($oldref,$user->id,$date);
        $st = Stocksortie::getone($oldref,$user->id,$date);
        if($count >0 && ($st->id!=$oldid || $st->date!=$olddate)){
            header('location:../updatestocksortie.php?errornum=1');
        }else{
           $stocksortie = new Stocksortie($oldref,$user->id,$date,$quantite);
            $stocksortie->update($oldref,$oldid,$olddate);
        
            header('location: ../stocksortietable.php'); 
        }
    }


}



?>