<?php include "shared/header.php" ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprobar Solicitud</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Aprobar o Rechazar Solicitud</h2>

        <div class="card shadow">
            <div class="card-body">
                <form action="procesar_aprobacion.php" method="POST">
                    <div class="mb-3">
                        <label for="id_usuario" class="form-label">ID de Usuario:</label>
                        <input type="text" name="id_usuario" class="form-control" placeholder="Ingrese el ID del usuario" required>
                    </div>

                    <div class="mb-3">
                        <label for="rol" class="form-label">Selecciona el Rol:</label>
                        <select name="rol" class="form-select" required>
                            <option value="docentes">Docente</option>
                            <option value="padres">Padre/Madre</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="accion" class="form-label">Acción:</label>
                        <select name="accion" class="form-select" required>
                            <option value="aprobar">Aprobar</option>
                            <option value="rechazar">Rechazar</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<!-- Footer -->
<?php include "shared/footer.php"; ?>