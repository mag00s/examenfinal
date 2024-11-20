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

    public function searchByCategory($category) {
        $results = $this->model->searchByCategory("%$category%");
        include_once "../views/enlaces.php";
    }

    public function searchByLanguage($language) {
        $results = $this->model->searchByLanguage("%$language%");
        include_once "../views/enlaces.php";
    }

    public function searchByTitle($keyword) {
        $results = $this->model->searchByTitle("%$keyword%");
        include_once "../views/enlaces.php";
    }

    public function displayAll() {
        $results = $this->model->getAllEnlaces();
        include_once "../views/enlaces.php";
    }
}

if (isset($_GET['category'])) {
    $controller = new EnlacesController();
    $controller->searchByCategory($_GET['category']);
} elseif (isset($_GET['language'])) {
    $controller = new EnlacesController();
    $controller->searchByLanguage($_GET['language']);
} elseif (isset($_GET['keyword'])) {
    $controller = new EnlacesController();
    $controller->searchByTitle($_GET['keyword']);
} else {
    $controller = new EnlacesController();
    $controller->displayAll();
}
?>
