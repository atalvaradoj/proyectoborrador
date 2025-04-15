<?php
require 'vendor/autoload.php'; // Cargar PHPMailer
require_once "includes/db_config.php"; // Cargar configuración de la base de datos

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y sanitizar los datos del formulario
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $email = htmlspecialchars(trim($_POST['email']));
    $telefono = htmlspecialchars(trim($_POST['telefono']));
    $mensaje = htmlspecialchars(trim($_POST['mensaje']));

    // Validar que los campos requeridos no estén vacíos
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        header("Location: apicontactenos.php?status=error&message=" . urlencode("Por favor, complete todos los campos obligatorios."));
        exit();
    }

    // Conectar a la base de datos
    $conn = getConnection();
    if (!$conn) {
        header("Location: apicontactenos.php?status=error&message=" . urlencode("Error al conectar a la base de datos."));
        exit();
    }

    // Guardar los datos en la base de datos
    $sql = "INSERT INTO contactos (nombre, email, telefono, mensaje) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        header("Location: apicontactenos.php?status=error&message=" . urlencode("Error al preparar la consulta."));
        exit();
    }
    $stmt->bind_param("ssss", $nombre, $email, $telefono, $mensaje);

    if ($stmt->execute()) {
        // Enviar correo electrónico de confirmación
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Cambia esto por tu servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'mikirourke09@gmail.com'; // Cambia esto por tu correo
            $mail->Password = 'qzof dkvr reny zezb'; // Cambia esto por tu contraseña
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuración del correo
            $mail->setFrom('no-reply@example.com', 'Formulario de Contacto'); // Cambia esto por un correo válido
            $mail->addAddress($email); // Enviar al correo del usuario
            $mail->addAddress('mikirourke09@gmail.com'); // Enviar al correo designado (administrador)

            $mail->isHTML(true);
            $mail->Subject = 'Confirmación de envío de contacto';
            $mail->Body = "
                <html>
                <head>
                    <title>Confirmación de Contacto</title>
                </head>
                <body>
                    <h2>Gracias por contactarnos, $nombre</h2>
                    <p>Hemos recibido tu mensaje y nos pondremos en contacto contigo lo antes posible.</p>
                    <p><strong>Detalles del mensaje:</strong></p>
                    <p><strong>Nombre:</strong> $nombre</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Teléfono:</strong> $telefono</p>
                    <p><strong>Mensaje:</strong> $mensaje</p>
                </body>
                </html>
            ";

            $mail->send();

            // Redirigir con mensaje de éxito
            header("Location: apicontactenos.php?status=success");
            exit();
        } catch (Exception $e) {
            // Redirigir con mensaje de error si el correo falla
            header("Location: apicontactenos.php?status=error&message=" . urlencode("Error al enviar el correo: " . $mail->ErrorInfo));
            exit();
        }
    } else {
        // Redirigir con mensaje de error si la base de datos falla
        header("Location: apicontactenos.php?status=error&message=" . urlencode("Error al guardar los datos: " . $stmt->error));
        exit();
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    // Si no es una solicitud POST, redirigir al formulario
    header("Location: apicontactenos.php");
    exit();
}
?>

<?php if (isset($_GET['status'])): ?>
    <div class="alert alert-<?php echo $_GET['status'] === 'success' ? 'success' : 'danger'; ?> mt-3">
        <?php echo htmlspecialchars(urldecode($_GET['message'] ?? ($_GET['status'] === 'success' ? 'Mensaje enviado correctamente.' : 'Ocurrió un error.'))); ?>
    </div>
<?php endif; ?>

<!-- Modal de Agradecimiento -->
<div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="thankYouModalLabel">¡Gracias por escribirnos!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hemos recibido tu mensaje y nos pondremos en contacto contigo lo antes posible.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>