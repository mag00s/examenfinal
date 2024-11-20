<?php
require_once 'models/ModelBBDD.php';

class EnlacesController {
    private $model;

    public function __construct() {
        $this->model = new ModelBBDD();
    }

    public function index() {
        $links = $this->model->getAllLinks();
        $categories = $this->model->getCategories();
        require_once 'views/enlaces.php';
    }

    public function search() {
        $results = [];
        $categories = $this->model->getCategories();
        
        if (isset($_GET['tipo']) && isset($_GET['q'])) {
            switch($_GET['tipo']) {
                case 'categoria':
                    $results = $this->model->getLinksByCategory($_GET['q']);
                    break;
                case 'lenguaje':
                    $results = $this->model->getLinksByLanguage();
                    break;
                case 'titulo':
                    $results = $this->model->searchByTitle($_GET['q']);
                    break;
            }
        }
        
        require_once 'views/enlaces.php';
    }
}