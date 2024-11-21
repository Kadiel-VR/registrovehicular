<?php
header("Content-Type: application/json");

require_once 'Product.php';
$product = new Product();

// Obtener el método HTTP de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

// Parsear el cuerpo de la solicitud para las peticiones PUT, POST, y PATCH
$inputData = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $data = $product->getProductById($id);
            echo json_encode($data ?: ["message" => "Product not found"]);
        } else {
            echo json_encode($product->getAllProducts());
        }
        break;

    default:
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>
