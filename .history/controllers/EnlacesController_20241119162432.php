<?php
require_once "../config/Database.php";
require_once "../models/ModelBBDD.php";

class EnlacesController {
    private $model;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new ModelBBDD($db);
    }

    public function displayEnlaces() {
        $enlaces = $this->model->getAllEnlaces();
        include_once "../views/enlaces.php";
    }

    public function searchEnlaces($category) {
        $results = $this->model->searchByCategory($category);
        include_once "../views/enlaces.php";
    }
}

if (isset($_GET['category'])) {
    $controller = new EnlacesController();
    $controller->searchEnlaces($_GET['category']);
} else {
    $controller = new EnlacesController();
    $controller->displayEnlaces();
}
?>
