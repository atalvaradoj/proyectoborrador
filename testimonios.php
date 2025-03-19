<?php include "shared/header.php" ?>

<div class="container mt-5">
    <h1 class="text-center">Testimonios</h1>

    <!-- Formulario simple para testimonios -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Comparte tu experiencia</h5>
                    <form>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Escribe tu testimonio aquí"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonios de ejemplo -->
    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>Ana García</h5>
                    <p>Excelente servicio, muy recomendado.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>Carlos Rodríguez</h5>
                    <p>Muy satisfecho con la atención recibida.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>Laura Martínez</h5>
                    <p>Los resultados superaron mis expectativas.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "shared/footer.php" ?>