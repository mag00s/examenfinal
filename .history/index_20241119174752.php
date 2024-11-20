<?php
require_once "config/Database.php";
require_once "models/ModelBBDD.php";
require_once "controllers/EnlacesController.php";

$controller = new EnlacesController();
$controller->handleRequest();
?>
