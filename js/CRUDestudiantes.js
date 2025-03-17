// Cuando el documento esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Cargar lista de estudiantes
    loadStudents();
    
    // Evento para guardar estudiante
    document.getElementById('saveStudentBtn').addEventListener('click', function() {
        document.getElementById('addStudentForm').submit();
    });
    
    // Evento para previsualizar la imagen seleccionada
    document.getElementById('studentPhoto').addEventListener('change', function(e) {
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
    
    // Configurar eventos para botones de editar y eliminar
    setupActionButtons();
});

// Función para cargar estudiantes
function loadStudents() {
    fetch('list_students.php?ajax=1')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayStudents(data.data);
            } else {
                alert('Error al cargar estudiantes: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Función para mostrar estudiantes en la tabla
function displayStudents(students) {
    const tbody = document.querySelector('table tbody');
    tbody.innerHTML = '';
    
    students.forEach((student, index) => {
        const row = document.createElement('tr');
        
        // Determinar la clase de estado
        const statusClass = student.Estado === 'active' ? 'badge-active' : 'badge-inactive';
        const statusText = student.Estado === 'active' ? 'Activo' : 'Inactivo';
        
        // Determinar la ruta de la foto
        const photoSrc = student.Foto ? student.Foto : 'img/sombrero-de-graduacion.png';
        
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>
                <img src="${photoSrc}" class="student-photo" alt="Foto de ${student.Nombres}">
            </td>
            <td>${student.ID_estudiante}</td>
            <td>${student.Apellidos}, ${student.Nombres}</td>
            <td>${student.Grado}</td>
            <td>
                <span class="${statusClass}">${statusText}</span>
            </td>
            <td class="action-buttons">
                <button class="btn btn-sm btn-primary view-btn" data-id="${student.ID_estudiante}">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn btn-sm btn-warning edit-btn" data-id="${student.ID_estudiante}">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger delete-btn" data-id="${student.ID_estudiante}">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        
        tbody.appendChild(row);
    });
    
    // Configurar eventos para los nuevos botones
    setupActionButtons();
}

// Configurar eventos para botones de acción
function setupActionButtons() {
    // Botones de ver detalles
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function() {
            const studentId = this.getAttribute('data-id');
            viewStudent(studentId);
        });
    });
    
    // Botones de editar
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const studentId = this.getAttribute('data-id');
            editStudent(studentId);
        });
    });
    
    // Botones de eliminar
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const studentId = this.getAttribute('data-id');
            deleteStudent(studentId);
        });
    });
}

