<?php include "shared/header.php" ?>

<style>
    /* Estilos con colores celeste y blanco */
    .container h1 {
        color: #0099cc;
    }

    .card {
        border-color: #0099cc;
        box-shadow: 0 3px 6px rgba(0, 153, 204, 0.1);
    }

    .card-title {
        color: #0099cc;
    }

    .btn-primary {
        background-color: #0099cc;
        border-color: #0099cc;
    }

    .btn-primary:hover {
        background-color: #007bff;
        border-color: #007bff;
    }

    .card-body h5 {
        color: #0099cc;
    }

    .bg-light-blue {
        background-color: #e6f7ff;
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
            $mensaje = '<div class="alert alert-success mt-3">¡Gracias por compartir tu testimonio!</div>';
        } else {
            $mensaje = '<div class="alert alert-danger mt-3">Hubo un problema al guardar tu testimonio.</div>';
        }
    } else {
        $mensaje = '<div class="alert alert-warning mt-3">Por favor completa todos los campos.</div>';
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center">Testimonios</h1>

    <?php if (!empty($mensaje))
        echo $mensaje; ?>

    <!-- Formulario simple para testimonios -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body bg-light-blue">
                    <h5 class="card-title">Comparte tu experiencia</h5>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <input type="text" class="form-control mb-3" name="nombre" placeholder="Tu nombre" required>
                            <textarea class="form-control" name="testimonio" rows="4"
                                placeholder="Escribe tu testimonio aquí" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonios de ejemplo -->
    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>Ana García</h5>
                    <p>Excelente servicio, muy recomendado.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>Carlos Rodríguez</h5>
                    <p>Muy satisfecho con la atención recibida.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>Laura Martínez</h5>
                    <p>Los resultados superaron mis expectativas.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "shared/footer.php" ?>