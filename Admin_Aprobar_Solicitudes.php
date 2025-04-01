<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprobar Solicitud</title>
</head>
<body>
    <h2>Aprobar o Rechazar Solicitud</h2>

    <form action="procesar_aprobacion.php" method="POST">
        <label for="id_usuario">ID de Usuario:</label>
        <input type="text" name="id_usuario" required>

        <label for="rol">Selecciona el Rol:</label>
        <select name="rol" required>
            <option value="docentes">Docente</option>
            <option value="padres">Padre/Madre</option>
            <option value="admin">Administrador</option>
        </select>

        <label for="accion">Acción:</label>
        <select name="accion" required>
            <option value="aprobar">Aprobar</option>
            <option value="rechazar">Rechazar</option>
        </select>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
