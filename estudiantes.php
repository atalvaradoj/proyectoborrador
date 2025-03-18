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

// Inicializar variables de búsqueda
$search_term = '';
$selected_program = '';

// Procesar filtros de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Obtener términos de búsqueda si existen
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search_term = trim($_GET['search']);
    }

    // Obtener filtro de programa si existe
    if (isset($_GET['program']) && !empty($_GET['program'])) {
        $selected_program = $_GET['program'];
    }
}

// Construir la consulta SQL con filtros
$sql = "SELECT * FROM estudiantes WHERE 1=1";

// Añadir condiciones de búsqueda si existen
if (!empty($search_term)) {
    $search_term_escaped = $conn->real_escape_string($search_term);
    $sql .= " AND (ID_estudiante LIKE '%$search_term_escaped%' 
              OR Nombres LIKE '%$search_term_escaped%' 
              OR Apellidos LIKE '%$search_term_escaped%')";
}

// Añadir filtro de programa si existe
if (!empty($selected_program)) {
    $program_escaped = $conn->real_escape_string($selected_program);
    $sql .= " AND Grado = '$program_escaped'";
}

// Ordenar resultados
$sql .= " ORDER BY ID_estudiante DESC";

// Ejecutar consulta
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
            <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="searchForm">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" id="searchInput"
                                placeholder="Buscar estudiante por nombre o ID..."
                                value="<?php echo htmlspecialchars($search_term); ?>">
                            <button class="btn btn-primary" type="submit" id="searchBtn">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <select class="form-select" name="program" id="programFilter" onchange="document.getElementById('searchForm').submit();">
                            <option value="">Todos los grados</option>
                            <option value="Primer_grado" <?php echo ($selected_program == 'Primer_grado') ? 'selected' : ''; ?>>Primero</option>
                            <option value="Segundo_grado" <?php echo ($selected_program == 'Segundo_grado') ? 'selected' : ''; ?>>Segundo</option>
                            <option value="Tercer_grado" <?php echo ($selected_program == 'Tercer_grado') ? 'selected' : ''; ?>>Tercero</option>
                            <option value="Cuarto_grado" <?php echo ($selected_program == 'Cuarto_grado') ? 'selected' : ''; ?>>Cuarto</option>
                            <option value="Quinto_grado" <?php echo ($selected_program == 'Quinto_grado') ? 'selected' : ''; ?>>Quinto</option>
                            <option value="Sexto_grado" <?php echo ($selected_program == 'Sexto_grado') ? 'selected' : ''; ?>>Sexto</option>
                        </select>
                    </div>
                    <div class="col-md-2 text-md-end">
                        <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#addStudentModal" type="button">
                            <i class="fas fa-plus-circle me-1"></i> Nuevo
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabla de Estudiantes -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-user-graduate me-2"></i> Listado de Estudiantes
                <span class="badge bg-primary ms-2"><?php echo $result ? $result->num_rows : 0; ?> estudiantes</span>
                <?php if (!empty($search_term) || !empty($selected_program)): ?>
                    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="btn btn-sm btn-outline-secondary ms-2">
                        <i class="fas fa-times me-1"></i> Limpiar filtros
                    </a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if ($result && $result->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 10%">Foto</th>
                                    <th style="width: 15%">ID</th>
                                    <th style="width: 20%">Nombre</th>
                                    <th style="width: 20%">Grado</th>
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
                                        case 'Primer_grado':
                                            $program_name = 'Primero';
                                            break;
                                        case 'Segundo_grado':
                                            $program_name = 'Segundo';
                                            break;
                                        case 'Tercer_grado':
                                            $program_name = 'Tercero';
                                            break;
                                        case 'Cuarto_grado':
                                            $program_name = 'Cuarto';
                                            break;
                                        case 'Quinto_grado':
                                            $program_name = 'Quinto';
                                            break;
                                        case 'Sexto_grado':
                                            $program_name = 'Sexto';
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
                                            <button class="btn btn-sm btn-primary view-student"
                                                data-id="<?php echo htmlspecialchars($row['ID_estudiante']); ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewStudentModal">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning edit-student"
                                                data-id="<?php echo htmlspecialchars($student['ID_estudiante']); ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editStudentModal">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            
                                            <!-- Botón que abre el modal de confirmación para eliminar -->
                                            <button class="btn btn-sm btn-danger delete-student"
                                                data-id="<?php echo htmlspecialchars($row['ID_estudiante']); ?>"
                                                data-name="<?php echo htmlspecialchars($row['Nombres'] . ' ' . $row['Apellidos']); ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteStudentModal">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <?php if (!empty($search_term) || !empty($selected_program)): ?>
                            No se encontraron estudiantes con los criterios de búsqueda especificados.
                        <?php else: ?>
                            No hay estudiantes registrados en el sistema.
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Estudiante -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editStudentModalLabel">
                        <i class="fas fa-edit me-2"></i> Editar Estudiante
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="editStudentLoader" class="text-center">
                        <div class="spinner-border text-warning" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                        <p class="mt-2">Cargando información del estudiante...</p>
                    </div>

                    <form id="editStudentForm" method="post" action="controllers/update_student.php" enctype="multipart/form-data" style="display: none;">
                        <input type="hidden" id="editStudentId" name="studentId">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Foto del Estudiante</label>
                                    <div class="photo-preview" id="editPhotoPreview">
                                        <div class="photo-preview-text">
                                            <i class="fas fa-camera fa-2x mb-2"></i><br>
                                            Haga clic para seleccionar una foto
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" id="editStudentPhoto" name="studentPhoto" accept="image/*">
                                    <input type="hidden" id="currentPhoto" name="currentPhoto">
                                    <div class="form-text">Deje este campo vacío si no desea cambiar la foto actual.</div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editDocumentType" class="form-label">Tipo de Documento</label>
                                            <select class="form-select" id="editDocumentType" name="documentType" required>
                                                <option value="">Seleccione...</option>
                                                <option value="CC">Cédula de Ciudadanía</option>
                                                <option value="TI">Tarjeta de Identidad</option>
                                                <option value="CE">DIMEX</option>
                                                <option value="PP">Pasaporte</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editBirthDate" class="form-label">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" id="editBirthDate" name="birthDate" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editFirstName" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" id="editFirstName" name="firstName" placeholder="Ej: Juan Carlos" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editLastName" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="editLastName" name="lastName" placeholder="Ej: Pérez Gómez" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editGender" class="form-label">Género</label>
                                    <select class="form-select" id="editGender" name="gender" required>
                                        <option value="">Seleccione...</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                        <option value="O">Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editEmail" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="editEmail" name="email" placeholder="Ej: juan.perez@ejemplo.com" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editAddress" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="editAddress" name="address" placeholder="Ej: Calle 123 # 45-67" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editCity" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control" id="editCity" name="city" placeholder="Ej: Barva" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editProgram" class="form-label">Año escolar en cursar</label>
                                    <select class="form-select" id="editProgram" name="program" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Primer_grado">Primero</option>
                                        <option value="Segundo_grado">Segundo</option>
                                        <option value="Tercer_grado">Tercero</option>
                                        <option value="Cuarto_grado">Cuarto</option>
                                        <option value="Quinto_grado">Quinto</option>
                                        <option value="Sexto_grado">Sexto</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editAdmissionDate" class="form-label">Fecha de Ingreso</label>
                                    <input type="date" class="form-control" id="editAdmissionDate" name="admissionDate" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="editStatus" class="form-label">Estado</label>
                                    <select class="form-select" id="editStatus" name="status" required>
                                        <option value="active">Activo</option>
                                        <option value="inactive">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="editObservations" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="editObservations" name="observations" rows="3" placeholder="Ingrese cualquier observación relevante sobre el estudiante..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" id="updateStudentBtn">
                        <i class="fas fa-save me-1"></i> Guardar Cambios
                    </button>
                </div>
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
                                                <option value="CE">DIMEX</option>
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
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Ej: Barva" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="program" class="form-label">Año escolar en cursar</label>
                                    <select class="form-select" id="program" name="program" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Primer_grado">Primero</option>
                                        <option value="Segundo_grado">Segundo</option>
                                        <option value="Tercer_grado">Tercero</option>
                                        <option value="Cuarto_grado">Cuarto</option>
                                        <option value="Quinto_grado">Quinto</option>
                                        <option value="Sexto_grado">Sexto</option>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="viewStudentModalLabel">
                        <i class="fas fa-user me-2"></i> Detalles del Estudiante
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del modal de visualización -->
                    <div id="viewStudentContent">
                        <!-- El contenido se cargará dinámicamente -->
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                            <p class="mt-2">Cargando información del estudiante...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
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

            // Manejar el botón de guardar estudiante
            document.getElementById('saveStudentBtn').addEventListener('click', function() {
                // Mostrar indicador de carga
                this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...';
                this.disabled = true;

                // Enviar el formulario
                document.getElementById('addStudentForm').submit();
            });

            // Previsualización de la foto
            const photoInput = document.getElementById('studentPhoto');
            const photoPreview = document.getElementById('photoPreview');

            if (photoInput && photoPreview) {
                photoInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            photoPreview.innerHTML = `<img src="${e.target.result}" class="img-fluid preview-img" alt="Vista previa">`;
                            photoPreview.classList.add('has-image');
                        }

                        reader.readAsDataURL(this.files[0]);
                    } else {
                        photoPreview.innerHTML = `
                            <div class="photo-preview-text">
                                <i class="fas fa-camera fa-2x mb-2"></i><br>
                                Haga clic para seleccionar una foto
                            </div>
                        `;
                        photoPreview.classList.remove('has-image');
                    }
                });

                photoPreview.addEventListener('click', function() {
                    photoInput.click();
                });
            }

            // Búsqueda con tecla Enter
            document.getElementById('searchInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.getElementById('searchForm').submit();
                }
            });

            // Limpiar búsqueda al hacer clic en el campo si hay texto
            document.getElementById('searchInput').addEventListener('click', function() {
                if (this.value) {
                    const clearSearch = confirm('¿Desea limpiar el campo de búsqueda?');
                    if (clearSearch) {
                        this.value = '';
                    }
                }
            });
        });
    </script>

    <style>
        /* Estilos para la previsualización de la foto */
        .photo-preview {
            width: 100%;
            height: 200px;
            border: 2px dashed #ccc;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            cursor: pointer;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .photo-preview-text {
            text-align: center;
            color: #6c757d;
            padding: 20px;
        }

        .photo-preview.has-image {
            border: none;
            padding: 0;
        }

        .preview-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .student-photo {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        .badge-active {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .badge-inactive {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .action-buttons .btn {
            margin-right: 5px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: #6c757d;
            font-size: 16px;
        }

        .search-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</body>

</html>