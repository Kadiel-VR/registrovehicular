<?php
require_once '../includes/Database.php'; // Archivo para conectar a la base de datos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda de Registro Vehicular</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Búsqueda de Registro Vehicular</h2>
        <form id="buscarVehiculoForm" method="POST" action="">
            <div class="mb-3">
                <label for="placa" class="form-label">Número de Placa</label>
                <input type="text" id="placa" name="placa" class="form-control" placeholder="Ingrese la placa del vehículo" required>
            </div>
            <button type="submit" class="btn btn-success">Buscar</button>
        </form>

        <div id="resultado" class="mt-4">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['placa'])) {
                $placa = trim($_POST['placa']);
                $database = new Database();
                $pdo = $database->getConnection();

                // Consulta el registro vehicular por número de placa
                $stmt = $pdo->prepare("SELECT * FROM automoviles WHERE placa = :placa");
                $stmt->bindParam(':placa', $placa, PDO::PARAM_STR);
                $stmt->execute();
                $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($vehiculo) {
                    echo '<div class="card p-4">';
                    echo '<h3 class="text-center">Registro Único Vehicular</h3>';
                    echo '<div class="row">';

                    foreach ($vehiculo as $key => $value) {
                        echo '<div class="col-md-6 mb-2">';
                        echo '<strong>' . ucfirst(str_replace('_', ' ', $key)) . ':</strong> ' . htmlspecialchars($value);
                        echo '</div>';
                    }

                    echo '</div>';
                    echo '<a href="../controllers/generar_pdf.php?placa=' . urlencode($placa) . '" class="btn btn-success mt-3">Descargar PDF</a>';
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-danger">No se encontró ningún vehículo con la placa ingresada.</div>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
