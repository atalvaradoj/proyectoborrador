
<?php
session_start();
?>
<?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])): ?>
    <?php
    // Verificar si tiene una foto personalizada
    $fotoPerfil = "img/default-profile.png";
    foreach (['jpg', 'jpeg', 'png'] as $ext) {
        $ruta = "uploads/" . $_SESSION['user_id'] . "." . $ext;
        if (file_exists($ruta)) {
            $fotoPerfil = $ruta;
            break;
        }
    }
    ?>

    <style>
        .usuario-header {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
            background-color: white;
            padding: 8px 14px;
            border-radius: 30px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }

        .usuario-foto {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        .usuario-nombre {
            font-weight: 600;
            color: #333;
            font-size: 1rem;
        }
    </style>

    <div class="usuario-header">
        <img src="<?= $fotoPerfil ?>" class="usuario-foto" alt="Foto de perfil">
        <span class="usuario-nombre"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
    </div>
<?php endif; ?>
