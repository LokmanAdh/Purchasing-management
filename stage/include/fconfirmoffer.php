<?php

session_start();
require_once('delivery.php');
require_once('order.php');
require_once('fournisseur.php');
require_once('offer.php');

$id = $_GET['id'];




Offer::updatestatus($id,"Confirmed");

$delivery = new Delivery($id,"Waiting");

$delivery->save();


header('location: ../fconfirmoffertable.php');




?>