<?php

session_start();
require_once('user.php');
require_once('order.php');
require_once('fournisseur.php');
require_once('offer.php');

$id = $_GET['id'];



Offer::delete($id);


header('location: ../foffertable.php');




?>