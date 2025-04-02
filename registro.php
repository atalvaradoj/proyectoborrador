<?php include "shared/header.php"; ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Botón para abrir el modal -->
<button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addDocenteModal">
    <i class="fas fa-chalkboard-teacher me-2"></i>Agregar Docente
</button>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .tab-content {
            margin-top: 20px;
        }

        .table-container {
            margin-top: 20px;
        }

        .btn-add {
            margin-bottom: 20px;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Sistema de Administración Escolar</h1>

        <?php
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

        <!-- Pestañas de navegación -->
        <ul class="nav nav-tabs" id="adminTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="usuarios-tab" data-bs-toggle="tab" href="#usuarios"
                    role="tab">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="docentes-tab" data-bs-toggle="tab" href="#docentes" role="tab">Docentes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="estudiantes-tab" data-bs-toggle="tab" href="#estudiantes"
                    role="tab">Estudiantes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="grupos-tab" data-bs-toggle="tab" href="#grupos" role="tab">Grupos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="notas-tab" data-bs-toggle="tab" href="#notas" role="tab">Notas</a>
            </li>
        </ul>

        <!-- Contenido de las pestañas -->
        <div class="tab-content">
            <!-- Administración de Usuarios -->
            <div class="tab-pane fade show active" id="usuarios" role="tabpanel">
                <h3>Administración de Usuarios</h3>
                <button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-user-plus me-2"></i>Agregar Usuario
                </button>
                <div class="table-container">
                    <table class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí irían los datos dinámicos -->
                            <tr>
                                <td>1</td>
                                <td>Juan Pérez</td>
                                <td>juan.perez@example.com</td>
                                <td>Administrador</td>
                                <td>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Administración de Docentes -->
            <div class="tab-pane fade" id="docentes" role="tabpanel">
                <h3>Administración de Docentes</h3>
                <button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addDocenteModal">
                    <i class="fas fa-chalkboard-teacher me-2"></i>Agregar Docente
                </button>
                <div class="table-container">
                    <table class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Especialidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Conexión a la base de datos
                            include "includes/db_config.php";
                            $conn = getConnection();

                            // Consulta para obtener los docentes
                            $sql = "SELECT * FROM docentes ORDER BY ID_docente DESC";
                            $result = $conn->query($sql);

                            if ($result && $result->num_rows > 0):
                                while ($row = $result->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['ID_docente']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Nombres'] . ' ' . $row['Apellidos']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Correo']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Especialidad']); ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-teacher"
                                                data-id="<?php echo htmlspecialchars($row['ID_docente']); ?>"
                                                data-firstname="<?php echo htmlspecialchars($row['Nombres']); ?>"
                                                data-lastname="<?php echo htmlspecialchars($row['Apellidos']); ?>"
                                                data-email="<?php echo htmlspecialchars($row['Correo']); ?>"
                                                data-specialty="<?php echo htmlspecialchars($row['Especialidad']); ?>"
                                                data-other-specialty="<?php echo htmlspecialchars($row['Otra_especialidad']); ?>"
                                                data-comments="<?php echo htmlspecialchars($row['Comentarios']); ?>"
                                                data-bs-toggle="modal" data-bs-target="#editDocenteModal">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                            <button class="btn btn-danger btn-sm delete-teacher"
                                                data-id="<?php echo htmlspecialchars($row['ID_docente']); ?>"
                                                data-bs-toggle="modal" data-bs-target="#deleteDocenteModal">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                endwhile;
                            else:
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center">No hay docentes registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal para Agregar Docente -->
            <div class="modal fade" id="addDocenteModal" tabindex="-1" aria-labelledby="addDocenteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="addDocenteModalLabel">
                                <i class="fas fa-user-plus me-2"></i> Agregar Nuevo Docente
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addDocenteForm" method="post" action="controllers/save_teacher.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="teacherId" class="form-label">ID Docente</label>
                                            <input type="text" class="form-control" id="teacherId" name="ID_docente"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="teacherEmail" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="teacherEmail" name="Correo"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="teacherFirstName" class="form-label">Nombres</label>
                                            <input type="text" class="form-control" id="teacherFirstName" name="Nombres"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="teacherLastName" class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" id="teacherLastName"
                                                name="Apellidos" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="teacherSpecialty" class="form-label">Especialidad</label>
                                    <select class="form-select" id="teacherSpecialty" name="Especialidad" required>
                                        <option value="Español">Español</option>
                                        <option value="Matemáticas">Matemáticas</option>
                                        <option value="Ciencias">Ciencias</option>
                                        <option value="Estudios Sociales">Estudios Sociales</option>
                                        <option value="Artes Industriales">Artes Industriales</option>
                                        <option value="Inglés">Inglés</option>
                                        <option value="Cómputo">Cómputo</option>
                                        <option value="Otra">Otra</option>
                                    </select>
                                </div>
                                <div class="mb-3" id="otherSpecialtyContainer" style="display: none;">
                                    <label for="teacherOtherSpecialty" class="form-label">Otra Especialidad</label>
                                    <input type="text" class="form-control" id="teacherOtherSpecialty"
                                        name="Otra_especialidad">
                                </div>
                                <div class="mb-3">
                                    <label for="teacherComments" class="form-label">Comentarios</label>
                                    <textarea class="form-control" id="teacherComments" name="Comentarios"
                                        rows="3"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success" form="addDocenteForm">
                                <i class="fas fa-save me-1"></i> Guardar Docente
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para Eliminar Docente -->
            <div class="modal fade" id="deleteDocenteModal" tabindex="-1" aria-labelledby="deleteDocenteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="deleteDocenteModalLabel">
                                <i class="fas fa-trash me-2"></i> Eliminar Docente
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro de que desea eliminar este docente?</p>
                            <form id="deleteDocenteForm" method="post" action="controllers/delete_teacher.php">
                                <input type="hidden" id="deleteTeacherId" name="ID_docente">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" form="deleteDocenteForm">
                                <i class="fas fa-trash me-1"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para Editar Docente -->
            <div class="modal fade" id="editDocenteModal" tabindex="-1" aria-labelledby="editDocenteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="editDocenteModalLabel">
                                <i class="fas fa-edit me-2"></i> Editar Docente
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editDocenteForm" method="post" action="controllers/update_teacher.php">
                                <input type="hidden" id="editTeacherId" name="ID_docente">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editTeacherFirstName" class="form-label">Nombres</label>
                                            <input type="text" class="form-control" id="editTeacherFirstName"
                                                name="Nombres" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editTeacherLastName" class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" id="editTeacherLastName"
                                                name="Apellidos" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editTeacherEmail" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="editTeacherEmail" name="Correo"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editTeacherSpecialty" class="form-label">Especialidad</label>
                                            <select class="form-select" id="editTeacherSpecialty" name="Especialidad"
                                                required>
                                                <option value="Español">Español</option>
                                                <option value="Matemáticas">Matemáticas</option>
                                                <option value="Ciencias">Ciencias</option>
                                                <option value="Estudios Sociales">Estudios Sociales</option>
                                                <option value="Artes Industriales">Artes Industriales</option>
                                                <option value="Inglés">Inglés</option>
                                                <option value="Cómputo">Cómputo</option>
                                                <option value="Otra">Otra</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3" id="editOtherSpecialtyContainer" style="display: none;">
                                    <label for="editTeacherOtherSpecialty" class="form-label">Otra Especialidad</label>
                                    <input type="text" class="form-control" id="editTeacherOtherSpecialty"
                                        name="Otra_especialidad">
                                </div>
                                <div class="mb-3">
                                    <label for="editTeacherComments" class="form-label">Comentarios</label>
                                    <textarea class="form-control" id="editTeacherComments" name="Comentarios"
                                        rows="3"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-warning" form="editDocenteForm">
                                <i class="fas fa-save me-1"></i> Guardar Cambios
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Administración de Estudiantes -->
            <div class="tab-pane fade" id="estudiantes" role="tabpanel">
                <h3>Administración de Estudiantes</h3>
                <button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addEstudianteModal">
                    <i class="fas fa-user-graduate me-2"></i>Agregar Estudiante
                </button>
                <div class="table-container">
                    <table class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Grado</th>
                                <th>Foto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // Consulta para obtener los estudiantes
                            $sql = "SELECT * FROM estudiantes ORDER BY ID_estudiante DESC";
                            $result = $conn->query($sql);

                            if ($result && $result->num_rows > 0):
                                while ($row = $result->fetch_assoc()):
                                    $photo_url = !empty($row['Foto']) && file_exists($row['Foto']) ? $row['Foto'] : 'img/sombrero-de-graduacion.png';
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['ID_estudiante']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Nombres'] . ' ' . $row['Apellidos']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Correo']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Grado']); ?></td>
                                        <td><img src="<?php echo htmlspecialchars($photo_url); ?>" alt="Foto" width="50"
                                                class="rounded-circle"></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-student"
                                                data-id="<?php echo htmlspecialchars($row['ID_estudiante']); ?>"
                                                data-firstname="<?php echo htmlspecialchars($row['Nombres']); ?>"
                                                data-lastname="<?php echo htmlspecialchars($row['Apellidos']); ?>"
                                                data-email="<?php echo htmlspecialchars($row['Correo']); ?>"
                                                data-program="<?php echo htmlspecialchars($row['Grado']); ?>"
                                                data-bs-toggle="modal" data-bs-target="#editEstudianteModal">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                            <button class="btn btn-danger btn-sm delete-student"
                                                data-id="<?php echo htmlspecialchars($row['ID_estudiante']); ?>"
                                                data-bs-toggle="modal" data-bs-target="#deleteEstudianteModal">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                endwhile;
                            else:
                                ?>
                                <tr>
                                    <td colspan="6" class="text-center">No hay estudiantes registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal para Agregar Estudiante -->
            <div class="modal fade" id="addEstudianteModal" tabindex="-1" aria-labelledby="addEstudianteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="addEstudianteModalLabel">
                                <i class="fas fa-user-plus me-2"></i> Agregar Nuevo Estudiante
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addEstudianteForm" method="post" action="controllers/save_student.php"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="studentId" class="form-label">ID Estudiante</label>
                                            <input type="text" class="form-control" id="studentId" name="ID_estudiante"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="studentPhoto" class="form-label">Foto</label>
                                            <input type="file" class="form-control" id="studentPhoto" name="Foto"
                                                accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="Nombres" class="form-label">Nombres</label>
                                            <input type="text" class="form-control" id="Nombres" name="Nombres"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="Apellidos" class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" id="Apellidos" name="Apellidos"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="Correo" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="Correo" name="Correo" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="Grado" class="form-label">Grado</label>
                                            <select class="form-select" id="Grado" name="Grado" required>
                                                <option value="Primer_grado">Primero</option>
                                                <option value="Segundo_grado">Segundo</option>
                                                <option value="Tercer_grado">Tercero</option>
                                                <option value="Cuarto_grado">Cuarto</option>
                                                <option value="Quinto_grado">Quinto</option>
                                                <option value="Sexto_grado">Sexto</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="Comentarios" class="form-label">Comentarios</label>
                                    <textarea class="form-control" id="Comentarios" name="Comentarios"
                                        rows="3"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success" form="addEstudianteForm">
                                <i class="fas fa-save me-1"></i> Guardar Estudiante
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para Editar Estudiante -->
            <div class="modal fade" id="editEstudianteModal" tabindex="-1" aria-labelledby="editEstudianteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="editEstudianteModalLabel">
                                <i class="fas fa-edit me-2"></i> Editar Estudiante
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editEstudianteForm" method="post" action="controllers/update_student.php"
                                enctype="multipart/form-data">
                                <input type="hidden" id="editStudentId" name="studentId">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editFirstName" class="form-label">Nombres</label>
                                            <input type="text" class="form-control" id="editFirstName" name="firstName"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editLastName" class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" id="editLastName" name="lastName"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editEmail" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="editEmail" name="email"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editProgram" class="form-label">Grado</label>
                                            <select class="form-select" id="editProgram" name="program" required>
                                                <option value="Primer_grado">Primero</option>
                                                <option value="Segundo_grado">Segundo</option>
                                                <option value="Tercer_grado">Tercero</option>
                                                <option value="Cuarto_grado">Cuarto</option>
                                                <option value="Quinto_grado">Quinto</option>
                                                <option value="Sexto_grado">Sexto</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="editObservations" class="form-label">Comentarios</label>
                                    <textarea class="form-control" id="editObservations" name="observations"
                                        rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="editPhoto" class="form-label">Actualizar Foto</label>
                                    <input type="file" class="form-control" id="editPhoto" name="Foto" accept="image/*">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-warning" form="editEstudianteForm">
                                <i class="fas fa-save me-1"></i> Guardar Cambios
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para Eliminar Estudiante -->
            <div class="modal fade" id="deleteEstudianteModal" tabindex="-1"
                aria-labelledby="deleteEstudianteModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="deleteEstudianteModalLabel">
                                <i class="fas fa-trash me-2"></i> Eliminar Estudiante
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro de que desea eliminar este estudiante?</p>
                            <form id="deleteEstudianteForm" method="post" action="controllers/delete_student.php">
                                <input type="hidden" id="deleteStudentId" name="studentId">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" form="deleteEstudianteForm">
                                <i class="fas fa-trash me-1"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Administración de Grupos -->
            <div class="tab-pane fade" id="grupos" role="tabpanel">
                <h3>Administración de Grupos</h3>
                <button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addGrupoModal">
                    <i class="fas fa-users-cog me-2"></i>Agregar Grupo
                </button>
                <div class="table-container">
                    <p>Tabla de grupos pendiente de implementar.</p>
                </div>
            </div>

            <!-- Administración de Notas -->
            <div class="tab-pane fade" id="notas" role="tabpanel">
                <h3>Administración de Notas</h3>
                <button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addNotaModal">
                    <i class="fas fa-book me-2"></i>Agregar Nota
                </button>
                <div class="table-container">
                </div>
            </div>

            <!-- Scripts para el CRUD de Docentes -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const specialtySelect = document.getElementById('teacherSpecialty');
                    const otherSpecialtyContainer = document.getElementById('otherSpecialtyContainer');
                    const otherSpecialtyInput = document.getElementById('teacherOtherSpecialty');

                    specialtySelect.addEventListener('change', function () {
                        if (this.value === 'Otra') {
                            otherSpecialtyContainer.style.display = 'block';
                            otherSpecialtyInput.required = true;
                        } else {
                            otherSpecialtyContainer.style.display = 'none';
                            otherSpecialtyInput.required = false;
                            otherSpecialtyInput.value = ''; // Limpiar el campo
                        }
                    });
                });
            </script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

            <!-- // Script para editar estudinate -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const editButtons = document.querySelectorAll('.edit-student');
                    const editStudentIdInput = document.getElementById('editStudentId');
                    const editFirstNameInput = document.getElementById('editFirstName');
                    const editLastNameInput = document.getElementById('editLastName');
                    const editEmailInput = document.getElementById('editEmail');
                    const editProgramSelect = document.getElementById('editProgram');
                    const editObservationsTextarea = document.getElementById('editObservations');

                    editButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const studentId = this.getAttribute('data-id');
                            const firstName = this.getAttribute('data-firstname');
                            const lastName = this.getAttribute('data-lastname');
                            const email = this.getAttribute('data-email');
                            const program = this.getAttribute('data-program');
                            const observations = this.getAttribute('data-observations');

                            // Cargar los datos en el formulario
                            editStudentIdInput.value = studentId;
                            editFirstNameInput.value = firstName;
                            editLastNameInput.value = lastName;
                            editEmailInput.value = email;
                            editProgramSelect.value = program;
                            editObservationsTextarea.value = observations;
                        });
                    });
                });
            </script>



            <!-- //Script para eliminar estudiante -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const deleteButtons = document.querySelectorAll('.delete-student');
                    const deleteStudentIdInput = document.getElementById('deleteStudentId');

                    deleteButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const studentId = this.getAttribute('data-id');
                            deleteStudentIdInput.value = studentId;
                        });
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const hash = window.location.hash; // Obtener el hash de la URL
                    const defaultTab = document.querySelector('a[href="#usuarios"]'); // Pestaña predeterminada (Usuarios)

                    if (hash) {
                        const tab = document.querySelector(`a[href="${hash}"]`);
                        if (tab) {
                            const tabInstance = new bootstrap.Tab(tab);
                            tabInstance.show(); // Mostrar la pestaña correspondiente al hash
                        }
                    } else {
                        // Si no hay hash, activa la pestaña predeterminada
                        const defaultTabInstance = new bootstrap.Tab(defaultTab);
                        defaultTabInstance.show();
                    }
                });
            </script>

            <!-- // Script para manejar los modales eliminar y editar docente  -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Manejar el modal de edición
                    const editButtons = document.querySelectorAll('.edit-teacher');
                    const editTeacherIdInput = document.getElementById('editTeacherId');
                    const editTeacherFirstNameInput = document.getElementById('editTeacherFirstName');
                    const editTeacherLastNameInput = document.getElementById('editTeacherLastName');
                    const editTeacherEmailInput = document.getElementById('editTeacherEmail');
                    const editTeacherSpecialtySelect = document.getElementById('editTeacherSpecialty');
                    const editTeacherOtherSpecialtyInput = document.getElementById('editTeacherOtherSpecialty');
                    const editTeacherCommentsTextarea = document.getElementById('editTeacherComments');

                    editButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const teacherId = this.getAttribute('data-id');
                            const firstName = this.getAttribute('data-firstname');
                            const lastName = this.getAttribute('data-lastname');
                            const email = this.getAttribute('data-email');
                            const specialty = this.getAttribute('data-specialty');
                            const otherSpecialty = this.getAttribute('data-other-specialty');
                            const comments = this.getAttribute('data-comments');

                            // Cargar los datos en el formulario
                            editTeacherIdInput.value = teacherId;
                            editTeacherFirstNameInput.value = firstName;
                            editTeacherLastNameInput.value = lastName;
                            editTeacherEmailInput.value = email;
                            editTeacherSpecialtySelect.value = specialty;
                            editTeacherOtherSpecialtyInput.value = otherSpecialty;
                            editTeacherCommentsTextarea.value = comments;

                            // Mostrar u ocultar el campo "Otra Especialidad"
                            const editOtherSpecialtyContainer = document.getElementById('editOtherSpecialtyContainer');
                            if (specialty === 'Otra') {
                                editOtherSpecialtyContainer.style.display = 'block';
                            } else {
                                editOtherSpecialtyContainer.style.display = 'none';
                            }
                        });
                    });

                    // Manejar el modal de eliminación
                    const deleteButtons = document.querySelectorAll('.delete-teacher');
                    const deleteTeacherIdInput = document.getElementById('deleteTeacherId');

                    deleteButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const teacherId = this.getAttribute('data-id');
                            deleteTeacherIdInput.value = teacherId;
                        });
                    });
                });
            </script>
</body>
<!-- Footer -->
<?php include "shared/footer.php"; ?>