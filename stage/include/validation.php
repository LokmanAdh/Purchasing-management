<?php

session_start();
require_once('user.php');
require_once('chef.php');
require_once('fournisseur.php');
require_once('admin.php');

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $count = User::count($email,$password);
    $count3 = Fournisseur::count($email,$password);
    $count4 = Admin::count($email,$password);

    if($count == 1){
        $user = User::getOne($email,$password);
        if($user->role == "user"){
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $user->id;
            $_SESSION['nom'] = $user->nom;
            $_SESSION['prenom'] = $user->prenom;
            $_SESSION['image'] = $user->image;
            $_SESSION['role'] = $user->role;
            header('location: ../homeu.php');

        }else{
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $user->id;
            $_SESSION['nom'] = $user->nom;
            $_SESSION['prenom'] = $user->prenom;
            $_SESSION['image'] = $user->image;
            $_SESSION['role'] = $user->role;
            header('location: ../homec.php');
        }
        
        
    }else if($count3 == 1){
        $fournisseur = Fournisseur::getOne($email,$password);
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $fournisseur->id;
        $_SESSION['nom'] = $fournisseur->nom;
        $_SESSION['image'] = $fournisseur->image;
        $_SESSION['role'] = "fournisseur";
        header('location: ../homef.php');
    }else if($count4 == 1){
        $admin = Admin::getOne($email,$password);
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $admin->id;
        $_SESSION['nom'] = $admin->nom;
        $_SESSION['prenom'] = $admin->prenom;
        $_SESSION['image'] = $admin->image;
        $_SESSION['role'] = "admin";
        header('location: ../homead.php');
    }else{
        header('location:../login.php?errornum=1');
    }

}



?>