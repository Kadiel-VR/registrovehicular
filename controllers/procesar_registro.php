<?php
session_start();

// Datos de conexión a la base de datos
$host = 'localhost';
$dbname = 'registrovehicular';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Preparar la consulta SQL para insertar todos los datos
        $stmt = $pdo->prepare("INSERT INTO automoviles
            (vin, placa, marca, modelo, anio, color, 
             tipo_vehiculo, capacidad_motor, num_cilindros, tipo_combustible, 
             peso_bruto, transmision, nombre_propietario, tipo_propietario, 
             domicilio, num_identificacion, telefono, aseguradora, 
             poliza, inicio_vigencia, fin_vigencia) 
            VALUES 
            (:vin, :placa, :marca, :modelo, :anio, :color, 
             :tipo_vehiculo, :capacidad_motor, :num_cilindros, :tipo_combustible, 
             :peso_bruto, :transmision, :nombre_propietario, :tipo_propietario, 
             :domicilio, :num_identificacion, :telefono, :aseguradora, 
             :poliza, :inicio_vigencia, :fin_vigencia)");

        // Vincular parámetros
        $stmt->bindParam(':vin', $_POST['vin']);
        $stmt->bindParam(':placa', $_POST['placa']);
        $stmt->bindParam(':marca', $_POST['marca']);
        $stmt->bindParam(':modelo', $_POST['modelo']);
        $stmt->bindParam(':anio', $_POST['anio']);
        $stmt->bindParam(':color', $_POST['color']);
        $stmt->bindParam(':tipo_vehiculo', $_POST['tipo_vehiculo']);
        $stmt->bindParam(':capacidad_motor', $_POST['capacidad_motor']);
        $stmt->bindParam(':num_cilindros', $_POST['num_cilindros']);
        $stmt->bindParam(':tipo_combustible', $_POST['tipo_combustible']);
        $stmt->bindParam(':peso_bruto', $_POST['peso_bruto']);
        $stmt->bindParam(':transmision', $_POST['transmision']);
        $stmt->bindParam(':nombre_propietario', $_POST['nombre_propietario']);
        $stmt->bindParam(':tipo_propietario', $_POST['tipo_propietario']);
        $stmt->bindParam(':domicilio', $_POST['domicilio']);
        $stmt->bindParam(':num_identificacion', $_POST['num_identificacion']);
        $stmt->bindParam(':telefono', $_POST['telefono']);
        $stmt->bindParam(':aseguradora', $_POST['aseguradora']);
        $stmt->bindParam(':poliza', $_POST['poliza']);
        $stmt->bindParam(':inicio_vigencia', $_POST['inicio_vigencia']);
        $stmt->bindParam(':fin_vigencia', $_POST['fin_vigencia']);


        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<div id='successMessage'>Registro exitoso</div>";
            echo "<meta http-equiv='refresh' content='3;url=../index.php'>";
            exit();
        } else {
            echo "Error en el registro";
        }
    }
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>