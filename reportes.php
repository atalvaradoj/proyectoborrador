<?php
session_start();
include 'includes/db_config.php';
$conn = getConnection();

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['user_role'], ['padres', 'admin'])) {
    header("Location: login.php");
    exit;
}

$rol = $_SESSION['user_role'];
$ID_usuario = $_SESSION['user_id'];

if ($rol === 'padres') {
    $query = $conn->prepare("SELECT ID_estudiante FROM padres_estudiantes WHERE ID_usuario = ?");
    $query->bind_param("s", $ID_usuario);
    $query->execute();
    $res = $query->get_result();
    if ($res->num_rows === 0) {
        echo "<div class='alert alert-warning text-center mt-5'>No tiene hijos asignados.</div>";
        exit;
    }
    $ID_estudiante = $res->fetch_assoc()['ID_estudiante'];
} else {
    if (isset($_GET['estudiante'])) {
        $ID_estudiante = $_GET['estudiante'];
    } else {
        $estudiantes = $conn->query("SELECT ID_estudiante, CONCAT(Nombres, ' ', Apellidos) AS NombreCompleto FROM estudiantes");
        echo "<div class='container mt-5'>";
        echo "<div class='card p-4 shadow-lg'>";
        echo "<h3 class='mb-4'><i class='fas fa-user-graduate me-2'></i>Seleccionar Estudiante</h3>";
        echo "<form method='GET'>";
        echo "<select name='estudiante' class='form-select mb-3' required>";
        echo "<option value=''>-- Seleccionar Estudiante --</option>";
        while ($row = $estudiantes->fetch_assoc()) {
            echo "<option value='{$row['ID_estudiante']}'>{$row['NombreCompleto']}</option>";
        }
        echo "</select>";
        echo "<button type='submit' class='btn btn-primary w-100'><i class='fas fa-search me-2'></i>Ver Reporte</button>";
        echo "</form></div></div>";
        exit;
    }
}

$notasQuery = $conn->prepare("SELECT e.Nombres AS Estudiante, n.Materia, n.Nota, n.Asistencia
                              FROM notas n
                              JOIN estudiantes e ON n.ID_estudiante = e.ID_estudiante
                              WHERE n.ID_estudiante = ?");
$notasQuery->bind_param("s", $ID_estudiante);
$notasQuery->execute();
$notas = $notasQuery->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-body-secondary">

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0 text-primary">
                <i class="fas fa-chart-line me-2"></i>Reporte Académico
            </h3>
            <form method="post" action="generar_reporte.php">
                <input type="hidden" name="ID_estudiante" value="<?= $ID_estudiante ?>">
                <button type="submit" class="btn btn-outline-success">
                    <i class="fas fa-file-pdf me-2"></i>Generar PDF
                </button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Estudiante</th>
                        <th>Materia</th>
                        <th>Nota</th>
                        <th>Asistencia (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($notas->num_rows > 0): ?>
                        <?php while ($row = $notas->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['Estudiante']) ?></td>
                                <td><?= htmlspecialchars($row['Materia']) ?></td>
                                <td><?= htmlspecialchars($row['Nota']) ?></td>
                                <td><?= htmlspecialchars($row['Asistencia']) ?>%</td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No hay notas registradas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
