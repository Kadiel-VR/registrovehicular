<?php
class Automovil {
    private $conn; // Conexión a la base de datos
    private $table_name = "automoviles_propietarios_naturales"; // Nombre de la tabla

    // Propiedades de la clase
    public $id;
    public $placa;
    public $propietario_cedula;
    public $marca;
    public $modelo;
    public $anio;
    public $color;
    public $numeroMotor;
    public $numeroChasis;
    public $tipoVehiculo;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar un nuevo automóvil
    public function registrar() {
        // Query para insertar un nuevo automóvil
        $query = "INSERT INTO " . $this->table_name . " (placa, propietario_cedula, marca, modelo, anio, color, numeroMotor, numeroChasis, tipoVehiculo) VALUES (:placa, :propietario_cedula, :marca, :modelo, :anio, :color, :numeroMotor, :numeroChasis, :tipoVehiculo)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos para evitar inyección SQL
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->propietario_cedula = htmlspecialchars(strip_tags($this->propietario_cedula));
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->anio = htmlspecialchars(strip_tags($this->anio));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->numeroMotor = htmlspecialchars(strip_tags($this->numeroMotor));
        $this->numeroChasis = htmlspecialchars(strip_tags($this->numeroChasis));
        $this->tipoVehiculo = htmlspecialchars(strip_tags($this->tipoVehiculo));
        

        // Enlazar los parámetros
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":propietario_cedula", $this->propietario_cedula);
        $stmt->bindParam(":marca", $this->marca);
        $stmt->bindParam(":modelo", $this->modelo);
        $stmt->bindParam(":anio", $this->anio);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":numeroMotor", $this->numeroMotor);
        $stmt->bindParam(":numeroChasis", $this->numeroChasis);
        $stmt->bindParam(":tipoVehiculo", $this->tipoVehiculo);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function buscar() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE placa = :placa";
        $stmt = $this->conn->prepare($query);

        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $stmt->bindParam(":placa", $this->placa);

        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
    

}
?>
