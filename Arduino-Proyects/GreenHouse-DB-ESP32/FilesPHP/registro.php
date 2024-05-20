<?php
// Incluir el archivo de conexión
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo_electronico = $_POST['correo_electronico'];
    $contrasena = $_POST['contrasena'];

    // Escapar los caracteres especiales para evitar inyección de SQL
    $nombre = $conn->real_escape_string($nombre);
    $correo_electronico = $conn->real_escape_string($correo_electronico);
    $contrasena = $conn->real_escape_string($contrasena);

    // Verificar si el usuario o el correo ya existen
    $sql = "SELECT * FROM usuarios WHERE nombre='$nombre' OR correo_electronico='$correo_electronico'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario o correo ya existen
        $error_message = 'El nombre de usuario o el correo electrónico ya están en uso.';
    } else {
        // Insertar el nuevo usuario en la base de datos con tipo_usuario 'normal'
        $tipo_usuario = 'normal';
        $sql = "INSERT INTO usuarios (nombre, correo_electronico, contrasena, tipo_usuario) VALUES ('$nombre', '$correo_electronico', '$contrasena', '$tipo_usuario')";
        if ($conn->query($sql) === TRUE) {
            // Registro exitoso, redireccionar a la página de inicio de sesión
            header("Location: login.php");
            exit;
        } else {
            // Error al insertar el nuevo usuario
            $error_message = 'Error al registrar el usuario. Inténtalo de nuevo.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="favicon.gif" type="image/gif">
</head>
<body>
    <div class="container">
        <div class="dark-mode-switch" title="Modo Oscuro">
            <img src="ModoOscuro.png" alt="Modo Oscuro" id="dark-mode-toggle">
        </div>
        <h2>Registrarse</h2>
        <form action="registro.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre de usuario:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="correo_electronico">Correo electrónico:</label>
                <input type="email" id="correo_electronico" name="correo_electronico" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <button type="submit">Registrarse</button>
        </form>
        <p><a href="login.php" class="neon">¿Ya tienes una cuenta? Inicia sesión aquí</a></p>
        <?php if (isset($error_message) && $error_message != ''): ?>
            <div id="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </div>
    <script src="funciones.js"></script>
</body>
</html>
