<?php
// Incluir el archivo de conexión
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_o_correo = $_POST['usuario_o_correo'];
    $contrasena = $_POST['contrasena'];

    // Escapar los caracteres especiales para evitar inyección de SQL
    $usuario_o_correo = $conn->real_escape_string($usuario_o_correo);
    $contrasena = $conn->real_escape_string($contrasena);

    // Consultar la base de datos para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE (nombre='$usuario_o_correo' OR correo_electronico='$usuario_o_correo') AND contrasena='$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Credenciales correctas, redireccionar a la página de datos de sensores
        header("Location: DatosSensores.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="favicon.gif" type="image/gif">
</head>
<body>
    <div class="container">
        <div class="dark-mode-switch" title="Modo Oscuro">
            <img src="ModoOscuro.png" alt="Modo Oscuro" id="dark-mode-toggle">
        </div>
        <h2>Iniciar sesión</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="usuario_o_correo">Usuario o Correo electrónico:</label>
                <input type="text" id="usuario_o_correo" name="usuario_o_correo" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <button type="submit">Iniciar sesión</button>
        </form>
        <p><a href="contrasena.php" class="neon">¿Olvidaste tu contraseña?</a></p>
        <p><a href="registro.php" class="neon">¿No tienes una cuenta? Regístrate aquí</a></p>
    </div>
    <script src="funciones.js"></script>
</body>
</html>
