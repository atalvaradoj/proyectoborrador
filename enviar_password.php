<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
require 'shared/db_config.php'; // Esto define $conn
include "shared/header.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['correo'])) {
    $correo = $conn->real_escape_string($_POST['correo']);

    // Verificar si el correo existe
    $resultado = $conn->query("SELECT * FROM usuarios WHERE correo = '$correo'");

    if ($resultado->num_rows > 0) {
        // Generar nueva contraseña aleatoria
        $nueva_contrasena = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
        $hash = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

        // Actualizar contraseña en la base de datos
        $conn->query("UPDATE usuarios SET contrasena = '$hash' WHERE correo = '$correo'");

        // Enviar correo con PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mikirourke09@gmail.com';
            $mail->Password   = 'qzof dkvr reny zezb'; // Asegúrate de que sea una contraseña de aplicación
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('no-reply@tudominio.com', 'Soporte');
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->Subject = 'Tu nueva contraseña';
            $mail->Body    = "Hola,<br>Tu nueva contraseña es: <strong>$nueva_contrasena</strong><br>Te recomendamos cambiarla después de iniciar sesión.";

            $mail->send();
            echo "Correo enviado con tu nueva contraseña.";
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    } else {
        echo "Este correo no está registrado.";
    }
}
?>
<!-- enviar_password.php -->
<!-- enviar_password.php -->
<?php
// Mostrar errores si los hay
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir configuración de base de datos
require 'shared/db_config.php'; // Esto define $conn
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 28px;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group label {
            font-size: 16px;
            color: #555;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            font-size: 14px;
        }

        button {
            background-color: #007bff;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            width: 100%;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .footer {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Recuperar Contraseña</h2>
        <form action="enviar_password.php" method="POST">
            <div class="form-group">
                <label for="correo">Correo electrónico:</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <button type="submit">Recuperar Contraseña</button>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2025 Sistema Académico. Todos los derechos reservados.</p>
        <p><a href="index.php">Volver al inicio</a></p>
    </div>

</body>
</html>

