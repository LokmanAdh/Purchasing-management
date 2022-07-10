<?php

session_start();
require_once('user.php');
require_once('order.php');
require_once('Delivery.php');
require_once('admin.php');

$id = $_GET['id'];




Order::updatestatus($id,"Confirmed");


header('location: ../chefconfirmordertable.php');




?>