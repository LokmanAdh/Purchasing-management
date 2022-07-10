<?php

session_start();
require_once('user.php');
require_once('order.php');
require_once('Delivery.php');
require_once('admin.php');

$id = $_GET['id'];




Delivery::updatestatus($id,"Received");


header('location: ../deliverytable.php');




?>