<?php include "shared/header.php" ?>

<head>
    <title>Biblioteca Digital - Sistema Académico</title>
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
            height: 100%;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
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

        .form-control, .form-select {
            border-radius: 5px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            margin-bottom: 15px;
        }

        .form-control:focus, .form-select:focus {
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

        .feature-icon {
            font-size: 2.5rem;
            color: #0056b3;
            margin-bottom: 15px;
            text-align: center;
            display: block;
        }

        .book-card {
            transition: transform 0.3s ease;
            height: 100%;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-cover {
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .book-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 5px;
            color: #0056b3;
        }

        .book-author {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .book-status {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .status-available {
            background-color: #d4edda;
            color: #155724;
        }

        .status-borrowed {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-reserved {
            background-color: #fff3cd;
            color: #856404;
        }

        .search-container {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .nav-tabs {
            border-bottom: 2px solid #dee2e6;
            margin-bottom: 20px;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #495057;
            font-weight: 600;
            padding: 10px 15px;
            margin-right: 5px;
            border-radius: 0;
        }

        .nav-tabs .nav-link:hover {
            border-color: transparent;
            color: #0056b3;
        }

        .nav-tabs .nav-link.active {
            color: #0056b3;
            background-color: transparent;
            border-bottom: 3px solid #0056b3;
        }

        .resource-icon {
            font-size: 1.5rem;
            margin-right: 10px;
            color: #0056b3;
        }

        .resource-link {
            display: block;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-decoration: none;
            color: #333;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .resource-link:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }

        .badge-count {
            background-color: #0056b3;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-left: 10px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 86, 179, 0.05);
        }

        .pagination .page-item.active .page-link {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .pagination .page-link {
            color: #0056b3;
        }

        .quick-access {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }

        .quick-access-item {
            flex: 1;
            min-width: 150px;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-decoration: none;
            color: #333;
        }

        .quick-access-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            color: #0056b3;
        }

        .quick-access-icon {
            font-size: 2rem;
            color: #0056b3;
            margin-bottom: 10px;
        }

        .quick-access-title {
            font-weight: 600;
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem;
            }
            
            .quick-access {
                flex-direction: column;
            }
            
            .quick-access-item {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-4 mb-5">
        <div class="page-header">
            <h1 class="page-title">Biblioteca Digital</h1>
            <p class="page-subtitle">Accede a todos los recursos académicos de nuestra institución</p>
        </div>

        <!-- Acceso Rápido -->
        <div class="quick-access">
            <a href="#catalog" class="quick-access-item">
                <i class="fas fa-book quick-access-icon"></i>
                <p class="quick-access-title">Catálogo</p>
            </a>
            <a href="#digital" class="quick-access-item">
                <i class="fas fa-laptop quick-access-icon"></i>
                <p class="quick-access-title">Recursos Digitales</p>
            </a>
            <a href="#reservations" class="quick-access-item">
                <i class="fas fa-bookmark quick-access-icon"></i>
                <p class="quick-access-title">Mis Reservas</p>
            </a>
            <a href="#history" class="quick-access-item">
                <i class="fas fa-history quick-access-icon"></i>
                <p class="quick-access-title">Historial</p>
            </a>
            <a href="#help" class="quick-access-item">
                <i class="fas fa-question-circle quick-access-icon"></i>
                <p class="quick-access-title">Ayuda</p>
            </a>
        </div>

        <!-- Buscador -->
        <div class="search-container">
            <h4 class="mb-4"><i class="fas fa-search me-2"></i> Buscar Recursos</h4>
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Buscar por título, autor, tema..." aria-label="Buscar">
                            <button class="btn btn-primary" type="button">Buscar</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option selected>Tipo de recurso</option>
                            <option value="book">Libros</option>
                            <option value="journal">Revistas</option>
                            <option value="thesis">Tesis</option>
                            <option value="ebook">E-Books</option>
                            <option value="article">Artículos</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option selected>Área de estudio</option>
                            <option value="engineering">Ingeniería</option>
                            <option value="business">Administración</option>
                            <option value="health">Ciencias de la Salud</option>
                            <option value="humanities">Humanidades</option>
                            <option value="science">Ciencias Exactas</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <button type="button" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-sliders-h me-1"></i> Búsqueda Avanzada
                    </button>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Pestañas de Navegación -->
                <ul class="nav nav-tabs" id="libraryTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="catalog-tab" data-bs-toggle="tab" data-bs-target="#catalog" type="button" role="tab" aria-controls="catalog" aria-selected="true">
                            <i class="fas fa-book me-1"></i> Catálogo
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="digital-tab" data-bs-toggle="tab" data-bs-target="#digital" type="button" role="tab" aria-controls="digital" aria-selected="false">
                            <i class="fas fa-laptop me-1"></i> Recursos Digitales
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reservations-tab" data-bs-toggle="tab" data-bs-target="#reservations" type="button" role="tab" aria-controls="reservations" aria-selected="false">
                            <i class="fas fa-bookmark me-1"></i> Mis Reservas
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="false">
                            <i class="fas fa-history me-1"></i> Historial
                        </button>
                    </li>
                </ul>

                <!-- Contenido de las Pestañas -->
                <div class="tab-content" id="libraryTabsContent">
                    <!-- Catálogo -->
                    <div class="tab-pane fade show active" id="catalog" role="tabpanel" aria-labelledby="catalog-tab">
                        <h4 class="mb-4 mt-4">Libros Destacados</h4>
                        <div class="row">
                            <!-- Libro 1 -->
                            <div class="col-md-4 mb-4">
                                <div class="card book-card">
                                    <div class="card-body">
                                        <img src="https://via.placeholder.com/150x200/0056b3/ffffff?text=Libro" class="book-cover w-100" alt="Portada del libro">
                                        <h5 class="book-title">Fundamentos de Programación</h5>
                                        <p class="book-author">Por: María Rodríguez</p>
                                        <span class="book-status status-available">Disponible</span>
                                        <p class="small text-muted mb-3">Ubicación: Estante A-23</p>
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-sm">Reservar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Libro 2 -->
                            <div class="col-md-4 mb-4">
                                <div class="card book-card">
                                    <div class="card-body">
                                        <img src="https://via.placeholder.com/150x200/003d82/ffffff?text=Libro" class="book-cover w-100" alt="Portada del libro">
                                        <h5 class="book-title">Cálculo Diferencial e Integral</h5>
                                        <p class="book-author">Por: Carlos Martínez</p>
                                        <span class="book-status status-borrowed">Prestado</span>
                                        <p class="small text-muted mb-3">Disponible: 15/08/2023</p>
                                        <div class="d-grid">
                                            <button class="btn btn-outline-primary btn-sm">Lista de espera</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Libro 3 -->
                            <div class="col-md-4 mb-4">
                                <div class="card book-card">
                                    <div class="card-body">
                                        <img src="https://via.placeholder.com/150x200/0056b3/ffffff?text=Libro" class="book-cover w-100" alt="Portada del libro">
                                        <h5 class="book-title">Introducción a la Economía</h5>
                                        <p class="book-author">Por: Ana López</p>
                                        <span class="book-status status-reserved">Reservado</span>
                                        <p class="small text-muted mb-3">Disponible: 05/08/2023</p>
                                        <div class="d-grid">
                                            <button class="btn btn-outline-primary btn-sm">Lista de espera</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="mb-4 mt-2">Nuevas Adquisiciones</h4>
                        <div class="row">
                            <!-- Libro 4 -->
                            <div class="col-md-4 mb-4">
                                <div class="card book-card">
                                    <div class="card-body">
                                        <img src="https://via.placeholder.com/150x200/003d82/ffffff?text=Nuevo" class="book-cover w-100" alt="Portada del libro">
                                        <h5 class="book-title">Inteligencia Artificial: Fundamentos</h5>
                                        <p class="book-author">Por: David García</p>
                                        <span class="book-status status-available">Disponible</span>
                                        <p class="small text-muted mb-3">Ubicación: Estante C-15</p>
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-sm">Reservar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Libro 5 -->
                            <div class="col-md-4 mb-4">
                                <div class="card book-card">
                                    <div class="card-body">
                                        <img src="https://via.placeholder.com/150x200/0056b3/ffffff?text=Nuevo" class="book-cover w-100" alt="Portada del libro">
                                        <h5 class="book-title">Derecho Constitucional</h5>
                                        <p class="book-author">Por: Laura Sánchez</p>
                                        <span class="book-status status-available">Disponible</span>
                                        <p class="small text-muted mb-3">Ubicación: Estante D-07</p>
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-sm">Reservar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Libro 6 -->
                            <div class="col-md-4 mb-4">
                                <div class="card book-card">
                                    <div class="card-body">
                                        <img src="https://via.placeholder.com/150x200/003d82/ffffff?text=Nuevo" class="book-cover w-100" alt="Portada del libro">
                                        <h5 class="book-title">Anatomía Humana</h5>
                                        <p class="book-author">Por: Roberto Fernández</p>
                                        <span class="book-status status-available">Disponible</span>
                                        <p class="small text-muted mb-3">Ubicación: Estante B-12</p>
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-sm">Reservar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Paginación -->
                        <nav aria-label="Navegación de catálogo" class="mt-4">
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

                    <!-- Recursos Digitales -->
                    <div class="tab-pane fade" id="digital" role="tabpanel" aria-labelledby="digital-tab">
                        <h4 class="mb-4 mt-4">Bases de Datos Académicas</h4>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">JSTOR</h5>
                                        <p class="card-text">Accede a miles de artículos académicos, libros y fuentes primarias en múltiples disciplinas.</p>
                                        <a href="#" class="btn btn-primary">Acceder</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">ScienceDirect</h5>
                                        <p class="card-text">Plataforma líder de Elsevier que ofrece artículos de investigación en ciencia, tecnología y medicina.</p>
                                        <a href="#" class="btn btn-primary">Acceder</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">IEEE Xplore</h5>
                                        <p class="card-text">Biblioteca digital que proporciona acceso a publicaciones técnicas en ingeniería, informática y electrónica.</p>
                                        <a href="#" class="btn btn-primary">Acceder</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">ProQuest</h5>
                                        <p class="card-text">Plataforma que ofrece acceso a tesis, disertaciones, periódicos y revistas académicas.</p>
                                        <a href="#" class="btn btn-primary">Acceder</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="mb-4 mt-4">E-Books y Recursos Electrónicos</h4>
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-file-pdf resource-icon"></i>
                                    <span>Colección de E-Books de Ingeniería</span>
                                </div>
                                <span class="badge-count">125 libros</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-file-pdf resource-icon"></i>
                                    <span>Revistas Científicas Digitales</span>
                                </div>
                                <span class="badge-count">78 revistas</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-file-pdf resource-icon"></i>
                                    <span>Tesis y Trabajos de Grado</span>
                                </div>
                                <span class="badge-count">340 documentos</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-file-pdf resource-icon"></i>
                                    <span>Material Audiovisual Educativo</span>
                                </div>
                                <span class="badge-count">56 recursos</span>
                            </a>
                        </div>
                    </div>

                    <!-- Mis Reservas -->
                    <div class="tab-pane fade" id="reservations" role="tabpanel" aria-labelledby="reservations-tab">
                        <h4 class="mb-4 mt-4">Mis Libros Reservados</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Título</th>
                                        <th>Fecha de Reserva</th>
                                        <th>Fecha de Vencimiento</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Fundamentos de Bases de Datos</td>
                                        <td>15/07/2023</td>
                                        <td>29/07/2023</td>
                                        <td><span class="badge bg-success">Activo</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">Renovar</button>
                                            <button class="btn btn-sm btn-outline-danger">Cancelar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Redes de Computadoras</td>
                                        <td>10/07/2023</td>
                                        <td>24/07/2023</td>
                                        <td><span class="badge bg-warning text-dark">Por vencer</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">Renovar</button>
                                            <button class="btn btn-sm btn-outline-danger">Cancelar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle me-2"></i> Puedes renovar tus préstamos hasta 2 veces, siempre que no haya sido reservado por otro estudiante.
                        </div>

                        <h4 class="mb-4 mt-4">Lista de Espera</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Título</th>
                                        <th>Fecha de Solicitud</th>
                                        <th>Posición en Lista</th>
                                        <th>Disponibilidad Estimada</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Inteligencia Artificial: Un Enfoque Moderno</td>
                                        <td>18/07/2023</td>
                                        <td>2</td>
                                        <td>10/08/2023 (aprox.)</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-danger">Cancelar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Historial -->
                    <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                        <h4 class="mb-4 mt-4">Historial de Préstamos</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Título</th>
                                        <th>Fecha de Préstamo</th>
                                        <th>Fecha de Devolución</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Algoritmos y Estructuras de Datos</td>
                                        <td>01/06/2023</td>
                                        <td>15/06/2023</td>
                                        <td><span class="badge bg-success">Devuelto</span></td>
                                    </tr>
                                    <tr>
                                        <td>Física Universitaria</td>
                                        <td>15/05/2023</td>
                                        <td>29/05/2023</td>
                                        <td><span class="badge bg-success">Devuelto</span></td>
                                    </tr>
                                    <tr>
                                        <td>Cálculo de Varias Variables</td>
                                        <td>01/05/2023</td>
                                        <td>20/05/2023</td>
