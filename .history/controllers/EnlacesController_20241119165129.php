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

    public function handleQuery($queryType, $term) {
        $results = [];
        switch ($queryType) {
            case 'category':
                $results = $this->model->searchByCategory("%$term%");
                break;
            case 'language':
                $results = $this->model->searchByLanguage("%$term%");
                break;
            case 'keyword':
                $results = $this->model->searchByTitle("%$term%");
                break;
        }
        include_once "../views/enlaces.php";
    }
}

if (isset($_GET['query']) && isset($_GET['term'])) {
    $controller = new EnlacesController();
    $controller->handleQuery($_GET['query'], $_GET['term']);
} else {
    $controller = new EnlacesController();
    $controller->displayAll();
}
?>