// Función para ver detalles de un estudiante
function viewStudent(studentId) {
    fetch(`get_student.php?id=${studentId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const student = data.data;
                
                // Determinar la ruta de la foto
                const photoSrc = student.Foto ? student.Foto : 'img/sombrero-de-graduacion.png';
                
                // Determinar el estado
                const statusText = student.Estado === 'active' ? 'Activo' : 'Inactivo';
                
                // Crear contenido HTML para el modal
                const modalBody = document.querySelector('#viewStudentModal .modal-body');
                modalBody.innerHTML = `
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="${photoSrc}" class="student-detail-photo mb-3" alt="Foto de ${student.Nombres}">
                        </div>
                        <div class="col-md-8">
                            <h4 class="student-detail-name">${student.Nombres} ${student.Apellidos}</h4>
                            <p class="student-detail-id">ID: ${student.ID_estudiante}</p>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Tipo de Documento:</strong> ${student.Type_Doc}</p>
                                    <p><strong>Fecha de Nacimiento:</strong> ${formatDate(student.Fecha_Nac)}</p>
                                    <p><strong>Género:</strong> ${getGenderText(student.Genero)}</p>
                                    <p><strong>Correo:</strong> ${student.Correo}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Dirección:</strong> ${student.Direccion}</p>
                                    <p><strong>Ciudad:</strong> ${student.Ciudad}</p>
                                    <p><strong>Programa:</strong> ${student.Grado}</p>
                                    <p><strong>Fecha de Ingreso:</strong> ${formatDate(student.Fecha_Ing)}</p>
                                </div>
                            </div>
                            
                            <p><strong>Estado:</strong> <span class="${student.Estado === 'active' ? 'badge-active' : 'badge-inactive'}">${statusText}</span></p>
                            
                            <div class="mt-3">
                                <h5>Observaciones:</h5>
                                <p>${student.Comentarios || 'Sin observaciones'}</p>
                            </div>
                        </div>
                    </div>
                `;
                
                // Mostrar modal
                const viewModal = new bootstrap.Modal(document.getElementById('viewStudentModal'));
                viewModal.show();
            } else {
                alert('Error al cargar detalles del estudiante: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Función para editar un estudiante
function editStudent(studentId) {
    fetch(`get_student.php?id=${studentId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const student = data.data;
                
                // Llenar formulario con datos del estudiante
                document.getElementById('studentId').value = student.ID_estudiante;
                document.getElementById('documentType').value = student.Type_Doc;
                document.getElementById('birthDate').value = student.Fecha_Nac;
                document.getElementById('firstName').value = student.Nombres;
                document.getElementById('lastName').value = student.Apellidos;
                document.getElementById('gender').value = student.Genero;
                document.getElementById('email').value = student.Correo;
                document.getElementById('address').value = student.Direccion;
                document.getElementById('city').value = student.Ciudad;
                document.getElementById('program').value = student.Grado;
                document.getElementById('admissionDate').value = student.Fecha_Ing;
                document.getElementById('status').value = student.Estado;
                document.getElementById('observations').value = student.Comentarios;
                
                // Mostrar foto actual si existe
                const photoPreview = document.getElementById('photoPreview');
                if (student.Foto) {
                    photoPreview.innerHTML = `<img src="${student.Foto}" alt="Foto de ${student.Nombres}">`;
                    
                    // Agregar campo oculto para la foto actual
                    const currentPhotoInput = document.createElement('input');
                    currentPhotoInput.type = 'hidden';
                    currentPhotoInput.name = 'currentPhoto';
                    currentPhotoInput.value = student.Foto;
                    document.getElementById('addStudentForm').appendChild(currentPhotoInput);
                } else {
                    photoPreview.innerHTML = `
                        <div class="photo-preview-text">
                            <i class="fas fa-camera fa-2x mb-2"></i><br>
                            Haga clic para seleccionar una foto
                        </div>
                    `;
                }
                
                // Cambiar acción del formulario a update_student.php
                document.getElementById('addStudentForm').action = 'update_student.php';
                
                // Cambiar título del modal
                document.getElementById('addStudentModalLabel').innerHTML = `
                    <i class="fas fa-edit me-2"></i> Editar Estudiante
                `;
                
                // Cambiar texto del botón de guardar
                document.getElementById('saveStudentBtn').innerHTML = `
                    <i class="fas fa-save me-1"></i> Actualizar Estudiante
                `;
                
                // Deshabilitar campo de ID (no debe cambiar)
                document.getElementById('studentId').readOnly = true;
                
                // Mostrar modal
                const editModal = new bootstrap.Modal(document.getElementById('addStudentModal'));
                editModal.show();
            } else {
                alert('Error al cargar datos del estudiante: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Función para eliminar un estudiante
function deleteStudent(studentId) {
    if (confirm('¿Está seguro de que desea eliminar este estudiante? Esta acción no se puede deshacer.')) {
        const formData = new FormData();
        formData.append('studentId', studentId);
        
        fetch('delete_student.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Estudiante eliminado correctamente');
                loadStudents(); // Recargar lista de estudiantes
            } else {
                alert('Error al eliminar estudiante: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

// Función para formatear fechas
function formatDate(dateString) {
    if (!dateString) return 'No disponible';
    
    const date = new Date(dateString);
    return date.toLocaleDateString('es-ES', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}

// Función para obtener texto del género
function getGenderText(genderCode) {
    switch(genderCode) {
        case 'M': return 'Masculino';
        case 'F': return 'Femenino';
        case 'O': return 'Otro';
        default: return 'No especificado';
    }
}

// Función para resetear el formulario cuando se abre el modal de agregar
document.getElementById('addStudentModal').addEventListener('hidden.bs.modal', function () {
    // Resetear formulario
    document.getElementById('addStudentForm').reset();
    
    // Resetear vista previa de foto
    document.getElementById('photoPreview').innerHTML = `
        <div class="photo-preview-text">
            <i class="fas fa-camera fa-2x mb-2"></i><br>
            Haga clic para seleccionar una foto
        </div>
    `;
    
    // Eliminar campo oculto de foto actual si existe
    const currentPhotoInput = document.querySelector('input[name="currentPhoto"]');
    if (currentPhotoInput) {
        currentPhotoInput.remove();
    }
    
    // Restaurar acción del formulario
    document.getElementById('addStudentForm').action = 'save_student.php';
    
    // Restaurar título del modal
    document.getElementById('addStudentModalLabel').innerHTML = `
        <i class="fas fa-user-plus me-2"></i> Agregar Nuevo Estudiante
    `;
    
    // Restaurar texto del botón de guardar
    document.getElementById('saveStudentBtn').innerHTML = `
        <i class="fas fa-save me-1"></i> Guardar Estudiante
    `;
    
    // Habilitar campo de ID
    document.getElementById('studentId').readOnly = false;
});

// Manejar respuesta después de enviar formulario
document.getElementById('addStudentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch(this.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            
            // Cerrar modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addStudentModal'));
            modal.hide();
            
            // Recargar lista de estudiantes
            loadStudents();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ha ocurrido un error al procesar la solicitud');
    });
});

