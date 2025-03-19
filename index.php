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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
<?php include "shared/footer.php" ?>