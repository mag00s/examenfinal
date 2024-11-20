<?php
require_once 'controllers/EnlacesController.php';

$controller = new EnlacesController();

if (isset($_GET['tipo'])) {
    $controller->search();
} else {
    $controller->index();
}