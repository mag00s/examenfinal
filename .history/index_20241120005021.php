<?php
require_once __DIR__ . '/controllers/ViewController.php';

$controller = new ViewController();
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch($action) {
    case 'buscar':
        $controller->buscar();
        break;
    default:
        $controller->index();
}