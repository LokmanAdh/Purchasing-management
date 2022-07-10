<?php

session_start();
require_once('user.php');
require_once('chef.php');
require_once('fournisseur.php');
require_once('admin.php');

$email = $_GET['email'];
$image = $_GET['img'];


$path = $_SERVER['DOCUMENT_ROOT']."/stage/img/fournisseur/".$image;
Fournisseur::delete($email);
unlink($path);

header('location: ../fournisseurtable.php');




?>