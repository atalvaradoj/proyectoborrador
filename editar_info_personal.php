<?php
include "shared/header.php";

require_once "includes/db_config.php";

// Verificar sesión y rol
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['user_role'], ['padre', 'admin'])) {
    header("Location: index.php");
    exit;
}

$conn = getConnection();
$userId = $_SESSION['user_id'];
$mensaje = "";

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nuevoCorreo = $_POST['correo'] ?? '';
    $nuevoTelefono = $_POST['telefono'] ?? '';

    // Procesar imagen
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $archivoTmp = $_FILES['foto_perfil']['tmp_name'];
        $ext = strtolower(pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION));

        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
            $rutaDestino = "uploads/" . $userId . "." . $ext;

            // Eliminar fotos anteriores del usuario
            foreach (['jpg', 'jpeg', 'png'] as $e) {
                $archivoViejo = "uploads/" . $userId . "." . $e;
                if (file_exists($archivoViejo)) {
                    unlink($archivoViejo);
                }
            }

            move_uploaded_file($archivoTmp, $rutaDestino);
        } else {
            $mensaje = "Formato de imagen no válido. Usa JPG o PNG.";
        }
    }

    // Actualizar datos si están presentes
    if ($nuevoCorreo && $nuevoTelefono) {
        $sql = "UPDATE usuarios SET Correo = ?, Telefono = ? WHERE ID_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nuevoCorreo, $nuevoTelefono, $userId);

        if ($stmt->execute()) {
            $mensaje = "Información actualizada correctamente.";
        } else {
            $mensaje = "Error al actualizar la información: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $mensaje = "Por favor, complete todos los campos.";
    }
}

// Obtener información actual del usuario
$sql = "SELECT Nombres, Correo, Telefono FROM usuarios WHERE ID_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();
$conn->close();

// Determinar ruta de la imagen de perfil
$fotoPerfil = "img/logoinicio.png"; // Imagen por defecto
foreach (['jpg', 'jpeg', 'png'] as $ext) {
    $ruta = "uploads/" . $userId . "." . $ext;
    if (file_exists($ruta)) {
        $fotoPerfil = $ruta;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Información Personal</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Ajustá la ruta si es necesario -->
    <style>
        .foto-perfil {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
            display: block;
        }
    </style>
</head>
<body>

<div class="page-header">
    <h1 class="page-title">Editar Información Personal</h1>
    <p class="page-subtitle">Modifica tus datos de contacto</p>
</div>

<div class="container" style="max-width: 600px; margin: auto;">
    <div class="card">
        <div class="card-header">
            Tus Datos Personales
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <!-- Mostrar foto actual o imagen por defecto -->
                <img src="<?= $fotoPerfil ?>" class="foto-perfil" alt="Foto de perfil">

                <label class="form-label">Cambiar foto de perfil:</label>
                <input type="file" class="form-control" name="foto_perfil" accept=".jpg, .jpeg, .png">

                <label class="form-label">Nombre completo:</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['Nombres']) ?>" disabled>

                <label for="correo" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?= htmlspecialchars($usuario['Correo']) ?>" required>

                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['Telefono']) ?>" required>

                <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
            </form>

            <?php if ($mensaje): ?>
                <div class="alert-info mt-3 p-3 rounded"><?= htmlspecialchars($mensaje) ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
<?php include "shared/footer.php"; ?>
</html>
