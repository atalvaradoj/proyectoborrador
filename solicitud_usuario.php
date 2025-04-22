<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Cuenta</title>
        <style> body {
            background: rgb(255, 255, 255);
            background: radial-gradient(circle, rgba(255, 255, 255, 1) 0%, rgba(0, 86, 179, 1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            flex-direction: column;
            margin: 0;
        }

        * {
            font-family: 'Arial', sans-serif;
            box-sizing: border-box;
        }

        .container {
            width: 600px;
            padding: 3rem;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: black;
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            color: black;
            font-size: 16px;
            margin-top: 10px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        button {
            width: 100%;
            background-color: #0056b3;
            color: white;
            padding: 10px;
            margin-top: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #003366;
        }

        .solicitud-usuario {
            margin-top: 20px;
            font-size: 14px;
        }

        .solicitud-usuario a {
            color: #0056b3;
            text-decoration: none;
        }

        .solicitud-usuario a:hover {
            color: #003366;
        }</style>
</head>

<body>
    <h2>Solicitud de Creación de Cuenta</h2>
    <form action="procesar_solicitud.php" method="POST">
        <label for="nombre">Nombre Completo:</label>
        <input type="text" name="nombre" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" name="correo" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" required>

        <button type="submit" href="index.php">Enviar Solicitud</button>
    </form>
</body>
</html>



