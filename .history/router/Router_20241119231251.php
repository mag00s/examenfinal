<?php
/**
 * Clase: Router
 * Descripción: Enrutador principal de la aplicación de enlaces
 * 
 * Ubicación: /router/Router.php
 * Autor: mag00s
 * Fecha: 19/11/2024
 */

require_once __DIR__ . '/../controllers/ViewController.php';  // This is correct now!

class Router {
    private $controller;
    private $method;

    public function __construct() {
        $this->controller = new ViewController();  // And this matches
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
    
    // ... rest of the router code remains the same