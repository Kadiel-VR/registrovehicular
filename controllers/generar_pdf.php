<?php
require_once '../includes/Database.php'; // Conexión a la base de datos
require_once '../libs/fpdf.php'; // Librería FPDF

if (isset($_GET['placa'])) {
    $placa = trim($_GET['placa']);
    $database = new Database();
    $pdo = $database->getConnection();

    // Consultar los datos del vehículo
    $stmt = $pdo->prepare("SELECT * FROM automoviles WHERE placa = :placa");
    $stmt->bindParam(':placa', $placa, PDO::PARAM_STR);
    $stmt->execute();
    $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($vehiculo) {
        // Crear el PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Registro Vehicular', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);

        // Añadir datos en dos columnas
        foreach ($vehiculo as $key => $value) {
            $pdf->Cell(60, 10, ucfirst(str_replace('_', ' ', $key)) . ':', 1);
            $pdf->Cell(120, 10, utf8_decode($value), 1, 1);
        }

        $pdf->Output('D', 'registro_vehicular_' . $placa . '.pdf'); // Descargar el PDF
    } else {
        echo 'No se encontró ningún vehículo con la placa ingresada.';
    }
} else {
    echo 'No se proporcionó una placa.';
}
?>
