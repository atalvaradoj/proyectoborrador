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
    <style>
        /* Fuente global */
        body {
            font-family: 'Arial', sans-serif;
            margin-top: 20px;
        }

        /* Centramos el contenido vertical y horizontalmente */
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            margin-top: 30px;
            /* Opcional: limitar el ancho máximo */
            max-width: 1200px;
        }

        .row {
            justify-content: center;
        }

        .section {
            margin-bottom: 30px;
            border: 2px solid #007bff;
            /* Color actualizado */
            border-radius: 10px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
            transition: transform 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .section:hover {
            transform: translateY(-5px);
        }

        .section-title {
            font-size: 1.6rem;
            font-weight: bold;
            margin: 0;
            padding: 15px 10px;
            text-align: center;
            background-color: #007bff;
            /* Color actualizado */
            color: white;
            border-bottom: 2px solid #007bff;
            /* Color actualizado */
        }

        .section-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .fa-icon {
            font-size: 2.5rem;
            color: #007bff;
            /* Color actualizado */
            margin: 15px auto;
            text-align: center;
            display: block;
        }

        ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 15px;
            flex-grow: 1;
        }

        ul li {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 15px;
            text-align: center;
        }

        ul li strong {
            color: #007bff;
            /* Color actualizado */
            display: block;
            margin-bottom: 8px;
            font-size: 1.2rem;
        }

        .btn-ir-ahora {
            display: block;
            width: 80%;
            margin: 10px auto;
            padding: 10px 15px;
            background-color: #007bff;
            /* Color actualizado */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid #007bff;
            /* Color actualizado */
        }

        .btn-ir-ahora:hover {
            background-color: white;
            color: #007bff;
            /* Color actualizado */
            text-decoration: none;
        }

        /* Responsividad */
        @media (max-width: 992px) {
            .section {
                margin-bottom: 25px;
            }
        }

        @media (max-width: 768px) {
            .fa-icon {
                font-size: 2rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .btn-ir-ahora {
                width: 100%;
            }
        }
    </style>
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