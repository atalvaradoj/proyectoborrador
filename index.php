<?php include "shared/header.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inicio de sesion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form action="IniciarSesion.php" method="post">
        <h1>Iniciar sesion</h1>
        <img src="img/UserIcon.png" alt="Logo" class="logo">
        <i class="fa-solid fa-user"></i>
        <label>Usuario</label>
        <input type="text" name="c" placeholder="Nombre de usuario">

        <i class="fa-solid fa-unlock"></i>
        <label>Contraseña</label>
        <input type="password" name="Contraseña" placeholder="Contraseña del usuario">

        <button type="sumit">Iniciar Sesion</button>
        <a href="crearusuario.php">Crear usuario</a>
    </form>

    <!-- Agregar el enlace para recordar contraseña -->
    <div class="remember-password">
        <a href="recuperar_contraseña.php">¿Olvidaste tu contraseña?</a>
        <p>Si olvidó su contraseña, Click aqui para enviarle una nueva contraseña a su dirección de correo electrónico.</p>
    </div>

</body>
</html>