<?php
session_start();
require_once "includes/db_config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['c'] ?? null;
    $contrasena = $_POST['Contraseña'] ?? null;

    if (!$usuario || !$contrasena) {
        $_SESSION['error_message'] = "Por favor, complete todos los campos.";
        header("Location: index.php");
        exit;
    }

    $conn = getConnection();

    if ($conn) {
        try {
            // Consulta para verificar si el usuario existe
            $sql = "SELECT * FROM usuarios WHERE Correo = ? OR ID_usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $usuario, $usuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                // Verificar la contraseña
                if (password_verify($contrasena, $user['Contrasena'])) {
                    // Iniciar sesión
                    $_SESSION['user_id'] = $user['ID_usuario'];
                    $_SESSION['user_name'] = $user['Nombres'];
                    $_SESSION['user_role'] = $user['Rol'];

                    // Redirigir al panel principal
                    header("Location: registro.php");
                    exit;
                } else {
                    $_SESSION['error_message'] = "Contraseña incorrecta.";
                }
            } else {
                $_SESSION['error_message'] = "Usuario no encontrado.";
            }
        } catch (Exception $e) {
            $_SESSION['error_message'] = "Error: " . $e->getMessage();
        } finally {
            $stmt->close();
            $conn->close();
        }
    } else {
        $_SESSION['error_message'] = "Error de conexión a la base de datos.";
    }

    // Redirigir de vuelta al formulario de inicio de sesión con un mensaje de error
    header("Location: index.php");
    exit;
}
?>