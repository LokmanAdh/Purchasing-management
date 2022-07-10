<?php

session_start();
require_once('user.php');
require_once('chef.php');
require_once('fournisseur.php');
require_once('admin.php');


if(isset($_POST['adduser'])){

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $address = $_POST['address'];
    $tele = $_POST['tele'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    $file = $_FILES['file'];

        $filename = $file['name'];
        $filetmpname = $file['tmp_name'];
        $filesize = $file['size'];
        $filetype = $file['type'];


        $filext = explode(".",$filename);
        $fileExt = end($filext);
        $image=$role."/".$email.".".$fileExt;

        if(User::counte($email)>0||Fournisseur::counte($email)>0){
            header('location:../adduser.php?errornum=1');
        }else if(User::countp($tele)>0||Fournisseur::countp($tele)>0){
            header('location:../adduser.php?errornum=2');
        }else{

            move_uploaded_file($filetmpname,$_SERVER['DOCUMENT_ROOT']."/stage/img/".$image);
            $user = new User($nom,$prenom,$address,$tele,$email,$password,$image,$role);
            $user->save();
            header('location: ../usertable.php');
        }

        
}

if(isset($_POST['updateuser'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $address = $_POST['address'];
    $tele = $_POST['tele'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $oldrole = $_SESSION['oldrole'];
    $oldemail = $_SESSION['oldemail'];
    $oldimage = $_SESSION['oldimage'];

    $file = $_FILES['file'];

        $filename = $file['name'];
        $filetmpname = $file['tmp_name'];
        $filesize = $file['size'];
        $filetype = $file['type'];


        $filext = explode(".",$filename);
        $fileExt = end($filext);
        $image=$role."/".$email.".".$fileExt;

            if(User::counte2($email,$oldemail)>0||Fournisseur::counte($email)>0){
                header('location:../updateuser.php?errornum=1');
            }else if(User::countp2($tele,$oldemail)>0||Fournisseur::countp($tele)>0){
                header('location:../updateuser.php?errornum=2');
            }else{
                $path = $_SERVER['DOCUMENT_ROOT']."/stage/img/".$oldimage;
                    unlink($path);
                    $user = new User($nom,$prenom,$address,$tele,$email,$password,$image,$role);
                    $user->update($oldemail);
                    move_uploaded_file($filetmpname,$_SERVER['DOCUMENT_ROOT']."/stage/img/".$image);
                    header('location: ../usertable.php');
            }


        
}



?>