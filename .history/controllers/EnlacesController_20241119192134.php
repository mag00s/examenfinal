<?php
require_once 'models/ModelBBDD.php';

class EnlacesController {
    private $model;

    public function __construct() {
        $this->model = new ModelBBDD();
    }

    public function index() {
        $results = [];
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
        $query = isset($_GET['q']) ? $_GET['q'] : '';
        
        if ($tipo && $query) {
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
        } elseif ($tipo === 'lenguaje') {
            $results = $this->model->getLinksByLanguage();
        }
        
        require_once 'views/enlaces.php';
    }
}