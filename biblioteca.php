<?php include "shared/header.php"; ?>

<head>
    <title>Biblioteca Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .page-header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .book-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            background-color: white;
            transition: transform 0.3s ease;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .book-cover {
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .book-title {
            font-size: 1rem;
            font-weight: bold;
            color: #007bff;
        }

        .book-author {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="page-header">
            <h1>Biblioteca Escolar</h1>
            <p>Explora nuestros recursos académicos</p>
        </div>

        <!-- Libros Destacados -->
        <h3 class="mb-4">Libros Destacados</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="book-card">
                    <img src="https://via.placeholder.com/150x200/007bff/ffffff?text=Libro" class="book-cover" alt="Portada del libro">
                    <p class="book-title">Matemáticas Básicas</p>
                    <p class="book-author">Por: Juan Pérez</p>
                    <button class="btn btn-primary btn-sm">Reservar</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="book-card">
                    <img src="https://via.placeholder.com/150x200/007bff/ffffff?text=Libro" class="book-cover" alt="Portada del libro">
                    <p class="book-title">Ciencias Naturales</p>
                    <p class="book-author">Por: Ana López</p>
                    <button class="btn btn-primary btn-sm">Reservar</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="book-card">
                    <img src="https://via.placeholder.com/150x200/007bff/ffffff?text=Libro" class="book-cover" alt="Portada del libro">
                    <p class="book-title">Historia Universal</p>
                    <p class="book-author">Por: Carlos Martínez</p>
                    <button class="btn btn-primary btn-sm">Reservar</button>
                </div>
            </div>
        </div>

        <!-- Recursos Digitales -->
        <h3 class="mb-4 mt-5">Recursos Digitales</h3>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action">
                <i class="fas fa-file-pdf me-2"></i> E-Books de Matemáticas
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <i class="fas fa-file-pdf me-2"></i> Revistas Educativas
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <i class="fas fa-file-pdf me-2"></i> Tesis y Proyectos Escolares
            </a>
        </div>
    </div>

    <?php include "shared/footer.php"; ?>
</body>
</html>