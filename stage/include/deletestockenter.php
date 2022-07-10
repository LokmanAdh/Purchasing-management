<?php

session_start();
require_once('user.php');
require_once('stock.php');
require_once('fournisseur.php');
require_once('stockenter.php');


$ref = $_GET['ref'];
$id = $_GET['id'];
$date = $_GET['date'];



Stockenter::delete($ref,$id,$date);

header('location: ../stockentertable.php');




?>