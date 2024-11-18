<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO - Tienda</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .hover-bg-light:hover {
            background-color: #f8f9fa;
            transition: background-color 0.2s;
        }
        .sticky-top {
            position: sticky;
            top: 0;
            background: white;
            z-index: 1000;
        }
    </style>
</head>
<body class="bg-light">
    <?php
    require_once 'config/Database.php';
    require_once 'models/ModelBBDD.php';
    require_once 'controllers/ProductoController.php';

    $database = new Database();
    $db = $database->getConnection();
    $model = new ModelBBDD($db);

    $consulta = isset($_GET['consulta']) ? $_GET['consulta'] : '';
    $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
    $resultado = null;

    if ($consulta) {
        switch($consulta) {
            case '1': $resultado = $model->productosMasCaros(); break;
            case '2': $resultado = $model->totalProductosPorFabricante(); break;
            case '3': $resultado = $model->productosBajoPrecioMedio(); break;
        }
    } elseif ($busqueda) {
        $resultado = $model->buscarProductos($busqueda);
    }

    require_once 'views/home.php';
    require_once 'views/results.php';
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>