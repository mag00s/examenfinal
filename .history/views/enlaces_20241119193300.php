<?php
require_once 'models/ModelBBDD.php';

class EnlacesController {
    private $model;

    public function __construct() {
        $this->model = new ModelBBDD();
    }

    public function index() {
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'categoria';
        $query = isset($_GET['q']) ? $_GET['q'] : '';
        $results = [];
        $categories = $this->model->getCategories();
        
        if ($tipo === 'categoria' && !$query && !empty($categories)) {
            $query = $categories[0]['categoria'];
        }
        
        if ($tipo && ($query || $tipo === 'lenguaje')) {
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
        
        require_once 'views/enlaces.php';
    }
}