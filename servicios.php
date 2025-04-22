<?php include "shared/header.php"; ?>

<style>
/* Estilo general para la página */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    color: #333;
}

h1 {
    text-align: center;
    font-size: 2.5rem;
    margin: 2rem 0;
    color: #444;
}

/* Contenedor principal para centrar las secciones */
.services-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 2rem;
    padding: 2rem;
}

/* Estilo para las secciones */
.section {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 300px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.section:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
}

.section-title {
    font-size: 1.8rem;
    margin-bottom: 1rem;
    color: #007bff;
}

.section-content {
    font-size: 1rem;
    color: #555;
    margin-bottom: 1.5rem;
}

.section-content ul {
    list-style-type: none;
    padding: 0;
}

.section-content ul li {
    margin: 0.5rem 0;
}

/* Estilo para los íconos */
.fa-icon {
    font-size: 3rem;
    color: #007bff;
    margin-bottom: 1rem;
}

/* Estilo para los botones */
.btn-ir-ahora {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    font-size: 1rem;
    color: #fff;
    background-color: #007bff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn-ir-ahora:hover {
    background-color: #0056b3;
}
</style>

<body>
    <h1 class="page-title">Servicios</h1>

    <div class="services-container">
        <!-- Sección de Comunicación -->
        <div class="section">
            <i class="fa-solid fa-comments fa-icon"></i>
            <h2 class="section-title">Comunicación</h2>
            <div class="section-content">
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

        <!-- Sección de Pago de Matrícula -->
        <div class="section">
            <i class="fa-solid fa-credit-card fa-icon"></i>
            <h2 class="section-title">Pago de Matrícula</h2>
            <div class="section-content">
                <ul>
                    <li>
                        <strong>Gestión de pago de la Matrícula</strong>
                        Realiza el pago de tu matrícula en línea.
                    </li>
                </ul>
                <a href="pagoMatricula.php" class="btn-ir-ahora">Ir ahora</a>
            </div>
        </div>

        <!-- Sección de Biblioteca y Recursos -->
        <div class="section">
            <i class="fa-solid fa-book fa-icon"></i>
            <h2 class="section-title">Biblioteca</h2>
            <div class="section-content">
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
</body>

<?php include "shared/footer.php"; ?>