<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Rol de Pagos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="text-center mb-4">Sistema de Rol de Pagos</h3>

                        <form method="post">
                            <!-- Campo Nombre del Empleado -->
                            <div class="form-floating mb-3">
                                <input type="text" name="txtnombre" class="form-control" placeholder="Ingrese el nombre" required>
                                <label>Nombre del Empleado</label>
                            </div>

                            <!-- Campo Horas Trabajadas -->
                            <div class="form-floating mb-3">
                                <input type="number" name="txthoras" class="form-control" placeholder="Ingrese las horas" min="0" step="0.5" required>
                                <label>Horas Trabajadas</label>
                            </div>

                            <!-- Campo Valor por Hora -->
                            <div class="form-floating mb-3">
                                <input type="number" name="txtvalor_hora" class="form-control" placeholder="Ingrese el valor" min="0" step="0.01" required>
                                <label>Valor por Hora ($)</label>
                            </div>

                            <!-- Botón de Envío -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark btn-lg">Calcular Rol de Pagos</button>
                            </div>
                        </form>
                        
                        <hr>
                        <h3 class="text-center mb-4">Resultado</h3>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            // Obtener datos del formulario
                            $nombre = $_POST['txtnombre'];
                            $horas_trabajadas = floatval($_POST['txthoras']);
                            $valor_hora = floatval($_POST['txtvalor_hora']);

                            // Validar datos
                            if ($horas_trabajadas <= 0 || $valor_hora <= 0) {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error:</strong> Las horas trabajadas y el valor por hora deben ser mayores a 0.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>';
                            } else {
                                // Cálculos
                                $sueldo_basico = $horas_trabajadas * $valor_hora;
                                $descuento_iess = $sueldo_basico * 0.10;
                                $sueldo_neto = $sueldo_basico - $descuento_iess;

                                // Mostrar resultados
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <h5 class="alert-heading"><i class="bi bi-person-check"></i> Resumen del Rol de Pagos</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <strong>Empleado:</strong> ' . htmlspecialchars($nombre) . '
                                        </div>
                                        <div class="col-6">
                                            <strong>Horas trabajadas:</strong>
                                        </div>
                                        <div class="col-6 text-end">
                                            ' . number_format($horas_trabajadas, 2) . ' horas
                                        </div>
                                        <div class="col-6">
                                            <strong>Valor por hora:</strong>
                                        </div>
                                        <div class="col-6 text-end">
                                            $' . number_format($valor_hora, 2) . '
                                        </div>
                                        <div class="col-6">
                                            <strong>Sueldo básico:</strong>
                                        </div>
                                        <div class="col-6 text-end">
                                            $' . number_format($sueldo_basico, 2) . '
                                        </div>
                                        <div class="col-6">
                                            <strong>Descuento IESS (10%):</strong>
                                        </div>
                                        <div class="col-6 text-end">
                                            -$' . number_format($descuento_iess, 2) . '
                                        </div>
                                        <div class="col-6 mt-2">
                                            <strong class="fs-5">Sueldo neto:</strong>
                                        </div>
                                        <div class="col-6 text-end mt-2">
                                            <strong class="fs-5 text-success">$' . number_format($sueldo_neto, 2) . '</strong>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <i class="bi bi-info-circle"></i> Fecha de cálculo: ' . date('d/m/Y') . '
                                        </small>
                                    </div>
                                </div>';
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>