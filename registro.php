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
                    role="tab">Administración de Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="docentes-tab" data-bs-toggle="tab" href="#docentes" role="tab">Docentes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="estudiantes-tab" data-bs-toggle="tab" href="#estudiantes"
                    role="tab">Estudiantes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="padreHijo-tab" data-bs-toggle="tab" href="#padreHijo" role="tab">Padre, Hijo</a>
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

                <!-- Botón para agregar usuario (solo visible para administradores) -->
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <button class="btn btn-primary btn-add mb-3" data-bs-toggle="modal" data-bs-target="#addUsuarioModal">
                        <i class="fas fa-user-plus me-2"></i> Agregar Usuario
                    </button>
                <?php endif; ?>

                <div class="table-container">
                    <table class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí van los datos dinámicos -->
                            <?php
                            // Conexión a la base de datos
                            include "includes/db_config.php";
                            $conn = getConnection();
                            // Consulta para obtener los usuarios
                            $sql = "SELECT * FROM usuarios ORDER BY ID_usuario DESC";
                            $result = $conn->query($sql);

                            if ($result && $result->num_rows > 0):
                                while ($row = $result->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['ID_usuario']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Nombres']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Correo']); ?></td>
                                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Rol']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Estado']); ?></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm delete-user"
                                                data-id="<?php echo htmlspecialchars($row['ID_usuario']); ?>"
                                                data-bs-toggle="modal" data-bs-target="#deleteUserModal">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                endwhile;
                            else:
                                ?>
                                <tr>
                                    <td colspan="7" class="text-center">No hay usuarios registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal para Agregar Usuario -->
            <div class="modal fade" id="addUsuarioModal" tabindex="-1" aria-labelledby="addUsuarioModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addUsuarioModalLabel">
                                <i class="fas fa-user-plus me-2"></i> Agregar Nuevo Usuario
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUsuarioForm" method="post" action="controllers/save_user.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="usuarioNombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="usuarioNombre" name="Nombres"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="usuarioCorreo" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="usuarioCorreo" name="Correo"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="usuarioTelefono" class="form-label">Teléfono</label>
                                            <input type="text" class="form-control" id="usuarioTelefono" name="telefono"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="usuarioRol" class="form-label">Rol</label>
                                            <select class="form-select" id="usuarioRol" name="Rol" required>
                                                <option value="Administrador">Administrador</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="usuarioPassword" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="usuarioPassword" name="Password"
                                        required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" form="addUsuarioForm">
                                <i class="fas fa-save me-1"></i> Guardar Usuario
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para Eliminar Usuario -->
            <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="deleteUserModalLabel">
                                <i class="fas fa-trash me-2"></i> Eliminar Usuario
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro de que desea eliminar este usuario?</p>
                            <form id="deleteUserForm" method="post" action="controllers/delete_user.php">
                                <input type="hidden" id="deleteUserId" name="ID_usuario">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" form="deleteUserForm">
                                <i class="fas fa-trash me-1"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- padre hijo -->
            <div class="tab-pane fade" id="padreHijo" role="tabpanel">
                <h3 class="mt-3">Asociar Padre con Hijo</h3>
                <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#asociarModal">
                    <i class="fas fa-link me-2"></i> Asociar Padre e Hijo
                </button>

                <div class="table-container">
                    <table class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Padre</th>
                                <th>Hijo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT u.Nombres AS Padre, e.Nombres AS Hijo, pe.ID_usuario, pe.ID_estudiante
                          FROM padres_estudiantes pe
                          JOIN usuarios u ON pe.ID_usuario = u.ID_usuario
                          JOIN estudiantes e ON pe.ID_estudiante = e.ID_estudiante";
                            $result = $conn->query($query);

                            if ($result && $result->num_rows > 0):
                                while ($row = $result->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['Padre']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Hijo']); ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-relation"
                                                data-id_estudiante="<?php echo $row['ID_estudiante']; ?>"
                                                data-id_usuario="<?php echo $row['ID_usuario']; ?>" data-bs-toggle="modal"
                                                data-bs-target="#editarRelacionModal">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                            <button class="btn btn-danger btn-sm delete-relation"
                                                data-id_estudiante="<?php echo $row['ID_estudiante']; ?>"
                                                data-id_usuario="<?php echo $row['ID_usuario']; ?>" data-bs-toggle="modal"
                                                data-bs-target="#eliminarRelacionModal">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                endwhile;
                            else:
                                ?>
                                <tr>
                                    <td colspan="3" class="text-center">No hay asociaciones registradas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modales -->
                <!-- Asociar Modal -->
                <div class="modal fade" id="asociarModal" tabindex="-1" aria-labelledby="asociarModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="controllers/save_padre_hijo.php">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="asociarModalLabel">Asociar Padre e Hijo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Padre (Usuario)</label>
                                        <select class="form-select" name="ID_usuario" required>
                                            <option value="">Seleccione un padre</option>
                                            <?php
                                            $padres = $conn->query("SELECT ID_usuario, Nombres FROM usuarios WHERE Rol = 'Padres'");
                                            while ($p = $padres->fetch_assoc()) {
                                                echo "<option value='{$p['ID_usuario']}'>{$p['Nombres']} ({$p['ID_usuario']})</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Hijo (Estudiante)</label>
                                        <select class="form-select" name="ID_estudiante" required>
                                            <option value="">Seleccione un hijo</option>
                                            <?php
                                            $hijos = $conn->query("SELECT e.ID_estudiante, e.Nombres FROM estudiantes e
                                                       LEFT JOIN padres_estudiantes pe ON e.ID_estudiante = pe.ID_estudiante
                                                       WHERE pe.ID_estudiante IS NULL");
                                            while ($h = $hijos->fetch_assoc()) {
                                                echo "<option value='{$h['ID_estudiante']}'>{$h['Nombres']} ({$h['ID_estudiante']})</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Eliminar Modal -->
                <div class="modal fade" id="eliminarRelacionModal" tabindex="-1" aria-labelledby="eliminarRelacionLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="controllers/delete_padre_hijo.php">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="eliminarRelacionLabel">Eliminar Asociación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Está seguro que desea eliminar esta relación padre-hijo?</p>
                                    <input type="hidden" name="ID_usuario" id="delete_ID_usuario">
                                    <input type="hidden" name="ID_estudiante" id="delete_ID_estudiante">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Editar Modal -->
                <div class="modal fade" id="editarRelacionModal" tabindex="-1" aria-labelledby="editarRelacionLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="controllers/update_padre_hijo.php">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title" id="editarRelacionLabel">Editar Asociación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="ID_estudiante" id="edit_ID_estudiante">
                                    <div class="mb-3">
                                        <label class="form-label">Nuevo Padre</label>
                                        <select class="form-select" name="new_ID_usuario" required>
                                            <option value="">Seleccione un padre</option>
                                            <?php
                                            $padres = $conn->query("SELECT ID_usuario, Nombres FROM usuarios WHERE Rol = 'Padre'");
                                            while ($p = $padres->fetch_assoc()) {
                                                echo "<option value='{$p['ID_usuario']}'>{$p['Nombres']} ({$p['ID_usuario']})</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    document.querySelectorAll('.delete-relation').forEach(button => {
                        button.addEventListener('click', () => {
                            document.getElementById('delete_ID_usuario').value = button.dataset.id_usuario;
                            document.getElementById('delete_ID_estudiante').value = button.dataset.id_estudiante;
                        });
                    });

                    document.querySelectorAll('.edit-relation').forEach(button => {
                        button.addEventListener('click', () => {
                            document.getElementById('edit_ID_estudiante').value = button.dataset.id_estudiante;
                        });
                    });
                });
            </script>


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
                            <form id="deleteDocenteForm" method="post" action="controllers/delete_teacher.php#docentes">
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
                                        <td><img src="<?php echo htmlspecialchars($photo_url); ?>" alt="Foto" width="50"
                                                class="rounded-circle"></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-student"
                                                data-id="<?php echo htmlspecialchars($row['ID_estudiante']); ?>"
                                                data-firstname="<?php echo htmlspecialchars($row['Nombres']); ?>"
                                                data-lastname="<?php echo htmlspecialchars($row['Apellidos']); ?>"
                                                data-email="<?php echo htmlspecialchars($row['Correo']); ?>"
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
                    <i class="fas fa-users me-2"></i> Agregar Grupo
                </button>
                <div class="table-container">
                    <table class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>ID Grupo</th>
                                <th>Grupo</th>
                                <th>Docente</th>
                                <th>Estudiantes</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Consulta para obtener los grupos con información del docente
                            $sql = "SELECT g.ID_grupo, g.Nombre_grupo, g.ID_docente, d.Nombres AS Docente_Nombre, d.Apellidos AS Docente_Apellido
                        FROM grupos g
                        JOIN docentes d ON g.ID_docente = d.ID_docente
                        ORDER BY g.ID_grupo DESC";
                            $result = $conn->query($sql);

                            if ($result && $result->num_rows > 0):
                                while ($row = $result->fetch_assoc()):
                                    // Obtener los estudiantes del grupo
                                    $id_grupo = $row['ID_grupo'];
                                    $sql_estudiantes = "SELECT e.Nombres, e.Apellidos FROM grupo_estudiante ge
                                            JOIN estudiantes e ON ge.ID_estudiante = e.ID_estudiante
                                            WHERE ge.ID_grupo = $id_grupo";
                                    $result_estudiantes = $conn->query($sql_estudiantes);

                                    // Construir la lista de estudiantes
                                    $estudiantes_lista = [];
                                    if ($result_estudiantes && $result_estudiantes->num_rows > 0) {
                                        while ($estudiante = $result_estudiantes->fetch_assoc()) {
                                            $estudiantes_lista[] = htmlspecialchars($estudiante['Nombres'] . ' ' . $estudiante['Apellidos']);
                                        }
                                    }
                                    $estudiantes_str = implode(", ", $estudiantes_lista);
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['ID_grupo']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Nombre_grupo']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Docente_Nombre'] . ' ' . $row['Docente_Apellido']); ?>
                                        </td>
                                        <td><?php echo !empty($estudiantes_str) ? $estudiantes_str : "Sin estudiantes asignados"; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-group" 
                                                data-id="<?php echo htmlspecialchars($row['ID_grupo']); ?>" 
                                                data-name="<?php echo htmlspecialchars($row['Nombre_grupo']); ?>" 
                                                data-teacher="<?php echo htmlspecialchars($row['ID_docente']); ?>" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editGrupoModal">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                            <button class="btn btn-danger btn-sm delete-group"
                                                data-id="<?php echo htmlspecialchars($row['ID_grupo']); ?>"
                                                data-bs-toggle="modal" data-bs-target="#deleteGrupoModal">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                endwhile;
                            else:
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center">No hay grupos registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal para Agregar Grupo -->
            <div class="modal fade" id="addGrupoModal" tabindex="-1" aria-labelledby="addGrupoModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addGrupoModalLabel">
                                <i class="fas fa-users me-2"></i> Agregar Nuevo Grupo
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addGrupoForm" method="post" action="controllers/save_group.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nombreGrupo" class="form-label">Nombre del Grupo</label>
                                            <input type="text" class="form-control" id="nombreGrupo" name="Nombre_grupo"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="docente" class="form-label">Docente</label>
                                            <select class="form-select" id="docente" name="ID_docente" required>
                                                <option value="">Seleccione un Docente</option>
                                                <!-- Opciones dinámicas para los docentes -->
                                                <?php
                                                // Conexión y carga de docentes
                                                try {
                                                    $pdo = new PDO("mysql:host=localhost;dbname=sistema_academico;charset=utf8", "root", "");
                                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                    $docentes = $pdo->query("SELECT ID_docente, CONCAT(Nombres, ' ', Apellidos) AS NombreCompleto FROM docentes")->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($docentes as $docente) {
                                                        echo '<option value="' . $docente['ID_docente'] . '">' . $docente['NombreCompleto'] . '</option>';
                                                    }
                                                } catch (PDOException $e) {
                                                    echo '<option value="">Error al cargar docentes</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="estudiantes" class="form-label">Seleccionar Estudiantes</label>
                                            <select class="form-select" id="estudiantes" name="ID_estudiante[]" multiple
                                                required>
                                                <!-- Opciones dinámicas para los estudiantes -->
                                                <?php
                                                // Conexión y carga de estudiantes
                                                try {
                                                    $estudiantes = $pdo->query("SELECT ID_estudiante, CONCAT(Nombres, ' ', Apellidos) AS NombreCompleto FROM estudiantes")->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($estudiantes as $estudiante) {
                                                        echo '<option value="' . $estudiante['ID_estudiante'] . '">' . $estudiante['NombreCompleto'] . '</option>';
                                                    }
                                                } catch (PDOException $e) {
                                                    echo '<option value="">Error al cargar estudiantes</option>';
                                                }
                                                ?>
                                            </select>
                                            <small class="form-text text-muted">Mantén presionada la tecla
                                                <strong>Ctrl</strong> (o Cmd en Mac) para seleccionar múltiples
                                                estudiantes.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="comentariosGrupo" class="form-label">Comentarios</label>
                                            <textarea class="form-control" id="comentariosGrupo" name="Comentarios"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" form="addGrupoForm">
                                <i class="fas fa-save me-1"></i> Guardar Grupo
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para Eliminar Grupo -->
            <div class="modal fade" id="deleteGrupoModal" tabindex="-1" aria-labelledby="deleteGrupoModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form id="deleteGrupoForm" method="post" action="controllers/delete_group.php">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteGrupoModalLabel">Eliminar Grupo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Está seguro de que desea eliminar este grupo?</p>
                                <input type="hidden" name="ID_grupo" id="deleteGrupoId">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal para Editar Grupo -->
            <div class="modal fade" id="editGrupoModal" tabindex="-1" aria-labelledby="editGrupoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="editGrupoForm" method="post" action="controllers/update_group.php">
                        <div class="modal-content">
                            <div class="modal-header bg-warning text-white">
                                <h5 class="modal-title" id="editGrupoModalLabel">Editar Grupo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="ID_grupo" id="editGrupoId">
                                <div class="mb-3">
                                    <label for="editNombreGrupo" class="form-label">Nombre del Grupo</label>
                                    <input type="text" class="form-control" id="editNombreGrupo" name="Nombre_grupo" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editDocente" class="form-label">Docente</label>
                                    <select class="form-select" id="editDocente" name="ID_docente" required>
                                        <option value="">Seleccione un Docente</option>
                                        <?php
                                        $docentes = $conn->query("SELECT ID_docente, CONCAT(Nombres, ' ', Apellidos) AS NombreCompleto FROM docentes");
                                        while ($docente = $docentes->fetch_assoc()) {
                                            echo '<option value="' . $docente['ID_docente'] . '">' . htmlspecialchars($docente['NombreCompleto']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Administración de Notas -->
            <div class="tab-pane fade" id="notas" role="tabpanel">
                <h3>Administración de Notas</h3>
                <div class="d-flex justify-content-between mb-3">
                    <button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addNotaModal">
                        <i class="fas fa-book me-2"></i> Asignar Nota
                    </button>
                    <a href="controllers/generate_pdf.php" target="_blank" class="btn btn-success">
                        <i class="fas fa-file-pdf me-2"></i> Generar PDF
                    </a>
                </div>
                <!-- Tabla de notas registradas -->
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Estudiante</th>
                                <th>Materia</th>
                                <th>Nota</th>
                                <th>Asistencia (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT e.Nombres AS Estudiante, n.Materia, n.Nota, n.Asistencia
                                        FROM notas n
                                        JOIN estudiantes e ON n.ID_estudiante = e.ID_estudiante";

                            $result = $conn->query($query);

                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($row['Estudiante']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['Materia']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['Nota']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['Asistencia']) . '%</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="4" class="text-center">No hay notas registradas.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Modal Agregar Nota -->
            <div class="modal fade" id="addNotaModal" tabindex="-1" aria-labelledby="addNotaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="addNotaForm" method="post" action="controllers/save_nota.php">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="addNotaLabel">Registrar Nota</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="estudiante" class="form-label">Estudiante</label>
                                            <select class="form-select" id="estudiante" name="ID_estudiante" required>
                                                <option value="">Seleccione un Estudiante</option>
                                                <?php
                                                $estudiantes = $conn->query("SELECT ID_estudiante, CONCAT(Nombres, ' ', Apellidos) AS NombreCompleto FROM estudiantes");
                                                while ($estudiante = $estudiantes->fetch_assoc()) {
                                                    echo '<option value="' . $estudiante['ID_estudiante'] . '">' . htmlspecialchars($estudiante['NombreCompleto']) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="asignatura" class="form-label">Asignatura</label>
                                            <input type="text" class="form-control" id="asignatura" name="Materia"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="nota" class="form-label">Nota</label>
                                    <input type="number" class="form-control" id="nota" name="Nota" required min="0"
                                        max="100">
                                </div>

                                <div class="mb-3">
                                    <label for="asistencia" class="form-label">Asistencia</label>
                                    <input type="number" class="form-control" id="asistencia" name="Asistencia" required
                                        min="1" max="100">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Guardar Nota</button>
                            </div>
                        </div>
                    </form>
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
                            deleteTeacherIdInput.value = teacherId; // Asignar el ID del docente al campo oculto
                        });
                    });
                });
            </script>

            <!-- // Script para manejar el modal de eliminar usuario -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const deleteButtons = document.querySelectorAll('.delete-user');
                    const deleteUserIdInput = document.getElementById('deleteUserId');

                    deleteButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const userId = this.getAttribute('data-id');
                            deleteUserIdInput.value = userId;
                        });
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const tabs = document.querySelectorAll('.nav-link');

                    tabs.forEach(tab => {
                        tab.addEventListener('click', function () {
                            const target = this.getAttribute('href');
                            history.pushState(null, null, target); // Actualiza el hash en la URL
                        });
                    });
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const deleteButtons = document.querySelectorAll('.delete-group');
                    const deleteGrupoIdInput = document.getElementById('deleteGrupoId');

                    deleteButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const groupId = this.getAttribute('data-id');
                            deleteGrupoIdInput.value = groupId;
                        });
                    });
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const editButtons = document.querySelectorAll('.edit-group');
                    const editGrupoIdInput = document.getElementById('editGrupoId');
                    const editNombreGrupoInput = document.getElementById('editNombreGrupo');
                    const editDocenteSelect = document.getElementById('editDocente');
                    const editComentariosTextarea = document.getElementById('editComentariosGrupo');

                    editButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const groupId = this.getAttribute('data-id');
                            const groupName = this.getAttribute('data-name');
                            const teacherId = this.getAttribute('data-teacher');
                            const comments = this.getAttribute('data-comments');

                            // Cargar los datos en el formulario
                            editGrupoIdInput.value = groupId;
                            editNombreGrupoInput.value = groupName;
                            editDocenteSelect.value = teacherId;
                            editComentariosTextarea.value = comments;
                        });
                    });
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const editButtons = document.querySelectorAll('.edit-group');
                    const editGrupoIdInput = document.getElementById('editGrupoId');
                    const editNombreGrupoInput = document.getElementById('editNombreGrupo');
                    const editDocenteSelect = document.getElementById('editDocente');

                    editButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const groupId = this.getAttribute('data-id');
                            const groupName = this.getAttribute('data-name');
                            const teacherId = this.getAttribute('data-teacher');

                            // Cargar los datos en el formulario
                            editGrupoIdInput.value = groupId;
                            editNombreGrupoInput.value = groupName;
                            editDocenteSelect.value = teacherId;
                        });
                    });
                });
            </script>
</body>
<!-- Footer -->
<?php include "shared/footer.php"; ?>