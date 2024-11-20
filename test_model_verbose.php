<?php
/**
 * Test: ModelBBDD Mejorado
 * Autor: mag00s
 * Fecha: 19/11/2024
 * Guardar como: test_model_verbose.php
 */

if (php_sapi_name() !== 'cli') {
    die('Este script solo se puede ejecutar desde la línea de comandos');
}

require_once 'models/ModelBBDD.php';

echo "\n🚀 INICIANDO TESTS DETALLADOS\n";
echo "============================\n";

$model = new ModelBBDD();

// Test Categorías
echo "\n📁 CATEGORÍAS:\n";
$cats = $model->getCategorias();
foreach($cats as $cat) {
    echo sprintf("  • %-15s [%s]\n", $cat['nombre_categoria'], $cat['tipo_categoria']);
}

// Test Lenguajes
echo "\n💻 LENGUAJES DE PROGRAMACIÓN:\n";
$langs = $model->getLenguajes();
foreach($langs as $lang) {
    echo sprintf("  • %-30s [%s]\n", $lang['titulo'], $lang['nombre_categoria']);
}

// Test Búsqueda PHP
echo "\n🔍 BÚSQUEDA 'PHP':\n";
$results = $model->buscarPorTitulo('PHP');
foreach($results as $result) {
    echo sprintf("  • %-40s [%s]\n", $result['titulo'], $result['nombre_categoria']);
}

echo "\n✅ TESTS COMPLETADOS\n";