<?php

session_start();
require_once('user.php');
require_once('stock.php');
require_once('fournisseur.php');
require_once('stocksortie.php');


$ref = $_GET['ref'];
$id = $_GET['id'];
$date = $_GET['date'];



Stocksortie::delete($ref,$id,$date);

header('location: ../stocksortietable.php');




?>