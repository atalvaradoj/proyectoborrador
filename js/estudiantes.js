// js/estudiantes.js

document.addEventListener('DOMContentLoaded', function () {
    // Configurar el modal de eliminación
    const deleteButtons = document.querySelectorAll('.delete-student');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const studentId = this.getAttribute('data-id');
            const studentName = this.getAttribute('data-name');

            // Actualizar el modal con la información del estudiante
            document.getElementById('deleteStudentId').value = studentId;
            document.getElementById('deleteStudentName').textContent = studentName;
        });
    });

    // Manejar el botón de confirmación de eliminación
    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        // Mostrar indicador de carga
        this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Eliminando...';
        this.disabled = true;

        // Enviar el formulario
        document.getElementById('deleteStudentForm').submit();
    });

    // Manejar el botón de guardar estudiante
    document.getElementById('saveStudentBtn').addEventListener('click', function () {
        // Mostrar indicador de carga
        this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...';
        this.disabled = true;

        // Enviar el formulario
        document.getElementById('addStudentForm').submit();
    });

    // Configurar el modal de edición
    const editButtons = document.querySelectorAll('.edit-student');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const studentId = this.getAttribute('data-id');

            // Mostrar loader y ocultar formulario
            document.getElementById('editStudentLoader').style.display = 'block';
            document.getElementById('editStudentForm').style.display = 'none';

            // Cargar datos del estudiante
            fetch(`controllers/get_student.php?id=${studentId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Ocultar loader y mostrar formulario
                        document.getElementById('editStudentLoader').style.display = 'none';
                        document.getElementById('editStudentForm').style.display = 'block';

                        // Llenar el formulario con los datos del estudiante
                        const student = data.data;

                        // ID y foto
                        document.getElementById('editStudentId').value = student.ID_estudiante;
                        document.getElementById('currentPhoto').value = student.Foto;

                        // Mostrar la foto actual
                        const photoPreview = document.getElementById('editPhotoPreview');
                        if (student.photo_url) {
                            photoPreview.innerHTML = `<img src="${student.photo_url}" class="img-fluid preview-img" alt="Foto actual">`;
                            photoPreview.classList.add('has-image');
                        }

                        // Datos personales
                        document.getElementById('editFirstName').value = student.Nombres;
                        document.getElementById('editLastName').value = student.Apellidos;
                        document.getElementById('editDocumentType').value = student.Tipo_documento;
                        document.getElementById('editBirthDate').value = student.Fecha_nacimiento;
                        document.getElementById('editGender').value = student.Genero;
                        document.getElementById('editEmail').value = student.Email;

                        // Dirección
                        document.getElementById('editAddress').value = student.Direccion;
                        document.getElementById('editCity').value = student.Ciudad;

                        // Datos académicos
                        document.getElementById('editProgram').value = student.Grado;
                        document.getElementById('editAdmissionDate').value = student.Fecha_ingreso;
                        document.getElementById('editStatus').value = student.Estado;
                        document.getElementById('editObservations').value = student.Observaciones;
                    } else {
                        // Mostrar mensaje de error
                        alert('Error al cargar los datos del estudiante: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al cargar los datos del estudiante. Por favor, inténtelo de nuevo.');
                });
        });
    });

    // Manejar el botón de actualizar estudiante
    document.getElementById('updateStudentBtn').addEventListener('click', function () {
        // Mostrar indicador de carga
        this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...';
        this.disabled = true;

        // Enviar el formulario
        document.getElementById('editStudentForm').submit();
    });

    // Previsualización de la foto en el formulario de agregar
    const photoInput = document.getElementById('studentPhoto');
    const photoPreview = document.getElementById('photoPreview');

    if (photoInput && photoPreview) {
        photoInput.addEventListener('change', function () {
            previewImage(this, photoPreview);
        });

        photoPreview.addEventListener('click', function () {
            photoInput.click();
        });
    }

    // Previsualización de la foto en el formulario de editar
    const editPhotoInput = document.getElementById('editStudentPhoto');
    const editPhotoPreview = document.getElementById('editPhotoPreview');

    if (editPhotoInput && editPhotoPreview) {
        editPhotoInput.addEventListener('change', function () {
            previewImage(this, editPhotoPreview);
        });

        editPhotoPreview.addEventListener('click', function () {
            editPhotoInput.click();
        });
    }

    // Función para previsualizar imágenes
    function previewImage(input, previewElement) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                previewElement.innerHTML = `<img src="${e.target.result}" class="img-fluid preview-img" alt="Vista previa">`;
                previewElement.classList.add('has-image');
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            previewElement.innerHTML = `
                <div class="photo-preview-text">
                    <i class="fas fa-camera fa-2x mb-2"></i><br>
                    Haga clic para seleccionar una foto
                </div>
            `;
            previewElement.classList.remove('has-image');
        }
    }

    // Búsqueda con tecla Enter
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('searchForm').submit();
            }
        });

        // Limpiar búsqueda al hacer clic en el campo si hay texto
        searchInput.addEventListener('click', function () {
            if (this.value) {
                const clearSearch = confirm('¿Desea limpiar el campo de búsqueda?');
                if (clearSearch) {
                    this.value = '';
                }
            }
        });
    }

    // Manejar correctamente el foco en los modales
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function () {
            // Asegurarse de que ningún elemento dentro del modal mantenga el foco
            document.activeElement.blur();

            // Alternativa: enfocar un elemento seguro fuera del modal
            document.querySelector('body').focus();
        });
    });
});
