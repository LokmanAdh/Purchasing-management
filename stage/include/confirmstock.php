<?php

session_start();
require_once('stock.php');
require_once('chef.php');
require_once('fournisseur.php');
require_once('admin.php');

if(isset($_POST['addstock'])){
    $ref = $_POST['ref'];
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $idcategory = $_POST['category'];
    


    $file = $_FILES['file'];

        $filename = $file['name'];
        $filetmpname = $file['tmp_name'];
        $filesize = $file['size'];
        $filetype = $file['type'];


        $filext = explode(".",$filename);
        $fileExt = end($filext);
        $image=$ref.".".$fileExt;

        if(Stock::count($ref)==0){
           move_uploaded_file($filetmpname,$_SERVER['DOCUMENT_ROOT']."/stage/img/stock/".$image);
        $stock = new Stock($ref,$libelle,$description,$image,$idcategory);
        $stock->save();header('location: ../stocktable.php');
        }else{
             header('location:../addstock.php?errornum=1');
        }
        
        

        
}

if(isset($_POST['updatestock'])){
    $ref = $_POST['ref'];
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $idcategory = $_POST['category'];


    $oldref = $_SESSION['oldref'];
    $oldimage = $_SESSION['oldimage'];

    $file = $_FILES['file'];

        $filename = $file['name'];
        $filetmpname = $file['tmp_name'];
        $filesize = $file['size'];
        $filetype = $file['type'];


        $filext = explode(".",$filename);
        $fileExt = end($filext);
        $image=$ref.".".$fileExt;

        if(Stock::count2($ref,$oldref)==0){
            $path = $_SERVER['DOCUMENT_ROOT']."/stage/img/stock/".$oldimage;
        unlink($path);
        $stock = new Stock($ref,$libelle,$description,$image,$idcategory);
        $stock->update($oldref);
        move_uploaded_file($filetmpname,$_SERVER['DOCUMENT_ROOT']."/stage/img/stock/".$image);

        header('location: ../stocktable.php');
        }else{
            header('location:../updatestock.php?errornum=1');
        }

        
}



?>