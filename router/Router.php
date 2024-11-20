<?php
/**
 * Clase: Router
 * Descripción: Enrutador principal de la aplicación de enlaces
 * 
 * Ubicación: /router/Router.php
 * Autor: mag00s
 * Fecha: 19/11/2024
 * 
 * Propósito:
 * - Gestionar las rutas de la aplicación
 * - Direccionar las peticiones al controlador correspondiente
 * - Manejar errores de rutas no existentes
 */

require_once __DIR__ . '/../controllers/ViewController.php';

class Router {
    private $controller;
    private $method;

    public function __construct() {
        $this->controller = new ViewController();
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Procesa la petición actual y llama al método correspondiente
     */
    public function route() {
        // Obtener la ruta de la URL
        $uri = $_SERVER['REQUEST_URI'];
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = trim($uri, '/');
        
        // Si no hay ruta, mostrar página principal
        if(empty($uri)) {
            $this->controller->index();
            return;
        }

        // Procesar según el método HTTP y la ruta
        switch($this->method) {
            case 'GET':
                $this->handleGet($uri);
                break;
            
            case 'POST':
                $this->handlePost($uri);
                break;
            
            default:
                $this->controller->error404();
        }
    }

    /**
     * Maneja las peticiones GET
     * @param string $uri Ruta solicitada
     */
    private function handleGet($uri) {
        switch($uri) {
            case 'buscar':
                $this->controller->buscar();
                break;
            
            default:
                $this->controller->error404();
        }
    }

    /**
     * Maneja las peticiones POST
     * @param string $uri Ruta solicitada
     */
    private function handlePost($uri) {
        switch($uri) {
            case 'buscar':
                $this->controller->buscar();
                break;
            
            default:
                $this->controller->error404();
        }
    }
}