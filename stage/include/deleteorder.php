<?php

session_start();
require_once('user.php');
require_once('order.php');
require_once('fournisseur.php');
require_once('admin.php');

$id = $_GET['id'];
$image = $_GET['img'];


$path = $_SERVER['DOCUMENT_ROOT']."/stage/img/order/".$image;
Order::delete($id);
unlink($path);

header('location: ../ordertable.php');




?>