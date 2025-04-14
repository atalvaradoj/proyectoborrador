<?php include "shared/header.php" ?>

<main class="container">
    <!-- Sección de Contacto -->
    <section id="contacto" class="my-5">
        <h2 class="mb-4 text-center">Contáctenos</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-info mb-4">
                    <h4>Información de Contacto</h4>
                    <p><strong>Dirección:</strong> Costado Sur del Estadio de Heredia, Heredia</p>
                    <p><strong>Teléfono:</strong> (506) 2222-3333</p>
                    <p><strong>Email:</strong> info@lagalletaestudiosa.com</p>
                    <p><strong>Horario:</strong> Lunes a Viernes 8:00 AM - 5:00 PM</p>
                </div>
            </div>
            
            <div class="col-md-6">
                <form id="formulario-contacto" method="post" action="procesar_contacto.php">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono">
                    </div>
                    
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Enviar mensaje</button>
                </form>
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
</main>

<?php include "shared/footer.php" ?>