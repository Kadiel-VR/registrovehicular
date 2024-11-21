<?php
require_once '../includes/Database.php'; // Incluir la conexión a la base de datos

// Crear instancia de la base de datos
$database = new Database();
$pdo = $database->getConnection(); // Obtener conexión


if (isset($_POST['marca_id'])) {
    // Obtener el ID de la marca desde la solicitud AJAX
    $marca_id = $_POST['marca_id'];

    // Consulta para obtener los modelos de la marca seleccionada
    $stmt = $pdo->prepare("SELECT * FROM modelo WHERE marca_id = ?");
    $stmt->execute([$marca_id]);

    // Verificar si hay modelos encontrados
    if ($stmt->rowCount() > 0) {
        echo '<option value="">Seleccione un modelo</option>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['nombre']) . '</option>';
        }
    } else {
        echo '<option value="">No hay modelos disponibles</option>';
    }
}
?>
