<?php
require_once './models/ModelBBDD.php';

class EnlacesController {
    private $model;

    public function __construct() {
        $this->model = new ModelBBDD();
    }

    public function index() {
        // Get the basic data
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'categoria';
        $query = isset($_GET['q']) ? $_GET['q'] : '';
        
        // Get categories for the dropdown
        $categories = $this->model->getCategories();
        
        // Set default category if none selected
        if ($tipo === 'categoria' && empty($query) && !empty($categories)) {
            $query = $categories[0]['categoria'];
        }

        // Get results based on search type
        $results = $this->getSearchResults($tipo, $query);
        
        // Pass all necessary data to view
        $viewData = [
            'tipo' => $tipo,
            'query' => $query,
            'categories' => $categories,
            'results' => $results
        ];
        
        extract($viewData);
        require_once './views/enlaces.php';
    }

    private function getSearchResults($tipo, $query) {
        if (empty($tipo)) return [];

        switch($tipo) {
            case 'categoria':
                return $this->model->getLinksByCategory($query);
            case 'lenguaje':
                return $this->model->getLinksByLanguage();
            case 'titulo':
                return $this->model->searchByTitle($query);
            default:
                return [];
        }
    }
}