<?php
require_once './models/ModelBBDD.php';

class EnlacesController {
    private $model;

    public function __construct() {
        $this->model = new ModelBBDD();
    }

    public function index() {
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'categoria';
        $query = isset($_GET['q']) ? $_GET['q'] : '';
        
        // Get all categories for the dropdown
        $categories = $this->model->getCategories();
        
        // Get search results
        $results = [];
        if (!empty($categories)) {
            if (empty($query) && $tipo === 'categoria') {
                // If no category selected, use first one
                $query = $categories[0]['categoria'];
            }
            
            switch($tipo) {
                case 'categoria':
                    $results = $this->model->getLinksByCategory($query);
                    break;
                case 'lenguaje':
                    $results = $this->model->getLinksByLanguage();
                    break;
                case 'titulo':
                    if(!empty($query)) {
                        $results = $this->model->searchByTitle($query);
                    }
                    break;
            }
        }

        // Debug info
        error_log('Search Type: ' . $tipo);
        error_log('Search Query: ' . $query);
        error_log('Categories Count: ' . count($categories));
        error_log('Results Count: ' . count($results));
        
        require_once './views/enlaces.php';
    }
}