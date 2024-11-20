<?php
require_once './models/ModelBBDD.php';

class EnlacesController {
    private $model;

    public function __construct() {
        $this->model = new ModelBBDD();
    }

    public function index() {
        $tipo = $_GET['tipo'] ?? 'categoria';
        $query = $_GET['q'] ?? '';
        $categories = $this->model->getCategories();
        
        if ($tipo === 'categoria' && empty($query) && !empty($categories)) {
            $query = $categories[0]['categoria'];
        }
        
        $results = [];
        if (!empty($tipo)) {
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
        }
        
        require_once './views/enlaces.php';
    }
}