<!-- Modales para el CRUD de Docentes -->

<!-- Modal para Agregar Docente -->
<div class="modal fade" id="addDocenteModal" tabindex="-1" aria-labelledby="addDocenteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addDocenteModalLabel">
                    <i class="fas fa-user-plus me-2"></i> Agregar Nuevo Docente
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addDocenteForm" method="post" action="controllers/save_teacher.php">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="teacherId" class="form-label">ID Docente</label>
                                <input type="text" class="form-control" id="teacherId" name="ID_docente" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="teacherEmail" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="teacherEmail" name="Correo" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="teacherFirstName" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="teacherFirstName" name="Nombres" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="teacherLastName" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="teacherLastName" name="Apellidos" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="teacherSpecialty" class="form-label">Especialidad</label>
                        <select class="form-select" id="teacherSpecialty" name="Especialidad" required>
                            <option value="Español">Español</option>
                            <option value="Matemáticas">Matemáticas</option>
                            <option value="Ciencias">Ciencias</option>
                            <option value="Estudios Sociales">Estudios Sociales</option>
                            <option value="Artes Industriales">Artes Industriales</option>
                            <option value="Inglés">Inglés</option>
                            <option value="Cómputo">Cómputo</option>
                            <option value="Otra">Otra</option>
                        </select>
                    </div>
                    <div class="mb-3" id="otherSpecialtyContainer" style="display: none;">
                        <label for="teacherOtherSpecialty" class="form-label">Otra Especialidad</label>
                        <input type="text" class="form-control" id="teacherOtherSpecialty" name="Otra_especialidad">
                    </div>
                    <div class="mb-3">
                        <label for="teacherComments" class="form-label">Comentarios</label>
                        <textarea class="form-control" id="teacherComments" name="Comentarios" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" form="addDocenteForm">
                    <i class="fas fa-save me-1"></i> Guardar Docente
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts para el CRUD de Docentes -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const specialtySelect = document.getElementById('teacherSpecialty');
        const otherSpecialtyContainer = document.getElementById('otherSpecialtyContainer');
        const otherSpecialtyInput = document.getElementById('teacherOtherSpecialty');

        specialtySelect.addEventListener('change', function () {
            if (this.value === 'Otra') {
                otherSpecialtyContainer.style.display = 'block';
                otherSpecialtyInput.required = true;
            } else {
                otherSpecialtyContainer.style.display = 'none';
                otherSpecialtyInput.required = false;
                otherSpecialtyInput.value = ''; // Limpiar el campo
            }
        });

        // Script para manejar el botón de eliminar docente
        const deleteButtons = document.querySelectorAll('.delete-teacher');
        const deleteTeacherIdInput = document.getElementById('deleteTeacherId');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const teacherId = this.getAttribute('data-id');
                deleteTeacherIdInput.value = teacherId;
            });
        });

        // Script para manejar el botón de editar docente
        const editButtons = document.querySelectorAll('.edit-teacher');
        const editTeacherIdInput = document.getElementById('editTeacherId');
        const editFirstNameInput = document.getElementById('editTeacherFirstName');
        const editLastNameInput = document.getElementById('editTeacherLastName');
        const editEmailInput = document.getElementById('editTeacherEmail');
        const editSpecialtySelect = document.getElementById('editTeacherSpecialty');
        const editOtherSpecialtyInput = document.getElementById('editTeacherOtherSpecialty');
        const editCommentsTextarea = document.getElementById('editTeacherComments');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const teacherId = this.getAttribute('data-id');
                const firstName = this.getAttribute('data-firstname');
                const lastName = this.getAttribute('data-lastname');
                const email = this.getAttribute('data-email');
                const specialty = this.getAttribute('data-specialty');
                const otherSpecialty = this.getAttribute('data-other-specialty');
                const comments = this.getAttribute('data-comments');

                // Cargar los datos en el formulario
                editTeacherIdInput.value = teacherId;
                editFirstNameInput.value = firstName;
                editLastNameInput.value = lastName;
                editEmailInput.value = email;
                editSpecialtySelect.value = specialty;
                editOtherSpecialtyInput.value = otherSpecialty;
                editCommentsTextarea.value = comments;

                // Mostrar el campo "Otra Especialidad" si corresponde
                if (specialty === 'Otra') {
                    document.getElementById('editOtherSpecialtyContainer').style.display = 'block';
                } else {
                    document.getElementById('editOtherSpecialtyContainer').style.display = 'none';
                }
            });
        });
    });
</script>