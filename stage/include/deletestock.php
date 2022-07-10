<?php

session_start();
require_once('user.php');
require_once('stock.php');
require_once('fournisseur.php');
require_once('admin.php');

$refe = $_GET['ref'];
$image = $_GET['img'];


$path = $_SERVER['DOCUMENT_ROOT']."/stage/img/stock/".$image;
Stock::delete($refe);
unlink($path);

header('location: ../stocktable.php');




?>