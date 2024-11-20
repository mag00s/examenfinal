// controllers/EnlacesController.php
/**
 * Controlador de Enlaces
 * Maneja las peticiones relacionadas con los enlaces y coordina el flujo de datos
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
        
        // Incluye las vistas necesarias
        require_once 'views/layouts/header.php';
        require_once 'views/enlaces/search.php';
        require_once 'views/layouts/footer.php';
    }
}