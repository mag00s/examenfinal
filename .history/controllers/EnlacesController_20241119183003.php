<?php
/**
 * EnlacesController.php
 * Controlador principal que maneja las peticiones relacionadas con enlaces
 */

class EnlacesController {
    private $enlaces;

    public function __construct() {
        $db = Database::getInstance()->getConnection();
        $this->enlaces = new Enlaces($db);
    }

    /**
     * Maneja la búsqueda y muestra de resultados
     */
    public function search() {
        $searchTerm = $_GET['q'] ?? '';
        $searchType = $_GET['type'] ?? 'titulo';
        
        $results = $this->enlaces->search($searchTerm, $searchType);
        
        require_once 'views/layouts/header.php';
        require_once 'views/enlaces/search.php';
        require_once 'views/layouts/footer.php';
    }
}