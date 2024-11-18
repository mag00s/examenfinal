<?php
require_once 'config/Database.php';

header('Content-Type: application/json');

try {
    $term = $_GET['term'] ?? '';
    
    if (strlen($term) < 2) {
        echo json_encode([]);
        exit;
    }

    $db = (new Database())->getConnection();
    
    $query = "SELECT DISTINCT 
                p.nombre as producto,
                f.nombre as fabricante
              FROM producto p
              JOIN fabricante f ON p.fk_codigo = f.pk_codigo
              WHERE p.nombre LIKE :term 
                 OR f.nombre LIKE :term
              LIMIT 10";
              
    $stmt = $db->prepare($query);
    $term = "%{$term}%";
    $stmt->bindParam(':term', $term);
    $stmt->execute();
    
    $suggestions = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $suggestions[] = $row['producto'];
        $suggestions[] = $row['fabricante'];
    }
    
    echo json_encode(array_unique($suggestions));

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}