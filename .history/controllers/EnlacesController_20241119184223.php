<?php
/**
 * Ubicación: enlaces-project/controllers/EnlacesController.php
 */

class EnlacesController {
    private $model;

    public function __construct() {
        $db = Database::getInstance()->getConnection();
        $this->model = new ModeloBDD($db);
    }

    public function buscarGeneral() {
        $tipo = $_GET['tipo'] ?? 'titulo';
        $query = $_GET['q'] ?? '';
        $resultados = $this->model->buscarGeneral($query, $tipo);
        
        require_once 'views/layouts/header.php';
        require_once 'views/enlaces.php';
        require_once 'views/layouts/footer.php';
    }

    public function buscarEspecifico() {
        $tipo = $_GET['tipo'] ?? '';
        $query = $_GET['q'] ?? '';
        
        if ($tipo === 'categoria') {
            $resultados = $this->model->buscarPorCategoria($query);
        } elseif ($tipo === 'lenguaje') {
            $resultados = $this->model->buscarPorLenguaje($query);
        } else {
            $resultados = $this->model->buscarGeneral($query, 'titulo');
        }

        $categorias = $this->model->getCategorias();
        $lenguajes = $this->model->getLenguajes();
        
        require_once 'views/layouts/header.php';
        require_once 'views/enlaces.php';
        require_once 'views/layouts/footer.php';
    }
}