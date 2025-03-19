<?php
// includes/messages.php

// Iniciar sesión para poder almacenar mensajes entre redirecciones
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si hay mensajes almacenados en la sesión
$showMessage = false;
$messageType = '';
$messageText = '';

// Comprobar si hay un mensaje de éxito en la sesión
if (isset($_SESSION['success_message'])) {
    $showMessage = true;
    $messageType = 'success';
    $messageText = $_SESSION['success_message'];
    
    // Eliminar el mensaje de la sesión para que no se muestre nuevamente
    unset($_SESSION['success_message']);
    
    // Configurar redirección después de 3 segundos si se especifica una URL
    if (isset($_SESSION['redirect_url'])) {
        echo '<script>
            setTimeout(function() {
                window.location.href = "' . $_SESSION['redirect_url'] . '";
            }, 3000);
        </script>';
        unset($_SESSION['redirect_url']);
    }
}

// Comprobar si hay un mensaje de error en la sesión
if (isset($_SESSION['error_message'])) {
    $showMessage = true;
    $messageType = 'danger';
    $messageText = $_SESSION['error_message'];
    
    // Eliminar el mensaje de la sesión para que no se muestre nuevamente
    unset($_SESSION['error_message']);
}

// Mostrar el mensaje si existe
if ($showMessage) {
    echo '<div class="alert alert-' . $messageType . ' alert-dismissible fade show message-box" role="alert">
            <strong>' . ($messageType == 'success' ? '¡Éxito!' : '¡Error!') . '</strong> ' . htmlspecialchars($messageText) . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}
?>
