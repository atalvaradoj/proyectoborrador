<?php
// Iniciar sesión para manejar mensajes
session_start();

// Asegurarse de que el archivo header.php existe
if (file_exists("shared/header.php")) {
    include "shared/header.php";
}

// Incluir archivo de configuración de la base de datos
include "includes/db_config.php";

// Obtener conexión a la base de datos
$conn = getConnection();

// Consulta SQL para obtener todos los estudiantes
$sql = "SELECT * FROM estudiantes ORDER BY ID_estudiante DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Estudiantes - Sistema Académico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container mt-4 mb-5">
        <?php
        // Mostrar mensajes de éxito o error
        if (isset($_SESSION['success_message'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>' . $_SESSION['success_message'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            unset($_SESSION['success_message']);
        }

        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>' . $_SESSION['error_message'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            unset($_SESSION['error_message']);
        }
        ?>

        <div class="page-header">
            <h1 class="page-title">Administración de Estudiantes</h1>
            <p class="page-subtitle">Gestión completa de la información de estudiantes</p>
        </div>

        <!-- Buscador y Filtros -->
        <div class="search-container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar estudiante por nombre, ID o programa...">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <select class="form-select">
                        <option value="">Todos los programas</option>
                        <option value="ing_sistemas">Ingeniería de Sistemas</option>
                        <option value="ing_industrial">Ingeniería Industrial</option>
                        <option value="administracion">Administración de Empresas</option>
                        <option value="contaduria">Contaduría Pública</option>
                        <option value="derecho">Derecho</option>
                        <option value="medicina">Medicina</option>
                    </select>
                </div>
                <div class="col-md-2 text-md-end">
                    <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                        <i class="fas fa-plus-circle me-1"></i> Nuevo
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabla de Estudiantes -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-user-graduate me-2"></i> Listado de Estudiantes
                <span class="badge bg-primary ms-2"><?php echo $result->num_rows; ?> estudiantes</span>
            </div>
            <div class="card-body">
                <?php if ($result->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 10%">Foto</th>
                                    <th style="width: 15%">ID</th>
                                    <th style="width: 20%">Nombre</th>
                                    <th style="width: 20%">Programa</th>
                                    <th style="width: 10%">Estado</th>
                                    <th style="width: 20%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 1;
                                while ($row = $result->fetch_assoc()):
                                    // Mapear el valor del programa a un nombre legible
                                    $program_name = '';
                                    switch ($row['Grado']) {
                                        case 'ing_sistemas':
                                            $program_name = 'Ingeniería de Sistemas';
                                            break;
                                        case 'ing_industrial':
                                            $program_name = 'Ingeniería Industrial';
                                            break;
                                        case 'administracion':
                                            $program_name = 'Administración de Empresas';
                                            break;
                                        case 'contaduria':
                                            $program_name = 'Contaduría Pública';
                                            break;
                                        case 'derecho':
                                            $program_name = 'Derecho';
                                            break;
                                        case 'medicina':
                                            $program_name = 'Medicina';
                                            break;
                                        default:
                                            $program_name = $row['Grado'];
                                    }

                                    // Determinar la imagen a mostrar
                                    $photo_url = !empty($row['Foto']) && file_exists($row['Foto'])
                                        ? $row['Foto']
                                        : 'img/sombrero-de-graduacion.png';
                                ?>
                                    <tr data-id="<?php echo htmlspecialchars($row['ID_estudiante']); ?>">
                                        <td><?php echo $counter++; ?></td>
                                        <td>
                                            <img src="<?php echo htmlspecialchars($photo_url); ?>" class="student-photo" alt="Foto de <?php echo htmlspecialchars($row['Nombres']); ?>">
                                        </td>
                                        <td><?php echo htmlspecialchars($row['ID_estudiante']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Apellidos'] . ', ' . $row['Nombres']); ?></td>
                                        <td><?php echo htmlspecialchars($program_name); ?></td>
                                        <td>
                                            <?php if ($row['Estado'] == 'active'): ?>
                                                <span class="badge-active">Activo</span>
                                            <?php else: ?>
                                                <span class="badge-inactive">Inactivo</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="action-buttons">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewStudentModal">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editStudentModal">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- OPCIÓN 1: Botón que abre el modal de confirmación -->
                                            <button class="btn btn-sm btn-danger delete-student"
                                                data-id="<?php echo htmlspecialchars($row['ID_estudiante']); ?>"
                                                data-name="<?php echo htmlspecialchars($row['Nombres'] . ' ' . $row['Apellidos']); ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteStudentModal">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <!-- OPCIÓN 2: Enlace directo para eliminar (alternativa) -->
                                            <!--
                                            <a href="delete_student_direct.php?id=<?php echo htmlspecialchars($row['ID_estudiante']); ?>" 
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('¿Está seguro de que desea eliminar a <?php echo htmlspecialchars($row['Nombres'] . ' ' . $row['Apellidos']); ?>?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            -->
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> No hay estudiantes registrados en el sistema.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Estudiante -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addStudentModalLabel">
                        <i class="fas fa-user-plus me-2"></i> Agregar Nuevo Estudiante
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm" method="post" action="save_student.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Foto del Estudiante</label>
                                    <div class="photo-preview" id="photoPreview">
                                        <div class="photo-preview-text">
                                            <i class="fas fa-camera fa-2x mb-2"></i><br>
                                            Haga clic para seleccionar una foto
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" id="studentPhoto" name="studentPhoto" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="studentId" class="form-label">ID Estudiante</label>
                                            <input type="text" class="form-control" id="studentId" name="studentId" placeholder="Ej: 20230006" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="documentType" class="form-label">Tipo de Documento</label>
                                            <select class="form-select" id="documentType" name="documentType" required>
                                                <option value="">Seleccione...</option>
                                                <option value="CC">Cédula de Ciudadanía</option>
                                                <option value="TI">Tarjeta de Identidad</option>
                                                <option value="CE">Cédula de Extranjería</option>
                                                <option value="PP">Pasaporte</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="birthDate" class="form-label">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" id="birthDate" name="birthDate" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Ej: Juan Carlos" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Ej: Pérez Gómez" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Género</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="">Seleccione...</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                        <option value="O">Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Ej: juan.perez@ejemplo.com" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Ej: Calle 123 # 45-67" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Ej: Bogotá" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="program" class="form-label">Programa Académico</label>
                                    <select class="form-select" id="program" name="program" required>
                                        <option value="">Seleccione...</option>
                                        <option value="ing_sistemas">Ingeniería de Sistemas</option>
                                        <option value="ing_industrial">Ingeniería Industrial</option>
                                        <option value="administracion">Administración de Empresas</option>
                                        <option value="contaduria">Contaduría Pública</option>
                                        <option value="derecho">Derecho</option>
                                        <option value="medicina">Medicina</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="admissionDate" class="form-label">Fecha de Ingreso</label>
                                    <input type="date" class="form-control" id="admissionDate" name="admissionDate" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Estado</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="active">Activo</option>
                                        <option value="inactive">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="observations" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observations" name="observations" rows="3" placeholder="Ingrese cualquier observación relevante sobre el estudiante..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="saveStudentBtn">
                        <i class="fas fa-save me-1"></i> Guardar Estudiante
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Ver Estudiante -->
    <div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
        <!-- Contenido del modal de visualización (sin cambios) -->
        <!-- ... -->
    </div>

    <!-- Modal para Eliminar Estudiante -->
    <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteStudentModalLabel">
                        <i class="fas fa-trash me-2"></i> Eliminar Estudiante
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar al estudiante <strong id="deleteStudentName"></strong>?</p>
                    <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Esta acción no se puede deshacer.</p>
                    <form id="deleteStudentForm" method="post" action="delete_student.php">
                        <input type="hidden" id="deleteStudentId" name="studentId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-trash me-1"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap y JavaScript personalizado -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configurar el modal de eliminación
            const deleteButtons = document.querySelectorAll('.delete-student');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const studentId = this.getAttribute('data-id');
                    const studentName = this.getAttribute('data-name');

                    // Actualizar el modal con la información del estudiante
                    document.getElementById('deleteStudentId').value = studentId;
                    document.getElementById('deleteStudentName').textContent = studentName;
                });
            });

            // Manejar el botón de confirmación de eliminación
            document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                // Mostrar indicador de carga
                this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Eliminando...';
                this.disabled = true;

                // Enviar el formulario
                document.getElementById('deleteStudentForm').submit();
            });
        });
    </script>
</body>

</html>