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
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar el enrutador
$router = new Router();
$router->route();