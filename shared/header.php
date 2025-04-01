<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Académico</title>
    <!-- Agregar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            margin-left: 270px; /* Espacio para la barra lateral */
            padding: 20px;
        }
    </style>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <!-- Barra lateral -->
    <div class="sidebar">
        <h4 class="text-center">Sistema Académico</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="shared/base_admin.php">Administracion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registro.php">Registro</a>
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
        </ul>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <h1>Bienvenido al Sistema Académico</h1>
        <p>Este es el contenido principal de la página.</p>
    </div>

    <!-- Agregar Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>