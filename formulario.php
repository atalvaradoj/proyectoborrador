<?php include "shared/header.php" ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularios - La Galleta Estudiosa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-container {
            display: none;
        }

        .active {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Sistema de Administración Escolar</h1>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Datos registrados correctamente (simulación)</div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">Error en el procesamiento del formulario (simulación)</div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="estudiante-tab" href="#estudiante">Registrar Estudiante</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="docente-tab" href="#docente">Registrar Docente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="grupo-tab" href="#grupo">Registrar Grupo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nota-tab" href="#nota">Registrar Nota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="asistencia-tab" href="#asistencia">Registrar Asistencia</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <!-- Formulario de Estudiante -->
                <div id="estudiante-form" class="form-container active">
                    <h3>Registro de Estudiante</h3>
                    <form method="post" action="?success=1">
                        <input type="hidden" name="tipo_formulario" value="estudiante">

                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>

                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="grupo_id">Grupo:</label>
                            <select class="form-control" id="grupo_id" name="grupo_id" required>
                                <option value="">Seleccione un grupo</option>
                                <option value="1">1A - Primer Grado (2023)</option>
                                <option value="2">1B - Primer Grado (2023)</option>
                                <option value="3">2A - Segundo Grado (2023)</option>
                                <option value="4">2B - Segundo Grado (2023)</option>
                                <option value="5">3A - Tercer Grado (2023)</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Registrar Estudiante</button>
                    </form>
                </div>

                <!-- Formulario de Docente -->
                <div id="docente-form" class="form-container">
                    <h3>Registro de Docente</h3>
                    <form method="post" action="?success=1">
                        <input type="hidden" name="tipo_formulario" value="docente">

                        <div class="form-group">
                            <label for="nombre_docente">Nombre:</label>
                            <input type="text" class="form-control" id="nombre_docente" name="nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="apellido_docente">Apellido:</label>
                            <input type="text" class="form-control" id="apellido_docente" name="apellido" required>
                        </div>

                        <div class="form-group">
                            <label for="especialidad">Especialidad:</label>
                            <input type="text" class="form-control" id="especialidad" name="especialidad" required>
                        </div>

                        <div class="form-group">
                            <label for="email_docente">Email:</label>
                            <input type="email" class="form-control" id="email_docente" name="email" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Registrar Docente</button>
                    </form>
                </div>

                <!-- Formulario de Grupo -->
                <div id="grupo-form" class="form-container">
                    <h3>Registro de Grupo</h3>
                    <form method="post" action="?success=1">
                        <input type="hidden" name="tipo_formulario" value="grupo">

                        <div class="form-group">
                            <label for="nombre_grupo">Nombre del Grupo:</label>
                            <input type="text" class="form-control" id="nombre_grupo" name="nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="grado">Grado:</label>
                            <select class="form-control" id="grado" name="grado" required>
                                <option value="">Seleccione un grado</option>
                                <option value="1">Primer Grado</option>
                                <option value="2">Segundo Grado</option>
                                <option value="3">Tercer Grado</option>
                                <option value="4">Cuarto Grado</option>
                                <option value="5">Quinto Grado</option>
                                <option value="6">Sexto Grado</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="docente_id">Docente:</label>
                            <select class="form-control" id="docente_id" name="docente_id" required>
                                <option value="">Seleccione un docente</option>
                                <option value="1">Martínez, Ana</option>
                                <option value="2">López, Carlos</option>
                                <option value="3">Rodríguez, María</option>
                                <option value="4">González, Juan</option>
                                <option value="5">Pérez, Laura</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="anio_lectivo">Año Lectivo:</label>
                            <select class="form-control" id="anio_lectivo" name="anio_lectivo" required>
                                <option value="">Seleccione un año</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Registrar Grupo</button>
                    </form>
                </div>

                <!-- Formulario de Nota -->
                <div id="nota-form" class="form-container">
                    <h3>Registro de Nota</h3>
                    <form method="post" action="?success=1">
                        <input type="hidden" name="tipo_formulario" value="nota">

                        <div class="form-group">
                            <label for="estudiante_id">Estudiante:</label>
                            <select class="form-control" id="estudiante_id" name="estudiante_id" required>
                                <option value="">Seleccione un estudiante</option>
                                <option value="1">Gómez, Pedro (1A)</option>
                                <option value="2">Fernández, Lucía (1A)</option>
                                <option value="3">Díaz, Martín (2B)</option>
                                <option value="4">Torres, Sofía (3A)</option>
                                <option value="5">Ramírez, Diego (2A)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="materia">Materia:</label>
                            <select class="form-control" id="materia" name="materia" required>
                                <option value="">Seleccione una materia</option>
                                <option value="Matemáticas">Matemáticas</option>
                                <option value="Español">Español</option>
                                <option value="Ciencias Naturales">Ciencias Naturales</option>
                                <option value="Ciencias Sociales">Ciencias Sociales</option>
                                <option value="Inglés">Inglés</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="calificacion">Calificación:</label>
                            <input type="number" class="form-control" id="calificacion" name="calificacion" min="0"
                                max="10" step="0.1" required>
                        </div>

                        <div class="form-group">
                            <label for="fecha_nota">Fecha:</label>
                            <input type="date" class="form-control" id="fecha_nota" name="fecha" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Registrar Nota</button>
                    </form>
                </div>

                <!-- Formulario de Asistencia -->
                <div id="asistencia-form" class="form-container">
                    <h3>Registro de Asistencia</h3>
                    <form method="post" action="?success=1">
                        <input type="hidden" name="tipo_formulario" value="asistencia">

                        <div class="form-group">
                            <label for="grupo_asistencia">Grupo:</label>
                            <select class="form-control" id="grupo_asistencia" name="grupo_id" required>
                                <option value="">Seleccione un grupo</option>
                                <option value="1">1A - Primer Grado (2023)</option>
                                <option value="2">1B - Primer Grado (2023)</option>
                                <option value="3">2A - Segundo Grado (2023)</option>
                                <option value="4">2B - Segundo Grado (2023)</option>
                                <option value="5">3A - Tercer Grado (2023)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha_asistencia">Fecha:</label>
                            <input type="date" class="form-control" id="fecha_asistencia" name="fecha" required>
                        </div>

                        <div class="form-group">
                            <label>Lista de Estudiantes:</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Estudiante</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Gómez, Pedro</td>
                                        <td>
                                            <select class="form-control" name="estado[1]">
                                                <option value="Presente">Presente</option>
                                                <option value="Ausente">Ausente</option>
                                                <option value="Tardanza">Tardanza</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fernández, Lucía</td>
                                        <td>
                                            <select class="form-control" name="estado[2]">
                                                <option value="Presente">Presente</option>
                                                <option value="Ausente">Ausente</option>
                                                <option value="Tardanza">Tardanza</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ramírez, Diego</td>
                                        <td>
                                            <select class="form-control" name="estado[3]">
                                                <option value="Presente">Presente</option>
                                                <option value="Ausente">Ausente</option>
                                                <option value="Tardanza">Tardanza</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Volver al Inicio</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Cambiar entre formularios
            $('#estudiante-tab').click(function (e) {
                e.preventDefault();
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
                $('.form-container').removeClass('active');
                $('#estudiante-form').addClass('active');
            });

            $('#docente-tab').click(function (e) {
                e.preventDefault();
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
                $('.form-container').removeClass('active');
                $('#docente-form').addClass('active');
            });

            $('#grupo-tab').click(function (e) {
                e.preventDefault();
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
                $('.form-container').removeClass('active');
                $('#grupo-form').addClass('active');
            });

            $('#nota-tab').click(function (e) {
                e.preventDefault();
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
                $('.form-container').removeClass('active');
                $('#nota-form').addClass('active');
            });

            $('#asistencia-tab').click(function (e) {
                e.preventDefault();
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
                $('.form-container').removeClass('active');
                $('#asistencia-form').addClass('active');
            });
        });
    </script>
</body>

</html>

<!-- Footer -->
<?php include "shared/footer.php" ?>