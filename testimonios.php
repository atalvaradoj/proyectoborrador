<?php include "shared/header.php" ?>

<style>
    /* Estilos con colores que coinciden con la página de registro */
    .container h1 {
        color: #007bff;
    }

    .card {
        border-color: #007bff;
        box-shadow: 0 3px 6px rgba(0, 123, 255, 0.1);
    }

    .card-title {
        color: #007bff;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .card-body h5 {
        color: #007bff;
    }

    .bg-light-blue {
        background-color: #f0f7ff;
    }

    .table-primary {
        background-color: #007bff;
        color: white;
    }

    .modal-header {
        background-color: #007bff;
        color: white;
    }
</style>

<?php
// Procesamiento del formulario
$mensaje = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y sanitizar los datos
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $testimonio = filter_input(INPUT_POST, 'testimonio', FILTER_SANITIZE_STRING);

    // Verificar que los campos no estén vacíos
    if (!empty($nombre) && !empty($testimonio)) {
        // Aquí normalmente conectarías con una base de datos
        // Por ahora, guardaremos en un archivo de texto como ejemplo
        $nuevo_testimonio = "Nombre: $nombre\nTestimonio: $testimonio\nFecha: " . date('Y-m-d H:i:s') . "\n---\n";

        if (file_put_contents('testimonios.txt', $nuevo_testimonio, FILE_APPEND | LOCK_EX)) {
            $mensaje = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i>¡Gracias por compartir tu testimonio!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
        } else {
            $mensaje = '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>Hubo un problema al guardar tu testimonio.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
        }
    } else {
        $mensaje = '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>Por favor completa todos los campos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Testimonios</h1>

    <?php if (!empty($mensaje))
        echo $mensaje; ?>

    <!-- Formulario simple para testimonios -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Comparte tu experiencia</h5>
                </div>
                <div class="card-body bg-light-blue">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <input type="text" class="form-control mb-3" name="nombre" placeholder="Tu nombre" required>
                            <textarea class="form-control" name="testimonio" rows="4"
                                placeholder="Escribe tu testimonio aquí" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i> Enviar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonios de ejemplo -->
    <h3 class="text-center mt-5 mb-4" style="color: #007bff;">Lo que dicen nuestros clientes</h3>
    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5>Ana García</h5>
                    <p>Excelente servicio, muy recomendado.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5>Carlos Rodríguez</h5>
                    <p>Muy satisfecho con la atención recibida.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5>Laura Martínez</h5>
                    <p>Los resultados superaron mis expectativas.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "shared/footer.php" ?>