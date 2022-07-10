<?php

session_start();
require_once('order.php');
require_once('chef.php');
require_once('fournisseur.php');
require_once('admin.php');

if(isset($_POST['addorder'])){
    $quantite = $_POST['quantite'];
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $idcategory = $_POST['category'];
    $state = "Not Confirmed" ;
    $id = $_SESSION['id'] ;

    $file = $_FILES['file'];

        $filename = $file['name'];
        $filetmpname = $file['tmp_name'];
        $filesize = $file['size'];
        $filetype = $file['type'];


        $filext = explode(".",$filename);
        $fileExt = end($filext);
        $rand = uniqid();
        $image=$rand.".".$fileExt;


        move_uploaded_file($filetmpname,$_SERVER['DOCUMENT_ROOT']."/stage/img/order/".$image);
        $order = new Order($libelle,$description,$quantite,$image,$idcategory,$state,$id);
        $order->save();header('location: ../ordertable.php');
    
}

if(isset($_POST['updateorder'])){
    $quantite = $_POST['quantite'];
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $idcategory = $_POST['category'];
    $state = "Not Confirmed" ;
    $id = $_SESSION['id'] ;



    $oldid = $_SESSION['oldid'];
    $oldimage = $_SESSION['oldimage'];

    $file = $_FILES['file'];

        $filename = $file['name'];
        $filetmpname = $file['tmp_name'];
        $filesize = $file['size'];
        $filetype = $file['type'];


        $filext = explode(".",$filename);
        $fileExt = end($filext);
        $rand = uniqid();
        $image=$rand.".".$fileExt;


        $path = $_SERVER['DOCUMENT_ROOT']."/stage/img/order/".$oldimage;
        unlink($path);
        $order = new Order($libelle,$description,$quantite,$image,$idcategory,$state,$id);
        $order->update($oldid);
        move_uploaded_file($filetmpname,$_SERVER['DOCUMENT_ROOT']."/stage/img/order/".$image);

        header('location: ../ordertable.php');


        
}



?>