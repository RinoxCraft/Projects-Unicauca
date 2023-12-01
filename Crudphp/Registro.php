<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unitienda";

// Intentar establecer la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay errores de conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario de registro
$nombre_registro = $_POST['nombre_registro'];
$contrasena_registro = $_POST['contrasena_registro'];

// Verificar si el usuario ya existe
$sql_verificar_usuario = "SELECT * FROM usuarios WHERE Nombre = '$nombre_registro'";
$result_verificar_usuario = $conn->query($sql_verificar_usuario);

if ($result_verificar_usuario->num_rows > 0) {
    // Usuario ya existe
    echo '<script>alert("El usuario ya existe. Por favor, elige otro nombre.");';
    echo 'window.location.href = "index.php";</script>';
} else {
    // Insertar nuevo usuario
    $sql_insertar_usuario = "INSERT INTO usuarios (Nombre, Contrasena) VALUES ('$nombre_registro', '$contrasena_registro')";
    if ($conn->query($sql_insertar_usuario) === TRUE) {
        echo '<script>alert("Usuario registrado exitosamente.");';
        echo 'window.location.href = "index.php";</script>';
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
