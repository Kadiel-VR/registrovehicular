<?php
// Incluir archivos de conexión y clase Automovil
include '../includes/Database.php';
include '../includes/Automovil.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Automovil
$automovil = new Automovil($db);

// Obtener los datos del formulario
$automovil->placa = $_POST['placa'];
$automovil->propietario_cedula = $_POST['propietario_cedula'];

// Obtener el nombre de la marca
$marca_id = $_POST['marca'];
$stmt = $db->prepare("SELECT nombre FROM marca WHERE id = :id");
$stmt->bindParam(":id", $marca_id);
$stmt->execute();
$automovil->marca = $stmt->fetchColumn(); // Obtener el nombre de la marca


// Obtener el nombre del modelo
$modelo_id = $_POST['modelo'];
$stmt = $db->prepare("SELECT nombre FROM modelo WHERE id = :id");
$stmt->bindParam(":id", $modelo_id);
$stmt->execute();
$automovil->modelo = $stmt->fetchColumn(); // Obtener el nombre del modelo


$automovil->anio = $_POST['anio'];
$automovil->color = $_POST['color'];
$automovil->numeroMotor = $_POST['numeroMotor'];
$automovil->numeroChasis = $_POST['numeroChasis'];


// Obtener el nombre del tipo de vehículo
$tipoVehiculo_id = $_POST['tipoVehiculo'];
$stmt = $db->prepare("SELECT nombre FROM tipo_vehiculo WHERE id = :id");
$stmt->bindParam(":id", $tipoVehiculo_id);
$stmt->execute();
$automovil->tipoVehiculo = $stmt->fetchColumn(); // Obtener el nombre del tipo de vehículo



// Registrar el automóvil
if ($automovil->registrar()) {
    echo "Registro realizado exitosamente. <br>";
    echo "Esta página será redirigida al formulario de registro en 5 segundos...";
} else {
    echo "Error al registrar el automóvil.";
}
?>


<html lang="es">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="5;url=../pages/registrarAutomovil.php"> <!-- Redirige después de 5 segundos -->
 

</head>


</html>