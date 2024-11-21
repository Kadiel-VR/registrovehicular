<?php
require_once '../includes/Database.php';

$database = new Database();
$pdo = $database->getConnection();

if (isset($_POST['placa'])) {
    $placa = $_POST['placa'];
    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM automoviles WHERE placa = :placa");
    $stmt->execute([':placa' => $placa]);
    
    echo ($stmt->fetchColumn() > 0) ? 'exists' : 'not_exists';
}
?>