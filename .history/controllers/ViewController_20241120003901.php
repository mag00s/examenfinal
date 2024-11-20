<?php
/**
 * Controlador: ViewController
 * Ubicación: /controllers/ViewController.php
 * Autor: mag00s
 * Fecha: 19/11/2024
 */

require_once __DIR__ . '/../models/ModelBBDD.php';

class ViewController {
    private $model;
    
    public function __construct() {
        $this->model = new ModelBBDD();
    }

    /**
     * Muestra la página principal
     */
    public function index() {
        $categorias = $this->model->getCategorias();
        require_once __DIR__ . '/../views/index.php';  // Fixed path
    }

    /**
     * Procesa la búsqueda y muestra resultados
     */
    public function buscar() {
        $resultados = [];
        $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
        $valor = isset($_POST['valor']) ? trim($_POST['valor']) : '';

        switch($tipo) {
            case 'categoria':
                $resultados = $this->model->buscarPorCategoria($valor);
                $tipoBusqueda = "Categoría: $valor";
                break;
            case 'lenguaje':
                $resultados = $this->model->getLenguajes();
                $tipoBusqueda = "Lenguajes de Programación";
                break;
            case 'titulo':
                $resultados = $this->model->buscarPorTitulo($valor);
                $tipoBusqueda = "Búsqueda por título: $valor";
                break;
            default:
                $resultados = $this->model->getTodos();
                $tipoBusqueda = "Todos los enlaces";
        }

        require_once __DIR__ . '/../views/results.php';  // Fixed path
    }
}