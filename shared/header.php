<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" href="img/icono.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Académico</title>
    <!-- Agregar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            color: #333;
            margin-bottom: 10px;
        }

        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            border-radius: 5px;
        }

        .content {
            margin-left: 270px;
            /* Espacio para la barra lateral */
            padding: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                box-shadow: none;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <!-- Botón de Cerrar Sesión -->
    <?php if (basename($_SERVER['PHP_SELF']) !== 'index.php' && isset($_SESSION['user_id'])): ?>
        <div class="logout-container text-end p-2">
            <link rel="stylesheet" href="css/logout.css">
            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#logoutModal">
                Cerrar Sesión
            </button>
        </div>
    <?php endif; ?>

    <!-- Modal de Confirmación para Cerrar Sesión -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="logoutModalLabel">Confirmar Cierre de Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de que desea cerrar sesión?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Barra lateral -->
<div class="sidebar">
    <h4 class="text-center">Sistema Escolar</h4>
    <ul class="nav flex-column">
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php if ($_SESSION['user_role'] === 'docentes'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="registro.php">Agregar Notas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="editar_info_personal.php">Editar Información Personal</a>
                </li>
            <?php elseif ($_SESSION['user_role'] === 'padres'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="reportes.php">Generar Reporte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="editar_info_personal.php">Editar Información Personal</a>
                </li>
                <?php elseif ($_SESSION['user_role'] === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="reportes.php">Generar Reporte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="editar_info_personal.php">Editar Información Personal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registro.php">Registro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Admin_Aprobar_Solicitudes.php">Aprobar Solicitud</a>
                </li>
            <?php endif; ?>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Identificarse</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="apicontactenos.php">Mapa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="interes.php">¿Por qué elegirnos?</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="testimonios.php">Testimonios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="servicios.php">Servicios</a>
            </li>
        <?php endif; ?>
    </ul>
</div>


    <!-- Agregar Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>