<?php include "shared/header.php" ?>

<style>
    .container h1 {
        color: #007bff;
    }
    
    .table-container {
        margin-top: 20px;
    }
    
    .btn-add {
        margin-bottom: 20px;
    }
    
    .modal-header {
        background-color: #007bff;
        color: white;
    }
    
    .table-primary {
        background-color: #007bff;
        color: white;
    }
</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">Administración de Testimonios</h1>

    <?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>' . $_SESSION['success_message'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        unset($_SESSION['success_message']);
    }

    if (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>' . $_SESSION['error_message'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        unset($_SESSION['error_message']);
    }
    ?>

    <div class="table-container">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Testimonio</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conexión a la base de datos
                include "includes/db_config.php";
                $conn = getConnection();

                // Consulta para obtener los testimonios
                $sql = "SELECT * FROM testimonios ORDER BY fecha DESC";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0):
                    while ($row = $result->fetch_assoc()):
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars(substr($row['testimonio'], 0, 100)) . '...'; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['fecha'])); ?></td>
                        <td>
                            <span class="badge <?php echo $row['estado'] == 'activo' ? 'bg-success' : 'bg-danger'; ?>">
                                <?php echo ucfirst($row['estado']); ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-testimonio" 
                                data-id="<?php echo $row['id']; ?>"
                                data-bs-toggle="modal" 
                                data-bs-target="#editTestimonioModal">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-danger btn-sm delete-testimonio" 
                                data-id="<?php echo $row['id']; ?>"
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteTestimonioModal">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </td>
                    </tr>
                <?php 
                    endwhile;
                else:
                ?>
                    <tr>
                        <td colspan="6" class="text-center">No hay testimonios registrados.</td>
                    </tr>
                <?php 
                endif;
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para Editar Testimonio -->
<div class="modal fade" id="editTestimonioModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Testimonio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editTestimonioForm" method="post" action="controllers/update_testimonio.php">
                    <input type="hidden" id="editTestimonioId" name="id">
                    <div class="mb-3">
                        <label for="editNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editNombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTestimonio" class="form-label">Testimonio</label>
                        <textarea class="form-control" id="editTestimonio" name="testimonio" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editEstado" class="form-label">Estado</label>
                        <select class="form-select" id="editEstado" name="estado">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="editTestimonioForm" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Eliminar Testimonio -->
<div class="modal fade" id="deleteTestimonioModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Eliminar Testimonio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de que desea eliminar este testimonio?</p>
                <form id="deleteTestimonioForm" method="post" action="controllers/delete_testimonio.php">
                    <input type="hidden" id="deleteTestimonioId" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="deleteTestimonioForm" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<?php include "shared/footer.php" ?>
