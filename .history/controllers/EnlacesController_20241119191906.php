<?php
require_once 'models/ModelBBDD.php';

class EnlacesController {
    private $model;

    public function __construct() {
        $this->model = new ModelBBDD();
    }

    public function index() {
        $results = [];
        $categories = $this->model->getCategories();
        
        if (isset($_GET['tipo'])) {
            $tipo = $_GET['tipo'];
            $query = isset($_GET['q']) ? $_GET['q'] : '';
            
            switch($tipo) {
                case 'categoria':
                    $results = $this->model->getLinksByCategory($query);
                    break;
                case 'lenguaje':
                    $results = $this->model->getLinksByLanguage();
                    break;
                case 'titulo':
                    $results = $this->model->searchByTitle($query);
                    break;
            }
        } else {
            $results = $this->model->getAllLinks();
        }
        
        require_once 'views/enlaces.php';
    }
}