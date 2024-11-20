<?php
/**
 * Clase: ViewController
 * Descripción: Controlador principal para gestionar las vistas y peticiones
 * 
 * Ubicación: /controllers/ViewController.php
 * Autor: mag00s
 * Fecha: 19/11/2024
 * 
 * Propósito:
 * - Procesar peticiones del usuario
 * - Gestionar la lógica de búsqueda
 * - Renderizar las vistas correspondientes
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
        require_once __DIR__ . '/../views/index.php';
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

        // Si es una petición AJAX, devolvemos solo los resultados
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode([
                'resultados' => $resultados,
                'tipoBusqueda' => $tipoBusqueda
            ]);
            exit;
        }

        // Si no es AJAX, cargamos la vista completa
        require_once __DIR__ . '/../views/results.php';
    }

    /**
     * Maneja errores 404
     */
    public function error404() {
        header("HTTP/1.0 404 Not Found");
        echo "Página no encontrada";
    }
}