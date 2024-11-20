// models/Enlaces.php
/**
 * Modelo Enlaces
 * Gestiona todas las operaciones relacionadas con los enlaces en la base de datos
 */
class Enlaces {
    private $conn;
    private $table = 'vista_enlaces';

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Busca enlaces según criterios especificados
     * @param string $searchTerm Término de búsqueda
     * @param string $searchType Tipo de búsqueda (titulo, categoria, tipo)
     * @return PDOStatement
     */
    public function search($searchTerm = '', $searchType = 'titulo') {
        $query = "SELECT * FROM " . $this->table;
        
        if (!empty($searchTerm)) {
            $query .= " WHERE ";
            switch($searchType) {
                case 'titulo':
                    $query .= "titulo LIKE :search";
                    break;
                case 'categoria':
                    $query .= "nombre_categoria LIKE :search";
                    break;
                case 'tipo':
                    $query .= "tipo_categoria LIKE :search";
                    break;
            }
        }

        $stmt = $this->conn->prepare($query);
        
        if (!empty($searchTerm)) {
            $searchTerm = "%{$searchTerm}%";
            $stmt->bindParam(":search", $searchTerm);
        }
        
        $stmt->execute();
        return $stmt;
    }
}