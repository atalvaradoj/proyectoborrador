<?php include "shared/header.php" ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Docente - Sistema Académico</title>
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

        .form-container {
            display: none;
        }

        .active {
            display: block;
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

        .table-hover tbody tr:hover {
            background-color: rgba(0, 86, 179, 0.05);
        }

        .table th {
            background-color: #f8f9fa;
            color: #0056b3;
            font-weight: 600;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .quick-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            flex: 1;
            min-width: 200px;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 2.5rem;
            color: #0056b3;
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #0056b3;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 1rem;
            color: #6c757d;
        }

        /* Solución para el problema de visualización de imágenes */
        .student-info {
            display: flex;
            align-items: center;
        }

        .student-avatar {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            border-radius: 50%;
            display: inline-block;
        }

        .student-name {
            font-weight: 600;
            display: inline-block;
        }

        .grade-input {
            width: 80px;
            text-align: center;
        }

        .attendance-status {
            width: 100px;
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

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem;
            }

            .quick-stats {
                flex-direction: column;
            }

            .stat-card {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-4 mb-5">
        <div class="page-header">
            <h1 class="page-title">Portal Docente</h1>
            <p class="page-subtitle">Gestión de Notas y Asistencia</p>
        </div>

        <!-- Estadísticas Rápidas -->
        <div class="quick-stats">
            <div class="stat-card">
                <i class="fas fa-users stat-icon"></i>
                <div class="stat-value">124</div>
                <div class="stat-label">Estudiantes Activos</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-book stat-icon"></i>
                <div class="stat-value">8</div>
                <div class="stat-label">Cursos Asignados</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-clipboard-check stat-icon"></i>
                <div class="stat-value">95%</div>
                <div class="stat-label">Asistencia Promedio</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-graduation-cap stat-icon"></i>
                <div class="stat-value">7.8</div>
                <div class="stat-label">Promedio General</div>
            </div>
        </div>

        <!-- Buscador de Cursos -->
        <div class="search-container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h4 class="mb-0"><i class="fas fa-chalkboard-teacher me-2"></i> Mis Cursos</h4>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <select class="form-select" id="curso-selector">
                            <option value="">Seleccione un curso...</option>
                            <option value="1">Matemáticas - 1A (Primer Grado)</option>
                            <option value="2">Ciencias Naturales - 1A (Primer Grado)</option>
                            <option value="3">Matemáticas - 2B (Segundo Grado)</option>
                            <option value="4">Español - 3A (Tercer Grado)</option>
                            <option value="5">Ciencias Sociales - 2A (Segundo Grado)</option>
                        </select>
                        <button class="btn btn-primary" type="button" id="cargar-curso">Cargar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="docenteTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="notas-tab" data-bs-toggle="tab" data-bs-target="#notas" type="button" role="tab" aria-controls="notas" aria-selected="true">
                            <i class="fas fa-star"></i> Gestión de Notas
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="asistencia-tab" data-bs-toggle="tab" data-bs-target="#asistencia" type="button" role="tab" aria-controls="asistencia" aria-selected="false">
                            <i class="fas fa-clipboard-list"></i> Control de Asistencia
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reportes-tab" data-bs-toggle="tab" data-bs-target="#reportes" type="button" role="tab" aria-controls="reportes" aria-selected="false">
                            <i class="fas fa-chart-bar"></i> Reportes
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="docenteTabsContent">
                    <!-- Pestaña de Gestión de Notas -->
                    <div class="tab-pane fade show active" id="notas" role="tabpanel" aria-labelledby="notas-tab">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">Matemáticas - 1A (Primer Grado)</h4>
                            <div>
                                <button class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#importarNotasModal">
                                    <i class="fas fa-file-import me-1"></i> Importar
                                </button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-file-export me-1"></i> Exportar
                                </button>
                            </div>
                        </div>

                        <div class="alert alert-info mb-4">
                            <i class="fas fa-info-circle me-2"></i> Seleccione el periodo y tipo de evaluación para registrar las notas.
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="periodo" class="form-label">Periodo:</label>
                                <select class="form-select" id="periodo">
                                    <option value="1">Primer Periodo</option>
                                    <option value="2">Segundo Periodo</option>
                                    <option value="3">Tercer Periodo</option>
                                    <option value="4">Cuarto Periodo</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="tipo-evaluacion" class="form-label">Tipo de Evaluación:</label>
                                <select class="form-select" id="tipo-evaluacion">
                                    <option value="parcial">Examen Parcial</option>
                                    <option value="taller">Taller/Actividad</option>
                                    <option value="proyecto">Proyecto</option>
                                    <option value="final">Examen Final</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="fecha-evaluacion" class="form-label">Fecha:</label>
                                <input type="date" class="form-control" id="fecha-evaluacion" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>

                        <form id="form-notas" method="post" action="?success=1">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%">Estudiante</th>
                                            <th style="width: 15%">Nota</th>
                                            <th style="width: 15%">Nota Anterior</th>
                                            <th style="width: 30%">Observaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <img src="img/sombrero-de-graduacion.png" class="student-avatar" alt="Ícono de estudiante">
                                                    <span class="student-name">Gómez, Pedro</span>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control grade-input" name="nota[1]" min="0" max="10" step="0.1">
                                            </td>
                                            <td class="text-center">7.5</td>
                                            <td>
                                                <input type="text" class="form-control" name="observacion[1]" placeholder="Observaciones...">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <img src="img/sombrero-de-graduacion.png" class="student-avatar" alt="Ícono de estudiante">
                                                    <span class="student-name">Fernández, Lucía</span>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control grade-input" name="nota[2]" min="0" max="10" step="0.1">
                                            </td>
                                            <td class="text-center">8.2</td>
                                            <td>
                                                <input type="text" class="form-control" name="observacion[2]" placeholder="Observaciones...">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <img src="img/sombrero-de-graduacion.png" class="student-avatar" alt="Ícono de estudiante">
                                                    <span class="student-name">Díaz, Martín</span>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control grade-input" name="nota[3]" min="0" max="10" step="0.1">
                                            </td>
                                            <td class="text-center">6.8</td>
                                            <td>
                                                <input type="text" class="form-control" name="observacion[3]" placeholder="Observaciones...">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <img src="img/sombrero-de-graduacion.png" class="student-avatar" alt="Ícono de estudiante">
                                                    <span class="student-name">Torres, Sofía</span>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control grade-input" name="nota[4]" min="0" max="10" step="0.1">
                                            </td>
                                            <td class="text-center">9.0</td>
                                            <td>
                                                <input type="text" class="form-control" name="observacion[4]" placeholder="Observaciones...">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <img src="img/sombrero-de-graduacion.png" class="student-avatar" alt="Ícono de estudiante">
                                                    <span class="student-name">Ramírez, Diego</span>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control grade-input" name="nota[5]" min="0" max="10" step="0.1">
                                            </td>
                                            <td class="text-center">7.2</td>
                                            <td>
                                                <input type="text" class="form-control" name="observacion[5]" placeholder="Observaciones...">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-primary" id="btn-limpiar-notas">
                                    <i class="fas fa-eraser me-1"></i> Limpiar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Guardar Notas
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Pestaña de Control de Asistencia -->
                    <div class="tab-pane fade" id="asistencia" role="tabpanel" aria-labelledby="asistencia-tab">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">Matemáticas - 1A (Primer Grado)</h4>
                            <div>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-file-export me-1"></i> Exportar Reporte
                                </button>
                            </div>
                        </div>

                        <div class="alert alert-info mb-4">
                            <i class="fas fa-info-circle me-2"></i> Registre la asistencia para la fecha seleccionada.
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="fecha-asistencia" class="form-label">Fecha:</label>
                                <input type="date" class="form-control" id="fecha-asistencia" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="hora-clase" class="form-label">Hora de Clase:</label>
                                <select class="form-select" id="hora-clase">
                                    <option value="1">Primera Hora (7:00 - 8:00)</option>
                                    <option value="2">Segunda Hora (8:00 - 9:00)</option>
                                    <option value="3">Tercera Hora (9:00 - 10:00)</option>
                                    <option value="4">Cuarta Hora (10:30 - 11:30)</option>
                                    <option value="5">Quinta Hora (11:30 - 12:30)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="tipo-clase" class="form-label">Tipo de Clase:</label>
                                <select class="form-select" id="tipo-clase">
                                    <option value="regular">Clase Regular</option>
                                    <option value="laboratorio">Laboratorio</option>
                                    <option value="evaluacion">Evaluación</option>
                                    <option value="taller">Taller</option>
                                </select>
                            </div>
                        </div>

                        <form id="form-asistencia" method="post" action="?success=1">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%">Estudiante</th>
                                            <th style="width: 20%">Estado</th>
                                            <th style="width: 40%">Observaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <img src="img/sombrero-de-graduacion.png" class="student-avatar" alt="Ícono de estudiante">
                                                    <span class="student-name">Gómez, Pedro</span>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="form-select attendance-status" name="estado[1]">
                                                    <option value="Presente" selected>Presente</option>
                                                    <option value="Ausente">Ausente</option>
                                                    <option value="Tardanza">Tardanza</option>
                                                    <option value="Justificado">Justificado</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="observacion_asistencia[1]" placeholder="Observaciones...">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <img src="img/sombrero-de-graduacion.png" class="student-avatar" alt="Ícono de estudiante">
                                                    <span class="student-name">Fernández, Lucía</span>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="form-select attendance-status" name="estado[2]">
                                                    <option value="Presente" selected>Presente</option>
                                                    <option value="Ausente">Ausente</option>
                                                    <option value="Tardanza">Tardanza</option>
                                                    <option value="Justificado">Justificado</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="observacion_asistencia[2]" placeholder="Observaciones...">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <img src="img/sombrero-de-graduacion.png" class="student-avatar" alt="Ícono de estudiante">
                                                    <span class="student-name">Díaz, Martín</span>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="form-select attendance-status" name="estado[3]">
                                                    <option value="Presente" selected>Presente</option>
                                                    <option value="Ausente">Ausente</option>
                                                    <option value="Tardanza">Tardanza</option>
                                                    <option value="Justificado">Justificado</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="observacion_asistencia[3]" placeholder="Observaciones...">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <img src="img/sombrero-de-graduacion.png" class="student-avatar" alt="Ícono de estudiante">
                                                    <span class="student-name">Torres, Sofía</span>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="form-select attendance-status" name="estado[4]">
                                                    <option value="Presente" selected>Presente</option>
                                                    <option value="Ausente">Ausente</option>
                                                    <option value="Tardanza">Tardanza</option>
                                                    <option value="Justificado">Justificado</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="observacion_asistencia[4]" placeholder="Observaciones...">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <img src="img/sombrero-de-graduacion.png" class="student-avatar" alt="Ícono de estudiante">
                                                    <span class="student-name">Ramírez, Diego</span>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="form-select attendance-status" name="estado[5]">
                                                    <option value="Presente" selected>Presente</option>
                                                    <option value="Ausente">Ausente</option>
                                                    <option value="Tardanza">Tardanza</option>
                                                    <option value="Justificado">Justificado</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="observacion_asistencia[5]" placeholder="Observaciones...">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <div>
                                    <button type="button" class="btn btn-outline-primary me-2" id="btn-todos-presentes">
                                        <i class="fas fa-check-circle me-1"></i> Todos Presentes
                                    </button>
                                    <button type="button" class="btn btn-outline-primary" id="btn-limpiar-asistencia">
                                        <i class="fas fa-eraser me-1"></i> Limpiar
                                    </button>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Guardar Asistencia
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Pestaña de Reportes -->
                    <div class="tab-pane fade" id="reportes" role="tabpanel" aria-labelledby="reportes-tab">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">Reportes y Estadísticas</h4>
                            <div>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-file-pdf me-1"></i> Generar PDF
                                </button>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Rendimiento Académico</h5>
                                        <p class="card-text">Visualice el rendimiento académico de sus estudiantes por curso y periodo.</p>
                                        <button class="btn btn-primary">Ver Reporte</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Asistencia</h5>
                                        <p class="card-text">Consulte las estadísticas de asistencia por estudiante y por curso.</p>
                                        <button class="btn btn-primary">Ver Reporte</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
