<?php include "shared/header.php" ?>
<main>
    <title>Elegir una Escuela</title>

    <!-- Agregar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilo Personalizado -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 2.5rem;
            color: #007bff;
            font-weight: bold;
        }

        .content {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .content h2 {
            font-size: 1.8rem;
            color: #343a40;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #6c757d;
        }

        .btn-primary {
            display: block;
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 4px;
            text-align: center;
            color: white;
            text-decoration: none;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }

            .content {
                padding: 20px;
            }
        }
    </style>

    <body>

        <div class="container">
            <div class="header">
                <h1>¿Por qué elegir una escuela?</h1>
            </div>

            <div class="content">
                <h2>Elige con sabiduría, invierte en tu futuro</h2>
                <p>Elegir una escuela es una de las decisiones más importantes que un estudiante y su familia pueden tomar, ya que el entorno educativo influye directamente en el desarrollo académico y personal. Una buena escuela no solo proporciona una educación de calidad, sino que también fomenta el crecimiento integral de los estudiantes, ofreciendo programas que impulsan su creatividad, habilidades sociales y deportivas. Además, una escuela con un enfoque en la innovación y el uso de tecnología prepara a los estudiantes para enfrentar los desafíos del futuro. Al elegir una escuela, es esencial considerar aspectos como la calidad de sus docentes, los valores que promueve, la infraestructura, las actividades extracurriculares y, por supuesto, el ambiente de respeto y seguridad que brinda a sus alumnos.</p>
                <a href="registro.html" class="btn btn-primary">Explora nuestras opciones educativas</a>
            </div>
        </div>

        <!-- Agregar Bootstrap JS y dependencias -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    </body>

</main>

<?php include "shared/footer.php" ?>