<?php include "shared/header.php" ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class = "container">
   
    <section>
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner"> 
            <div class="carousel-item active" data-bs-interval="10000">
            <img src="img/Estudiantes1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
            <img src="img/Estudiantes2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="img/Estudiantes3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
    </section>

    <section>
        <h1>Somos expertos en</h1>
        <div class="card-group">
            <div class="card">
                <img width"350" height"251" src="img/Estudiantes1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Aprendizaje y Crecimiento</h5>
                <p class="card-text">Con más de 44 años de trayectoria, en la Escuela La Galleta Estudiosa nos enfocamos en fomentar un aprendizaje basado en la curiosidad y el esfuerzo. Nuestro compromiso es ofrecer una educación que inspire y prepare a los estudiantes para afrontar el futuro con confianza, gracias a un equipo docente dedicado y a métodos educativos innovadores.</p>
                
                </div>
            </div>
            <div class="card">
                <img width"350" height"251" src="img/Estudiantes2.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Educación de Calidad</h5>
                <p class="card-text">Con más de 44 años de experiencia, en la Escuela La Galleta Estudiosa nos dedicamos a formar estudiantes con un enfoque integral, que promueve el desarrollo académico, social y emocional. Nuestros planes de estudio están diseñados para brindar una educación de excelencia, con un equipo docente comprometido y métodos de enseñanza innovadores.</p>
                
                </div>
            </div>
            <div class="card">
                <img width"350" height"251" src="img/Estudiantes3.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Desarrollo en Ciencias y Tecnología</h5>
                <p class="card-text">Ofrecemos un enfoque práctico y accesible en ciencias y tecnología, con materias que cubren desde matemáticas y ciencias naturales hasta computación y robótica. Queremos que nuestros estudiantes se preparen para los desafíos del futuro, desarrollando habilidades fundamentales que les permitan destacar en un mundo cada vez más tecnológico.</p>
                
                </div>
            </div>
            </div>
    </section>

    <section>

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

    </section>
        <!-- Sección del Mapa -->
        <section id="mapa" class="mb-5">
        <h2 class="mb-4 text-center">Encuéntranos</h2>
        <div class="row">
            <div class="col-12">
                <iframe class="w-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.215179409634!2d-84.13157172597502!3d9.999076673052658!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0faeee3c54c71%3A0x7b6dfa32a05d9652!2sLiceo%20Ing.%20Samuel%20S%C3%A1enz%20Flores!5e0!3m2!1ses-419!2scr!4v1742171660337!5m2!1ses-419!2scr"
                    height="400" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
<?php include "shared/footer.php" ?>