<?php
require_once 'models/ModelBBDD.php';

class EnlacesController {
    private $model;

    public function __construct() {
        $this->model = new ModelBBDD();
    }

    public function index() {
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
        $query = isset($_GET['q']) ? $_GET['q'] : '';
        $results = [];
        $categories = $this->model->getCategories();
        
        // Debug info
        error_log("Search type: " . $tipo);
        error_log("Search query: " . $query);
        
        if ($tipo && ($query || $tipo === 'lenguaje')) {
            switch($tipo) {
                case 'categoria':
                    $results = $this->model->getLinksByCategory($query);
                    error_log("Category search results: " . count($results));
                    break;
                case 'lenguaje':
                    $results = $this->model->getLinksByLanguage();
                    error_log("Language search results: " . count($results));
                    break;
                case 'titulo':
                    $results = $this->model->searchByTitle($query);
                    error_log("Title search results: " . count($results));
                    break;
            }
        }
        
        require_once 'views/enlaces.php';
    }
}