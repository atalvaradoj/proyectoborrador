<?php include "shared/header.php"; ?>

<head>
    <title>Pago de Matrícula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .page-header {
            background-color: #0056b3;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .card {
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #0056b3;
            border: none;
        }

        .btn-primary:hover {
            background-color: #003d82;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="page-header">
            <h1>Pago de Matrícula</h1>
            <p>Completa el pago de la matrícula de tu hijo/a de manera rápida y segura</p>
        </div>

        <div class="card">
            <div class="card-body">
                <form>
                    <!-- Datos del Padre/Madre -->
                    <h4 class="mb-3">Datos del Padre/Madre</h4>
                    <div class="mb-3">
                        <label for="parentName" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="parentName" placeholder="Ingrese su nombre completo" required>
                    </div>
                    <div class="mb-3">
                        <label for="parentEmail" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="parentEmail" placeholder="Ingrese su correo electrónico" required>
                    </div>
                    <div class="mb-3">
                        <label for="parentPhone" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="parentPhone" placeholder="Ingrese su número de teléfono" required>
                    </div>

                    <!-- Datos del Estudiante -->
                    <h4 class="mb-3">Datos del Estudiante</h4>
                    <div class="mb-3">
                        <label for="studentName" class="form-label">Nombre Completo del Estudiante</label>
                        <input type="text" class="form-control" id="studentName" placeholder="Ingrese el nombre completo del estudiante" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentId" class="form-label">Número de Identificación del Estudiante</label>
                        <input type="text" class="form-control" id="studentId" placeholder="Ingrese el número de identificación del estudiante" required>
                    </div>
                    <div class="mb-3">
                        <label for="program" class="form-label">Programa Académico</label>
                        <select class="form-select" id="program" required>
                            <option value="" selected disabled>Seleccione un programa</option>
                            <option value="primaria">Primaria</option>
                            <option value="secundaria">Secundaria</option>
                            <option value="preescolar">Preescolar</option>
                        </select>
                    </div>

                    <!-- Método de Pago -->
                    <h4 class="mb-3">Detalles del Pago</h4>
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Método de Pago</label>
                        <select class="form-select" id="paymentMethod" required>
                            <option value="" selected disabled>Seleccione un método</option>
                            <option value="credit">Tarjeta de Crédito/Débito</option>
                            <option value="bank">Transferencia Bancaria</option>
                            <option value="online">Pago en Línea</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="paymentAmount" class="form-label">Monto a Pagar</label>
                        <input type="number" class="form-control" id="paymentAmount" placeholder="Ingrese el monto a pagar" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Proceder al Pago</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include "shared/footer.php"; ?>
</body>
</html>