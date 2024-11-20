<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO - Tienda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="header">
        <div class="app-brand">
            <span class="logo">🌱</span>
            <h1 class="app-title">Programación Orientada a Objetos</h1>
        </div>
        <nav class="nav-tabs">
            <a href="index.php" class="nav-tab <?= !isset($_GET['doc']) ? 'active' : '' ?>">
                🏠 Aplicación
            </a>
            <a href="?doc=readme" class="nav-tab <?= $_GET['doc'] ?? '' === 'readme' ? 'active' : '' ?>">
                📖 README
            </a>
            <a href="?doc=documentation" class="nav-tab <?= $_GET['doc'] ?? '' === 'documentation' ? 'active' : '' ?>">
                📑 Documentación
            </a>
        </nav>
    </header>