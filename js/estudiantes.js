// estudiantes.js

// Código para previsualizar la imagen seleccionada
document.addEventListener('DOMContentLoaded', function() {
    // Previsualización de imagen
    const photoInput = document.getElementById('studentPhoto');
    if (photoInput) {
        photoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const photoPreview = document.getElementById('photoPreview');
                    photoPreview.innerHTML = `<img src="${event.target.result}" alt="Vista previa de foto">`;
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Manejo del botón de guardar estudiante
    const saveBtn = document.getElementById('saveStudentBtn');
    if (saveBtn) {
        saveBtn.addEventListener('click', function() {
            // Obtener el formulario
            const form = document.getElementById('addStudentForm');

            // Verificar si el formulario es válido
            if (form.checkValidity()) {
                // Mostrar indicador de carga
                this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...';
                this.disabled = true;

                // Enviar el formulario
                form.submit();
            } else {
                // Mostrar validaciones del navegador
                form.reportValidity();
            }
        });
    }

    // Cerrar automáticamente las alertas después de 5 segundos
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const closeButton = alert.querySelector('.btn-close');
            if (closeButton) {
                closeButton.click();
            }
        }, 5000);
    });
});
