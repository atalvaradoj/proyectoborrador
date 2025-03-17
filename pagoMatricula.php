<?php include "shared/header.php" ?>

<head>
    <title>Pago de Matrícula - Sistema Académico</title>
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
            margin-bottom: 40px;
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
            margin-bottom: 30px;
            overflow: hidden;
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
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #003d82;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-secondary {
            color: #0056b3;
            border-color: #0056b3;
            border-radius: 5px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: #0056b3;
            color: white;
        }

        .payment-method {
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-method:hover, .payment-method.selected {
            border-color: #0056b3;
            background-color: rgba(0, 86, 179, 0.05);
        }

        .payment-method.selected {
            box-shadow: 0 0 0 1px #0056b3;
        }

        .payment-icon {
            font-size: 1.8rem;
            color: #0056b3;
            margin-right: 15px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-label {
            font-weight: 600;
            color: #555;
        }

        .summary-value {
            font-weight: 700;
            color: #0056b3;
        }

        .total-row {
            font-size: 1.2rem;
            font-weight: 700;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #0056b3;
        }

        .steps-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .step {
            flex: 1;
            text-align: center;
            padding: 15px 10px;
            position: relative;
        }

        .step:not(:last-child):after {
            content: '';
            position: absolute;
            top: 50%;
            right: -10px;
            width: 20px;
            height: 2px;
            background-color: #ced4da;
        }

        .step.active:not(:last-child):after {
            background-color: #0056b3;
        }

        .step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #ced4da;
            color: white;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .step.active .step-number {
            background-color: #0056b3;
        }

        .step-title {
            font-weight: 600;
            color: #555;
        }

        .step.active .step-title {
            color: #0056b3;
        }

        .success-icon {
            font-size: 5rem;
            color: #28a745;
            margin-bottom: 20px;
        }

        .receipt-container {
            background-color: #f8f9fa;
            border: 1px dashed #ced4da;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ced4da;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem;
            }
            
            .steps-container {
                flex-direction: column;
            }
            
            .step {
                margin-bottom: 15px;
            }
            
            .step:not(:last-child):after {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-4 mb-5">
        <div class="page-header">
            <h1 class="page-title">Pago de Matrícula</h1>
            <p class="page-subtitle">Completa tu proceso de matrícula de manera rápida y segura</p>
        </div>

        <div class="steps-container">
            <div class="step active">
                <div class="step-number">1</div>
                <div class="step-title">Información del Estudiante</div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-title">Método de Pago</div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-title">Confirmación</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Formulario de Información del Estudiante -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-user-graduate me-2"></i> Información del Estudiante
                    </div>
                    <div class="card-body">
                        <form id="studentForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="studentId" class="form-label">Número de Identificación</label>
                                    <input type="text" class="form-control" id="studentId" placeholder="Ingrese su número de identificación" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="studentType" class="form-label">Tipo de Estudiante</label>
                                    <select class="form-select" id="studentType" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        <option value="new">Nuevo Ingreso</option>
                                        <option value="regular">Regular</option>
                                        <option value="transfer">Transferencia</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Ingrese sus nombres" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Ingrese sus apellidos" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email" placeholder="ejemplo@correo.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" id="phone" placeholder="(000) 000-0000" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="program" class="form-label">Programa Académico</label>
                                    <select class="form-select" id="program" required>
                                        <option value="" selected disabled>Seleccione un programa</option>
                                        <option value="ing_sistemas">Ingeniería de Sistemas</option>
                                        <option value="ing_industrial">Ingeniería Industrial</option>
                                        <option value="administracion">Administración de Empresas</option>
                                        <option value="contaduria">Contaduría Pública</option>
                                        <option value="derecho">Derecho</option>
                                        <option value="medicina">Medicina</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="semester" class="form-label">Semestre</label>
                                    <select class="form-select" id="semester" required>
                                        <option value="" selected disabled>Seleccione un semestre</option>
                                        <option value="1">Primer Semestre</option>
                                        <option value="2">Segundo Semestre</option>
                                        <option value="3">Tercer Semestre</option>
                                        <option value="4">Cuarto Semestre</option>
                                        <option value="5">Quinto Semestre</option>
                                        <option value="6">Sexto Semestre</option>
                                        <option value="7">Séptimo Semestre</option>
                                        <option value="8">Octavo Semestre</option>
                                        <option value="9">Noveno Semestre</option>
                                        <option value="10">Décimo Semestre</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Métodos de Pago -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-credit-card me-2"></i> Método de Pago
                    </div>
                    <div class="card-body">
                        <div class="payment-method selected" onclick="selectPayment(this, 'credit')">
                            <div class="d-flex align-items-center">
                                <input type="radio" name="paymentMethod" id="creditCard" value="credit" checked class="me-2">
                                <i class="fas fa-credit-card payment-icon"></i>
                                <div>
                                    <label for="creditCard" class="form-label mb-0">Tarjeta de Crédito/Débito</label>
                                    <p class="text-muted mb-0 small">Pago seguro con tarjeta Visa, Mastercard, American Express</p>
                                </div>
                            </div>
                        </div>

                        <div class="payment-method" onclick="selectPayment(this, 'bank')">
                            <div class="d-flex align-items-center">
                                <input type="radio" name="paymentMethod" id="bankTransfer" value="bank" class="me-2">
                                <i class="fas fa-university payment-icon"></i>
                                <div>
                                    <label for="bankTransfer" class="form-label mb-0">Transferencia Bancaria</label>
                                    <p class="text-muted mb-0 small">Transferencia directa a nuestra cuenta bancaria</p>
                                </div>
                            </div>
                        </div>

                        <div class="payment-method" onclick="selectPayment(this, 'online')">
                            <div class="d-flex align-items-center">
                                <input type="radio" name="paymentMethod" id="onlinePayment" value="online" class="me-2">
                                <i class="fas fa-globe payment-icon"></i>
                                <div>
                                    <label for="onlinePayment" class="form-label mb-0">Pago en Línea</label>
                                    <p class="text-muted mb-0 small">PayPal, Apple Pay, Google Pay</p>
                                </div>
                            </div>
                        </div>

                        <!-- Formulario de Tarjeta de Crédito (visible por defecto) -->
                        <div id="creditCardForm" class="mt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="cardNumber" class="form-label">Número de Tarjeta</label>
                                    <input type="text" class="form-control" id="cardNumber" placeholder="0000 0000 0000 0000" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="expiryDate" class="form-label">Fecha de Expiración</label>
                                    <input type="text" class="form-control" id="expiryDate" placeholder="MM/AA" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cvv" placeholder="123" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="cardName" class="form-label">Nombre en la Tarjeta</label>
                                    <input type="text" class="form-control" id="cardName" placeholder="Nombre como aparece en la tarjeta" required>
                                </div>
                            </div>
                        </div>

                        <!-- Formulario de Transferencia Bancaria (oculto por defecto) -->
                        <div id="bankTransferForm" class="mt-4" style="display: none;">
                            <div class="alert alert-info">
                                <h5><i class="fas fa-info-circle me-2"></i> Instrucciones para Transferencia Bancaria</h5>
                                <p>Por favor realice la transferencia a la siguiente cuenta bancaria:</p>
                                <ul>
                                    <li><strong>Banco:</strong> Banco Nacional</li>
                                    <li><strong>Titular:</strong> Universidad Nacional</li>
                                    <li><strong>Cuenta:</strong> 0012-3456-7890-1234</li>
                                    <li><strong>Referencia:</strong> Incluya su número de identificación</li>
                                </ul>
                                <p>Una vez realizada la transferencia, por favor suba el comprobante:</p>
                            </div>
                            <div class="mb-3">
                                <label for="transferProof" class="form-label">Comprobante de Transferencia</label>
                                <input class="form-control" type="file" id="transferProof">
                            </div>
                        </div>

                        <!-- Formulario de Pago en Línea (oculto por defecto) -->
                        <div id="onlinePaymentForm" class="mt-4" style="display: none;">
                            <div class="alert alert-info">
                                <h5><i class="fas fa-info-circle me-2"></i> Pago en Línea</h5>
                                <p>Al hacer clic en "Proceder al Pago", será redirigido a nuestra plataforma segura de pagos en línea donde podrá completar la transacción.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Volver
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showConfirmation()">
                        Proceder al Pago <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Resumen de Pago -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-receipt me-2"></i> Resumen de Pago
                    </div>
                    <div class="card-body">
                        <div class="summary-item">
                            <span class="summary-label">Matrícula Académica</span>
                            <span class="summary-value">$2,500,000</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Seguro Estudiantil</span>
                            <span class="summary-value">$150,000</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Carné Estudiantil</span>
                            <span class="summary-value">$50,000</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Servicios Complementarios</span>
                            <span class="summary-value">$200,000</span>
                        </div>
                        <div class="summary-item total-row">
                            <span class="summary-label">Total a Pagar</span>
                            <span class="summary-value">$2,900,000</span>
                        </div>
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="card mt-4">
                    <div class="card-header">
                        <i class="fas fa-info-circle me-2"></i> Información Importante
                    </div>
                    <div class="card-body">
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span>El pago de matrícula es requisito para iniciar clases.</li>
                            <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span>Recuerde conservar su comprobante de pago.</li>
                            <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span>Para pagos parciales, comuníquese con la oficina financiera.</li>
                            <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span>Verifique su horario de clases después de completar el pago.</li>
                        </ul>
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-exclamation-triangle me-2"></i> La fecha límite para el pago de matrícula es el <strong>30 de julio de 2023</strong>.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmación (oculto por defecto) -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="confirmationModalLabel">
                            <i class="fas fa-check-circle me-2"></i> Pago Exitoso
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center py-4">
                        <i class="fas fa-check-circle success-icon"></i>
                        <h3 class="mb-4">¡Tu pago ha sido procesado exitosamente!</h3>
                        <p class="lead">Gracias por completar tu proceso de matrícula. Hemos enviado un comprobante a tu correo electrónico.</p>
                        
                        <div class="receipt-container mt-4">
                            <div class="receipt-header">
                                <h4>Comprobante de Pago</h4>
                                <p class="mb-0">Universidad Nacional</p>
                            </div>
                            
                            <div class="row text-start">
                                <div class="col-md-6">
                                    <p><strong>Estudiante:</strong> <span id="receiptName">Juan Pérez</span></p>
                                    <p><strong>ID Estudiante:</strong> <span id="receiptId">12345678</span></p>
                                    <p><strong>Programa:</strong> <span id="receiptProgram">Ingeniería de Sistemas</span></p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <p><strong>Fecha:</strong> <span id="receiptDate">25/07/2023</span></p>
                                    <p><strong>Referencia:</strong> <span id="receiptReference">PAY-2023-78945</span></p>
                                    <p><strong>Estado:</strong> <span class="badge bg-success">Pagado</span></p>
                                </div>
                            </div>
                            
                            <div class="table-responsive mt-3">
                                <table class="table table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Concepto</th>
                                            <th class="text-end">Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Matrícula Académica</td>
                                            <td class="text-end">$2,500,000</td>
                                        </tr>
                                        <tr>
                                            <td>Seguro Estudiantil</td>
                                            <td class="text-end">$150,000</td>
                                        </tr>
                                        <tr>
                                            <td>Carné Estudiantil</td>
                                            <td class="text-end">$50,000</td>
                                        </tr>
                                        <tr>
                                            <td>Servicios Complementarios</td>
                                            <td class="text-end">$200,000</td>
                                        </tr>
                                        <tr class="table-active fw-bold">
                                            <td>Total</td>
                                            <td class="text-end">$2,900,000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-download me-2"></i> Descargar Comprobante
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "shared/footer.php" ?>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    
    <script>
        // Función para seleccionar método de pago
        function selectPayment(element, method) {
            // Quitar la clase selected de todos los métodos
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('selected');
            });
            
            // Agregar la clase selected al método seleccionado
            element.classList.add('selected');
            
            // Marcar el radio button correspondiente
            document.querySelector(`input[value="${method}"]`).checked = true;
            
            // Ocultar todos los formularios
            document.getElementById('creditCardForm').style.display = 'none';
            document.getElementById('bankTransferForm').style.display = 'none';
            document.getElementById('onlinePaymentForm').style.display = 'none';
            
            // Mostrar el formulario correspondiente
            document.getElementById(`${method}${method === 'online' ? 'Payment' : ''}Form`).style.display = 'block';
        }
        
        // Función para mostrar el modal de confirmación
        function showConfirmation() {
            // En una aplicación real, aquí iría la validación del formulario y el procesamiento del pago
            
            // Actualizar datos del recibo con los valores del formulario
            document.getElementById('receiptName').textContent = 
                document.getElementById('firstName').value + ' ' + document.getElementById('lastName').value;
            document.getElementById('receiptId').textContent = document.getElementById('studentId').value;
            
            // Obtener el texto del programa seleccionado
            const programSelect = document.getElementById('program');
            const programText = programSelect.options[programSelect.selectedIndex].text;
            document.getElementById('receiptProgram').textContent = programText;
            
            // Establecer la fecha actual
            const today = new Date();
            document.getElementById('receiptDate').textContent = 
                today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
            
            // Generar una referencia aleatoria
            document.getElementById('receiptReference').textContent = 
                'PAY-' + today.getFullYear() + '-' + Math.floor(10000 + Math.random() * 90000);
            
            // Mostrar el modal
            var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.show();
        }
    </script>
</body>

</html>
