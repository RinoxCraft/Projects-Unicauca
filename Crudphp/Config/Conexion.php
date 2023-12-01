<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "unitienda";

    $conexion = new mysqli($host, $user, $pass, $db);

    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }
// Verificar si se ha enviado un término de búsqueda
if(isset($_POST['busqueda'])) {
    $termino_busqueda = $_POST['busqueda'];
    $sql = $conexion->query("SELECT productos.IdProducto, productos.Nombre AS NombreProducto, productos.IdProducto, productos.Precio, productos.DescripcionProducto,
                                    categorias.NombreCategoria, marcas.NombreMarca AS NombreMarca
                             FROM productos
                             INNER JOIN categorias ON productos.CategoriaId = categorias.IdCategoria
                             INNER JOIN marcas ON productos.MarcaId = marcas.IdMarca
                             WHERE productos.Nombre LIKE '%$termino_busqueda%'
                             OR productos.IdProducto LIKE '%$termino_busqueda%'
                             OR categorias.NombreCategoria LIKE '%$termino_busqueda%'");
} else {
    $sql = $conexion->query("SELECT productos.IdProducto, productos.Nombre AS NombreProducto, productos.IdProducto, productos.Precio, productos.DescripcionProducto,
                                    categorias.NombreCategoria, marcas.NombreMarca AS NombreMarca
                             FROM productos
                             INNER JOIN categorias ON productos.CategoriaId = categorias.IdCategoria
                             INNER JOIN marcas ON productos.MarcaId = marcas.IdMarca");
}

?>

