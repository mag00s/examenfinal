<?php
/**
 * Clase ProductoController
 * 
 * Controlador que maneja las peticiones relacionadas con productos.
 * Implementa el patrón MVC, actuando como intermediario entre el
 * modelo (ModelBBDD) y la vista (index.php)
 * 
 * @author mag00s
 * @version 1.0
 */
class ProductoController {
    private $model;

    /**
     * Constructor del controlador
     * 
     * @param PDO $db Conexión a la base de datos
     */
    public function __construct($db) {
        $this->model = new ModelBBDD($db);
    }

    /**
     * Procesa las búsquedas según el tipo seleccionado
     * 
     * @param string $tipo Tipo de búsqueda (fabricante, tipo, precio)
     * @param string $valor Valor a buscar
     * @return PDOStatement|null Resultado de la búsqueda
     */
    public function buscarProductos($tipo, $valor) {
        try {
            // Validar que tengamos datos
            if (empty($tipo) || empty($valor)) {
                return null;
            }

            // Seleccionar el tipo de búsqueda
            switch($tipo) {
                case 'fabricante':
                    return $this->model->buscarPorFabricante($valor);
                case 'tipo':
                    return $this->model->buscarPorTipo($valor);
                case 'precio':
                    if (!is_numeric($valor)) {
                        throw new Exception("El precio debe ser un número");
                    }
                    return $this->model->buscarPorPrecioMenor($valor);
                default:
                    throw new Exception("Tipo de búsqueda no válido");
            }
        } catch (Exception $e) {
            echo "🚫 Error: " . $e->getMessage();
            return null;
        }
    }
}