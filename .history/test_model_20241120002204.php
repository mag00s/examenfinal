<?php
/**
 * Test: ModelBBDD
 * Autor: mag00s
 * Fecha: 19/11/2024
 * Guardar como: test_model.php
 */

require_once 'models/ModelBBDD.php';

$model = new ModelBBDD();

echo "=== Test de ModelBBDD ===\n";

// Test 1: Obtener categorías
echo "\n1. Probando getCategorias():\n";
$cats = $model->getCategorias();
echo "Categorías encontradas: " . count($cats) . "\n";

// Test 2: Buscar lenguajes
echo "\n2. Probando getLenguajes():\n";
$langs = $model->getLenguajes();
echo "Lenguajes encontrados: " . count($langs) . "\n";

// Test 3: Búsqueda por título
echo "\n3. Probando búsqueda 'PHP':\n";
$results = $model->buscarPorTitulo('PHP');
echo "Resultados encontrados: " . count($results) . "\n";