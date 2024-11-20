<?php
class EnlacesController {
    public function handleRequest() {
        $database = new Database();
        $db = $database->getConnection();
        $model = new ModelBBDD($db);

        $busqueda = $_GET['busqueda'] ?? '';
        $consulta = $_GET['consulta'] ?? '';
        $resultado = null;

        if ($consulta && $busqueda) {
            switch ($consulta) {
                case '1':
                    $resultado = $model->searchByCategory("%$busqueda%");
                    break;
                case '2':
                    $resultado = $model->searchByLanguage("%$busqueda%");
                    break;
                case '3':
                    $resultado = $model->searchByTitle("%$busqueda%");
                    break;
            }
        }

        include "views/enlaces.php";
    }
}
?>
