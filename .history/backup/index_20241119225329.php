<?php
/**
 * Archivo: index.php
 * Descripción: Punto de entrada principal de la aplicación
 * 
 * Ubicación: /index.php
 * Autor: mag00s
 * Fecha: 19/11/2024
 */

require_once __DIR__ . '/router/Router.php';

// Iniciar el enrutador
$router = new Router();
$router->route();