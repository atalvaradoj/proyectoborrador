<?php include "shared/header.php" ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Académico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://kit.fontawesome.com/97cef9f55a.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin-top: 20px;
        }

        .container {
            margin-top: 30px;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .section {
            margin-bottom: 30px;
        }

        .fa-icon {
            font-size: 2.5rem;
            color: #0056b3;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        ul li {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        ul li strong {
            color: #0056b3;
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .fa-icon {
                font-size: 2rem;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>

<main>
    <div class="container">
        <div class="row">
            <!-- Sección de Comunicación -->
            <div class="col-md-6 col-lg-3 section">
                <i class="fa-solid fa-comments fa-icon"></i>
                <h2 class="section-title">Comunicación</h2>
                <ul>
                    <li><strong>Formulario de Contáctenos:</strong> Si tienes alguna duda, puedes enviarnos un correo directamente a la Escuela y te ayudaremos con tu consulta.</li>
                    <a href="mapa.php" class="btn-ir-ahora">Ir ahora</a>
                </ul>
            </div>

            <!-- Sección de Administración Financiera -->
            <div class="col-md-6 col-lg-3 section">
                <i class="fa-solid fa-credit-card fa-icon"></i>
                <h2 class="section-title">Administración Financiera</h2>
                <ul>
                    <li><strong>Gestión de pagos:</strong> Los estudiantes pueden ver y pagar sus matrículas, cuotas, libros u otros servicios académicos en línea.</li>
                    <li><strong>Descuentos y becas:</strong> Administración de becas, descuentos y ayudas financieras.</li>
                    <li><strong>Generación de recibos:</strong> Los estudiantes pueden obtener recibos de pagos realizados y otros documentos financieros.</li>
                </ul>
            </div>

            <!-- Sección de Biblioteca y Recursos -->
            <div class="col-md-6 col-lg-3 section">
                <i class="fa-solid fa-book fa-icon"></i>
                <h2 class="section-title">Biblioteca</h2>
                <ul>
                    <li><strong>Catálogo de la biblioteca:</strong> Consulta nuestra biblioteca en linea.</li>
                    <a href="biblioteca.php" class="btn-ir-ahora">Ir ahora</a>
                </ul>
            </div>

            <!-- Sección de Análisis y Reportes -->
            <div class="col-md-6 col-lg-3 section">
                <i class="fa-solid fa-chart-line fa-icon"></i>
                <h2 class="section-title">Análisis y Reportes</h2>
                <ul>
                    <li><strong>Análisis de rendimiento académico:</strong> Generar informes sobre el rendimiento de los estudiantes, identificando áreas en las que necesitan mejorar.</li>
                    <li><strong>Reportes de asistencia:</strong> Generación de reportes de asistencia para cada curso o actividad.</li>
                    <li><strong>Reportes financieros:</strong> Generación de reportes sobre pagos, facturación, y otros aspectos financieros de los estudiantes.</li>
                </ul>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<?php include "shared/footer.php" ?>

<!-- Bootstrap JS y dependencias -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>