<?php
require_once '../includes/Database.php'; // Incluir la conexión a la base de datos

// Crear instancia de la base de datos
$database = new Database();
$pdo = $database->getConnection(); // Obtener conexión


if (isset($_POST['modelo_id'])) {
    // Obtener el ID de la provincia desde la solicitud AJAX
    $modelo_id = $_POST['modelo_id'];

    // Consulta para obtener los distritos de la provincia seleccionada
    $stmt = $pdo->prepare("SELECT * FROM tipo_vehiculo WHERE modelo_id = ?");
    $stmt->execute([$modelo_id]);

    // Verificar si hay distritos encontrados
    if ($stmt->rowCount() > 0) {
        echo '<option value="">Seleccione un tipo de vehículo</option>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['nombre']) . '</option>';
        }
    } else {
        echo '<option value="">No hay distritos disponibles</option>';
    }
}
?>
