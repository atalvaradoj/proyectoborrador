<?php include "shared/header.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración Escolar</title>
    <link href="https://kit.fontawesome.com/97cef9f55a.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluir el archivo CSS exclusivo para servicios -->
    <link rel="stylesheet" href="css/servicios.css">
</head>

<body>
    <main>
        <div class="container">
            <div class="row">
                <!-- Sección de Comunicación -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="section">
                        <h2 class="section-title">Comunicación</h2>
                        <div class="section-content">
                            <i class="fa-solid fa-comments fa-icon"></i>
                            <ul>
                                <li>
                                    <strong>Formulario de Contáctenos</strong>
                                    Si tienes alguna duda, puedes enviarnos un correo directamente a la Escuela y te
                                    ayudaremos con tu consulta.
                                </li>
                            </ul>
                            <a href="apicontactenos.php" class="btn-ir-ahora">Ir ahora</a>
                        </div>
                    </div>
                </div>

                <!-- Sección de Pago de Matrícula -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="section">
                        <h2 class="section-title">Pago de Matrícula</h2>
                        <div class="section-content">
                            <i class="fa-solid fa-credit-card fa-icon"></i>
                            <ul>
                                <li>
                                    <strong>Gestión de pago de la Matrícula</strong>
                                    Realiza el pago de tu matrícula en línea.
                                </li>
                            </ul>
                            <a href="pagoMatricula.php" class="btn-ir-ahora">Ir ahora</a>
                        </div>
                    </div>
                </div>

                <!-- Sección de Biblioteca y Recursos -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="section">
                        <h2 class="section-title">Biblioteca</h2>
                        <div class="section-content">
                            <i class="fa-solid fa-book fa-icon"></i>
                            <ul>
                                <li>
                                    <strong>Catálogo de la biblioteca</strong>
                                    Consulta nuestra biblioteca en línea.
                                </li>
                            </ul>
                            <a href="biblioteca.php" class="btn-ir-ahora">Ir ahora</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include "shared/footer.php"; ?>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>