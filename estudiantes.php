<?php include "shared/header.php" ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Estudiantes - Sistema Académico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .page-header {
            background-color: #0056b3;
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
            text-align: center;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0;
        }

        .page-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-top: 10px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: none;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .card-header {
            background-color: #0056b3;
            color: white;
            font-weight: 600;
            padding: 15px 20px;
            border-bottom: none;
        }

        .card-body {
            padding: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #0056b3;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 5px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            margin-bottom: 15px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0056b3;
            box-shadow: 0 0 0 0.25rem rgba(0, 86, 179, 0.25);
        }

        .btn-primary {
            background-color: #0056b3;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #003d82;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-primary {
            color: #0056b3;
            border-color: #0056b3;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #0056b3;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 86, 179, 0.05);
        }

        .table th {
            background-color: #f8f9fa;
            color: #0056b3;
            font-weight: 600;
        }

        .student-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .photo-preview {
            width: 150px;
            height: 150px;
            border-radius: 5px;
            object-fit: cover;
            margin-bottom: 15px;
            border: 2px dashed #ced4da;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            overflow: hidden;
        }

        .photo-preview img {
            max-width: 100%;
            max-height: 100%;
        }

        .photo-preview-text {
            color: #6c757d;
            font-size: 0.9rem;
            text-align: center;
        }

        .search-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .alert-info {
            background-color: #e6f3ff;
            border-color: #b8daff;
            color: #0056b3;
        }

        .badge-active {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .badge-inactive {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .action-buttons .btn {
            padding: 5px 10px;
            margin-right: 5px;
        }

        .action-buttons .btn i {
            margin-right: 0;
        }

        .pagination .page-item.active .page-link {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .pagination .page-link {
            color: #0056b3;
        }

        .nav-tabs {
            border-bottom: 2px solid #dee2e6;
            margin-bottom: 20px;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #495057;
            font-weight: 600;
            padding: 12px 20px;
            margin-right: 5px;
            border-radius: 5px 5px 0 0;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link:hover {
            background-color: rgba(0, 86, 179, 0.05);
            color: #0056b3;
        }

        .nav-tabs .nav-link.active {
            color: #0056b3;
            background-color: #fff;
            border-bottom: 3px solid #0056b3;
        }

        .nav-tabs .nav-link i {
            margin-right: 8px;
        }

        .tab-content {
            padding-top: 20px;
        }

        .student-detail-photo {
            width: 150px;
            height: 150px;
            border-radius: 5px;
            object-fit: cover;
            border: 1px solid #dee2e6;
        }

        .student-detail-info {
            margin-left: 20px;
        }

        .student-detail-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0056b3;
            margin-bottom: 10px;
        }

        .student-detail-id {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .student-detail-item {
            margin-bottom: 10px;
        }

        .student-detail-label {
            font-weight: 600;
            color: #495057;
        }

        .student-detail-value {
            color: #212529;
        }

        .student-detail-section {
            margin-top: 30px;
        }

        .student-detail-section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #0056b3;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem;
            }

            .student-detail-photo {
                width: 100px;
                height: 100px;
            }

            .student-detail-info {
                margin-left: 0;
                margin-top: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-4 mb-5">
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
            </div>
            <div class="card-body">
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
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="img/sombrero-de-graduacion.png" class="student-photo" alt="Foto de estudiante">
                                </td>
                                <td>20230001</td>
                                <td>Gómez, Pedro</td>
                                <td>Ingeniería de Sistemas</td>
                                <td>
                                    <span class="badge-active">Activo</span>
                                </td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewStudentModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editStudentModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteStudentModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <img src="img/sombrero-de-graduacion.png" class="student-photo" alt="Foto de estudiante">
                                </td>
                                <td>20230002</td>
                                <td>Fernández, Lucía</td>
                                <td>Administración de Empresas</td>
                                <td>
                                    <span class="badge-active">Activo</span>
                                </td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewStudentModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editStudentModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteStudentModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <img src="img/sombrero-de-graduacion.png" class="student-photo" alt="Foto de estudiante">
                                </td>
                                <td>20230003</td>
                                <td>Díaz, Martín</td>
                                <td>Ingeniería Industrial</td>
                                <td>
                                    <span class="badge-active">Activo</span>
                                </td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewStudentModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editStudentModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteStudentModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    <img src="img/sombrero-de-graduacion.png" class="student-photo" alt="Foto de estudiante">
                                </td>
                                <td>20230004</td>
                                <td>Torres, Sofía</td>
                                <td>Medicina</td>
                                <td>
                                    <span class="badge-inactive">Inactivo</span>
                                </td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewStudentModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editStudentModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteStudentModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>
                                    <img src="img/sombrero-de-graduacion.png" class="student-photo" alt="Foto de estudiante">
                                </td>
                                <td>20230005</td>
                                <td>Ramírez, Diego</td>
                                <td>Derecho</td>
                                <td>
                                    <span class="badge-active">Activo</span>
                                </td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewStudentModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editStudentModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteStudentModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <nav aria-label="Navegación de páginas" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Siguiente</a>
                        </li>
                    </ul>
                </nav>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap y JavaScript personalizado -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Código para previsualizar la imagen seleccionada
        document.getElementById('studentPhoto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const photoPreview = document.getElementById('photoPreview');
                    photoPreview.innerHTML = `<img src="${event.target.result}" alt="Vista previa de foto">`;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>