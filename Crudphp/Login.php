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

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];

// Verificar el inicio de sesión
$sql = "SELECT * FROM usuarios WHERE Nombre = '$nombre' AND Contrasena = '$contrasena'";
$result = $conn->query($sql);

if ($result) {
    // Verificar si hay al menos un resultado
    if ($result->num_rows > 0) {
        // Inicio de sesión exitoso
        $row = $result->fetch_assoc();
        if ($row['IdUser'] == '0001') {
            // Usuario Admin
            header("Location: Principal.php");
        } else {
            // Otros usuarios
            header("Location: PrincipalUser.php");
        }
    } else {
        // Usuario no encontrado
        echo '<script>alert("Usuario no encontrado. Registra un nuevo usuario.");';
        echo 'window.location.href = "index.php";</script>';
    }
} else {
    // Error en la consulta
    echo "Error en la consulta: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
