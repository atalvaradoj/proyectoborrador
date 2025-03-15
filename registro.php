<?php include "shared/header.php" ?>

<!DOCTYPE html>
<html>

<head>
    <title>Registro de Estudiantes</title>
</head>

<body>
    <h1>Registro de Estudiantes</h1>
    <?php
    // Verificar si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellido = htmlspecialchars($_POST['apellido']);
        $email = htmlspecialchars($_POST['email']);
        $fecha_nacimiento = htmlspecialchars($_POST['fecha_nacimiento']);

        // Mostrar los datos del estudiante
        echo "<h2>Datos del Estudiante Registrado:</h2>";
        echo "Nombre: " . $nombre . "<br>";
        echo "Apellido: " . $apellido . "<br>";
        echo "Email: " . $email . "<br>";
        echo "Fecha de Nacimiento: " . $fecha_nacimiento . "<br>";
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label><br>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br><br>
        <input type="submit" value="Registrar">
    </form>
</body>

</html>

<!-- Footer -->
<?php include "shared/footer.php" ?>