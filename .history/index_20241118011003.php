<?php
require_once 'config/Database.php';
require_once 'models/ModelBBDD.php';
require_once 'controllers/ProductoController.php';

$doc = $_GET['doc'] ?? '';

if ($doc) {
    require_once 'views/layouts/header.php';
    echo '<div class="main-container content-card">';
    
    if ($doc === 'readme') {
        $markdown = file_get_contents('README.md');
        // You'll need a Markdown parser here. For example:
        // echo parseMarkdown($markdown);
        echo '<pre>' . htmlspecialchars($markdown) . '</pre>';
    } elseif ($doc === 'documentation') {
        $markdown = file_get_contents('DOCUMENTACION.md');
        echo '<pre>' . htmlspecialchars($markdown) . '</pre>';
    }
    
    echo '</div>';
    require_once 'views/layouts/footer.php';
    exit;
}

// Rest of your normal application code...
$database = new Database();
$db = $database->getConnection();
$controller = new ProductoController($db);

// ... rest of your code
?>