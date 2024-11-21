<?php
session_start(); // Siempre debe ir al principio del archivo
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro Vehicular - Menú Princiapl - Administrador</title>

    <!-- CSS-->
    <link href="css/menuPrincipal.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <!-- Contenedor para las alertas -->
    <div class="alert-container">
        <?php
        if (isset($_SESSION['mensaje'])) {
            echo '<div class="alert alert-' . $_SESSION['mensaje']['tipo'] . ' alert-dismissible fade show" role="alert">';
            echo $_SESSION['mensaje']['texto'];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
            unset($_SESSION['mensaje']); // Limpiamos el mensaje después de mostrarlo
        }
        ?>
    </div>

    <div class="container text-center mt-5">

        <h1 class="mb-4">Bienvenido al Sistema de Registro Vehicular</h1>
        <div class="d-grid gap-3" style="max-width: 400px; margin: auto;">

            <div class="mb-3">
                <a href="pages/registrarAutomovil.php" class="btn btn-primary btn-lg w-100">Registrar un nuevo automóvil</a>
            </div>

            <div class="mb-3">
                <a href="pages/buscar_vehiculo.php" class="btn btn-success btn-custom btn-lg w-100">Buscar un automóvil por placa</a>
            </div>

            <div class="mb-3">
                <a href="product_api/index.php" class="btn btn-danger btn-custom btn-lg w-100">Servicio Web</a>
            </div>


        </div>
    </div>

    <footer>
        <p>&copy; Victor Rodriguez Grupo: 1LS133.</p>
    </footer>

    <!-- JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>