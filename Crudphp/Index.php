<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>👻𝗩𝗜𝗩𝗜𝗖𝗔𝗠👻</title>
    <link rel="icon" href="Icon/CarritoIcon.ico" type="image/x-icon">
    <!-- Agregado Bootstrap para los estilos de botones -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #F5F5DC;
            margin: 20px;
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        /* Estilos adicionales para los botones */
        .btn {
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3; /* Color más oscuro al pasar el ratón */
        }

        .btn i {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <h2>𝙻𝙾𝙶𝙸𝙽</h2>
    <form action="login.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>
        <br>
        <!-- Se ha utilizado Bootstrap para estilizar el botón -->
        <button type="submit" class="btn btn-outline-info btn-block">
            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
        </button>
    </form>
    <br>
    <h2>𝚁𝙴𝙶𝙸𝚂𝚃𝚁𝙰𝚁 𝙽𝚄𝙴𝚅𝙾 𝚄𝚂𝚄𝙰𝚁𝙸𝙾</h2>
    <form action="registro.php" method="post">
        <label for="nombre_registro">Nombre:</label>
        <input type="text" name="nombre_registro" required>
        <br>
        <label for="contrasena_registro">Contraseña:</label>
        <input type="password" name="contrasena_registro" required>
        <br>
        <!-- Se ha utilizado Bootstrap para estilizar el botón -->
        <button type="submit" class="btn btn-outline-info btn-block">
            <i class="fas fa-user-plus"></i> Registrar Usuario
        </button>
    </form>
    <!-- Scripts de Bootstrap y Font Awesome (para los iconos) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/f12c25246c.js" crossorigin="anonymous"></script>
</body>
<blockquote class="blockquote text-center">
  <p class="mb-0">UNIVERSIDAD DEL CAUCA - TECNOLOGIA EN TELEMÁTICA - APLIWEB 2023.</p>
  <footer class="blockquote-footer">CREADO POR: <cite title="Source Title">CAMILO ÁNDRES ORDOÑEZ</cite></footer>
</blockquote>
</html>
