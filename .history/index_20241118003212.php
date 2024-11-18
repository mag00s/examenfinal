<?php
require_once 'config/Database.php';
require_once 'models/ModelBBDD.php';
require_once 'controllers/ProductoController.php';

$database = new Database();
$db = $database->getConnection();
$model = new ModelBBDD($db);

$consulta = isset($_GET['consulta']) ? $_GET['consulta'] : null;
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : null;
$resultado = null;

if ($busqueda) {
    $resultado = $model->buscarProductos($busqueda);
} elseif ($consulta) {
    switch($consulta) {
        case '1':
            $resultado = $model->productosMasCaros();
            break;
        case '2':
            $resultado = $model->totalProductosPorFabricante();
            break;
        case '3':
            $resultado = $model->productosBajoPrecioMedio();
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programación Orientada a Objetos</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='0.9em' font-size='90'>🌱</text></svg>">
</head>
<body>
    <?php require_once 'views/home.php'; ?>
    <?php require_once 'views/results.php'; ?>
</body>
</html>