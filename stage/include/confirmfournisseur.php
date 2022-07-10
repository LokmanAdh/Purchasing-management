<?php

session_start();
require_once('user.php');
require_once('chef.php');
require_once('fournisseur.php');
require_once('admin.php');

if(isset($_POST['addfournisseur'])){
    $nom = $_POST['nom'];
    $address = $_POST['address'];
    $tele = $_POST['tele'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $idcategory = $_POST['category'];


    $file = $_FILES['file'];

        $filename = $file['name'];
        $filetmpname = $file['tmp_name'];
        $filesize = $file['size'];
        $filetype = $file['type'];


        $filext = explode(".",$filename);
        $fileExt = end($filext);
        $image=$email.".".$fileExt;

        if(User::counte($email)>0||Chef::counte($email)>0||Fournisseur::counte($email)>0){
            header('location:../addfournisseur.php?errornum=1');
        }else if(User::countp($tele)>0||Chef::countp($tele)>0||Fournisseur::countp($tele)>0){
            header('location:../addfournisseur.php?errornum=2');
        }else{
            move_uploaded_file($filetmpname,$_SERVER['DOCUMENT_ROOT']."/stage/img/fournisseur/".$image);
        $fournisseur = new Fournisseur($nom,$address,$tele,$email,$password,$image,$idcategory);
        $fournisseur->save();

        header('location: ../fournisseurtable.php');
        }
        
        
}

if(isset($_POST['updatefournisseur'])){
    $nom = $_POST['nom'];
    $address = $_POST['address'];
    $tele = $_POST['tele'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $idcategory = $_POST['category'];

    $oldemail = $_SESSION['oldemail'];
    $oldimage = $_SESSION['oldimage'];

    $file = $_FILES['file'];

        $filename = $file['name'];
        $filetmpname = $file['tmp_name'];
        $filesize = $file['size'];
        $filetype = $file['type'];


        $filext = explode(".",$filename);
        $fileExt = end($filext);
        $image=$email.".".$fileExt;

        if(User::counte($email)>0||Fournisseur::counte2($email,$oldemail)>0){
            header('location:../updatefournisseur.php?errornum=1');
        }else if(User::countp($tele)>0||Fournisseur::countp2($tele,$oldemail)>0){
            header('location:../updatefournisseur.php?errornum=2');
        }else{
            $path = $_SERVER['DOCUMENT_ROOT']."/stage/img/fournisseur/".$oldimage;
        unlink($path);
        $fournisseur = new Fournisseur($nom,$address,$tele,$email,$password,$image,$idcategory);
        $fournisseur->update($oldemail);
        move_uploaded_file($filetmpname,$_SERVER['DOCUMENT_ROOT']."/stage/img/fournisseur/".$image);

        header('location: ../fournisseurtable.php');
        }

        
}



?>