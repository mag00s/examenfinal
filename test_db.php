// Quick test script - save as test_db.php
<?php
require_once 'config/Database.php';
$db = new Database();
$conn = $db->getConnection();
if($conn) {
    echo "¡Conexión exitosa! 🎉";
    $query = "SELECT COUNT(*) FROM categoria";
    $stmt = $conn->query($query);
    echo "\nCategorías encontradas: " . $stmt->fetchColumn();
} else {
    echo "Houston, tenemos un problema 🚨";
}