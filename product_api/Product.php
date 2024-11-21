<?php
// Incluir el archivo de configuración
require_once 'config.php';

class Product {
    private $conn;

    // Constructor: establece la conexión a la base de datos usando PDO
    public function __construct() {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        try {
            $this->conn = new PDO($dsn, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Obtener todos los productos
    public function getAllProducts() {
        $sql = "SELECT * FROM automoviles";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un producto específico por su ID
    public function getProductById($id) {
        $sql = "SELECT * FROM automoviles WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Destructor: cerrar la conexión a la base de datos
    public function __destruct() {
        $this->conn = null;
    }
}
?>
