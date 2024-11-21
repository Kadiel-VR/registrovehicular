<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro Único Vehicular</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .is-invalid {
            border-color: red;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Registro Único Vehicular</h2>
        <form id="registroVehicular" method="POST" action="../controllers/procesar_registro.php">
            <!-- Paso 1: Datos de Identificación del Vehículo -->
            <div class="step step1 active card p-4">
                <h3>1. Datos de Identificación del Vehículo</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>VIN</label>
                        <input type="text" class="form-control" name="vin" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Placa</label>
                        <input type="text" class="form-control" name="placa" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Marca</label>
                        <select class="form-control" name="marca" id="marca" required>
                            <option value="">Seleccione Marca</option>
                            <?php
                            require_once '../includes/Database.php'; // Incluir la conexión a la base de datos

                            $database = new Database();
                            $pdo = $database->getConnection();

                            // Consulta para obtener todas las marcas
                            $stmt = $pdo->query("SELECT * FROM marca");

                            // Generar las opciones del combobox de marcas
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Modelo</label>
                        <select class="form-control" name="modelo" id="modelo" required>
                            <option value="">Seleccione Modelo</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Año de Fabricación</label>
                        <input type="number" class="form-control" name="anio" min="1900" max="2024" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Color</label>
                        <input type="text" class="form-control" name="color" required>
                    </div>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-primary next-step">Siguiente</button>
                </div>
            </div>

            <!-- Paso 2: Especificaciones Técnicas -->
            <div class="step step2 card p-4">
                <h3>2. Especificaciones Técnicas</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tipo de Vehículo</label>
                        <select class="form-control" name="tipo_vehiculo" id="tipo_vehiculo" required>
                            <option value="">Seleccione Tipo</option>
                            <!-- Cargar tipos desde base de datos -->
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Capacidad del Motor (cc)</label>
                        <input type="number" class="form-control" name="capacidad_motor" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Número de Cilindros</label>
                        <input type="number" class="form-control" name="num_cilindros" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tipo de Combustible</label>
                        <select class="form-control" name="tipo_combustible" required>
                            <option value="">Seleccione Combustible</option>
                            <option value="gasolina">Gasolina</option>
                            <option value="diesel">Diésel</option>
                            <option value="electrico">Eléctrico</option>
                            <option value="hibrido">Híbrido</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Peso Bruto Vehicular (kg)</label>
                        <input type="number" class="form-control" name="peso_bruto" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Transmisión</label>
                        <select class="form-control" name="transmision" required>
                            <option value="">Seleccione Transmisión</option>
                            <option value="manual">Manual</option>
                            <option value="automatica">Automática</option>
                            <option value="cvt">CVT</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                    <button type="button" class="btn btn-primary next-step">Siguiente</button>
                </div>
            </div>

            <!-- Paso 3: Datos del Propietario -->
            <div class="step step3 card p-4">
                <h3>3. Datos del Propietario</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nombre del Propietario</label>
                        <input type="text" class="form-control" name="nombre_propietario" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tipo de Propietario</label>
                        <select class="form-control" name="tipo_propietario" required>
                            <option value="">Seleccione Tipo</option>
                            <option value="natural">Persona Natural</option>
                            <option value="juridica">Persona Jurídica</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Domicilio</label>
                        <input type="text" class="form-control" name="domicilio" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Número de Identificación</label>
                        <input type="text" class="form-control" name="num_identificacion" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Teléfono de Contacto</label>
                        <input type="tel" class="form-control" name="telefono" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                    <button type="button" class="btn btn-primary next-step">Siguiente</button>
                </div>
            </div>

            <!-- Paso 4: Datos de Seguro -->
            <div class="step step4 card p-4">
                <h3>4. Datos de Seguro</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Aseguradora</label>
                        <input type="text" class="form-control" name="aseguradora" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Número de Póliza</label>
                        <input type="text" class="form-control" name="poliza" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Inicio de Vigencia</label>
                        <input type="date" class="form-control" name="inicio_vigencia" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Fin de Vigencia</label>
                        <input type="date" class="form-control" name="fin_vigencia" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                    <button type="button" class="btn btn-primary next-step">Ver Resumen</button>
                </div>
            </div>

            <!-- Resumen Final -->
            <div class="step step5 card p-4">
                <h3>Resumen de Registro</h3>
                <div id="resumenContenido"></div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">Confirmar Registro</button>
                    <button type="button" class="btn btn-secondary prev-step">Editar</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentStep = 1;
            const totalSteps = 5;

            // Placa validation function
            function validatePlaca(placa) {
                const placaRegex = /^[A-Z]{2}\d{4}$/;
                return placaRegex.test(placa);
            }

            // Function to validate all fields before moving to next step
            function validateStep(step) {
                let isValid = true;
                let errorMessages = [];

                // Remove previous error styles and messages
                $(`[data-step="${step}"] .is-invalid`).removeClass('is-invalid');
                $(`[data-step="${step}"] .alert-danger`).remove();

                // Select all required inputs in the current step
                $(`[data-step="${step}"] [required]`).each(function() {
                    // Check if field is empty
                    if (!$(this).val().trim()) {
                        $(this).addClass('is-invalid');
                        errorMessages.push(`El campo ${$(this).prev('label').text()} es obligatorio.`);
                        isValid = false;
                    }
                });

                // Special validation for placa in first step
                if (step === 1) {
                    const placa = $('input[name="placa"]').val();
                    if (placa && !validatePlaca(placa)) {
                        $('input[name="placa"]').addClass('is-invalid');
                        errorMessages.push('La placa debe tener 2 letras mayúsculas seguidas de 4 números.');
                        isValid = false;
                    }
                }

                // Display error messages if any
                if (!isValid) {
                    let errorHtml = '<div class="alert alert-danger">';
                    errorMessages.forEach(function(msg) {
                        errorHtml += `<p>${msg}</p>`;
                    });
                    errorHtml += '</div>';

                    // Show errors at the top of the current step
                    $(`[data-step="${step}"]`).prepend(errorHtml);
                }

                return isValid;
            }

            // Check unique placa via AJAX
            function checkPlacaUnique(placa, callback) {
                $.ajax({
                    type: 'POST',
                    url: '../ajax/validar_placa.php',
                    data: {
                        placa: placa
                    },
                    success: function(response) {
                        callback(response === 'exists');
                    },
                    error: function() {
                        callback(false);
                    }
                });
            }

            // Navegación entre pasos
            $('.next-step').click(function() {
                // Validate current step
                if (validateStep(currentStep)) {
                    // Special check for placa uniqueness in first step
                    if (currentStep === 1) {
                        const placa = $('input[name="placa"]').val();
                        checkPlacaUnique(placa, function(exists) {
                            if (exists) {
                                $('input[name="placa"]').addClass('is-invalid');
                                let errorHtml = '<div class="alert alert-danger">' +
                                    '<p>Esta placa ya está registrada en el sistema.</p>' +
                                    '</div>';
                                $('[data-step="1"]').prepend(errorHtml);
                            } else {
                                // Proceed to next step
                                proceedToNextStep();
                            }
                        });
                    } else {
                        // Proceed to next step for other steps
                        proceedToNextStep();
                    }
                }
            });

            // Function to proceed to next step
            function proceedToNextStep() {
                if (currentStep < totalSteps) {
                    $('.step' + currentStep).removeClass('active');
                    currentStep++;
                    $('.step' + currentStep).addClass('active');

                    // Para el último paso (resumen)
                    if (currentStep === 5) {
                        generarResumen();
                    }
                }
            }

            // Previous step navigation remains the same
            $('.prev-step').click(function() {
                if (currentStep > 1) {
                    $('.step' + currentStep).removeClass('active');
                    currentStep--;
                    $('.step' + currentStep).addClass('active');
                }
            });

            // Generar resumen function remains the same
            function generarResumen() {
                let resumen = '<div class="row">';

                // Iterar sobre todos los campos de los pasos anteriores
                $('form input, form select').each(function() {
                    if ($(this).attr('name')) {
                        resumen += `
                <div class="col-md-6 mb-2">
                    <strong>${$(this).prev('label').text()}:</strong> 
                    ${$(this).val()}
                </div>`;
                    }
                });

                resumen += '</div>';
                $('#resumenContenido').html(resumen);
            }

            // Add data-step attributes to help with validation
            $('.step').each(function(index) {
                $(this).attr('data-step', index + 1);
            });

            // Existing AJAX calls for marca, modelo, and tipo_vehiculo remain the same
            $('#marca').change(function() {
                var marcaID = $(this).val();

                if (marcaID) {
                    $.ajax({
                        type: 'POST',
                        url: '../ajax/get_modelos.php',
                        data: {
                            marca_id: marcaID
                        },
                        success: function(html) {
                            $('#modelo').html(html);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error al obtener los modelos:', error);
                        }
                    });
                } else {
                    $('#modelo').html('<option value="">Seleccione un modelo</option>');
                }
            });

            $('#modelo').change(function() {
                var modeloID = $(this).val();

                if (modeloID) {
                    $.ajax({
                        type: 'POST',
                        url: '../ajax/get_tiposVehiculos.php',
                        data: {
                            modelo_id: modeloID
                        },
                        success: function(html) {
                            $('#tipo_vehiculo').html(html);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error al obtener los tipos de vehículos:', error);
                        }
                    });
                } else {
                    $('#tipoVehiculo').html('<option value="">Seleccione un tipo de vehículo</option>');
                }
            });
        });
    </script>
</body>

</html>