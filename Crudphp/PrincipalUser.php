<?php
session_start(); // Iniciar sesión

if (isset($_COOKIE['mensaje'])) {
    echo '<script>alert("' . $_COOKIE['mensaje'] . '");</script>';
    setcookie('mensaje', '', time() - 3600, '/'); // Eliminar la cookie después de mostrarla
}
?>

<!-- Resto del código de Principal.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>👻𝗩𝗜𝗩𝗜𝗖𝗔𝗠👻</title>
    <link rel="icon" href="Icon/CarritoIcon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
    .btn-outline-info {
        background-color: whitesmoke;
        color: #008080;
        border-width: 1px;
    }
</style>
<style>
    body {
        background-color: #F5F5DC;
    }
</style>

<body>
    <?php
    require("Config/Conexion.php");
    ?>

    <div class="container-floid">
    <h1 class="bg-black p-2 text-white text-center">⛄🌬️𝓛𝓘𝓢𝓣𝓐𝓓𝓞 𝓓𝓔 𝓟𝓡𝓞𝓓𝓤𝓒𝓣𝓞𝓢🎅🏻☃️<br>(づ｡◕‿‿◕｡)づ</h1>
    </div>
    <br>
    <!--Creación de Buscar-->
    <div class="container">
        <form class="d-flex" method="POST">
            <input class="form-control me-2" style="text-align: center" type="search"
                placeholder="Buscar por Nombre,Código(ID) o Categoria:" name="busqueda">
            <br>
            <button class="btn btn-outline-info " type="submit" name="enviar"><b>𝐁𝐮𝐬𝐜𝐚𝐫</b></button>
        </form>
    </div>

    <br>
    <!--Creación de Tabla-->
    <div class="container">
        <table class="table">
            <thead class="table table-dark">
                <tr>
                    <th scope="col" style="text-align: center">ID</th>
                    <th scope="col" style="text-align: center">CÁTEGORIA</th>
                    <th scope="col" style="text-align: center">MARCA</th>
                    <th scope="col" style="text-align: center">PRECIO</th>
                    <th scope="col" style="text-align: center">DESCRIPCIÓN</th>
                    <th scope="col" style="text-align: center">NOMBRE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificar si se ha enviado un término de búsqueda
                if (isset($_POST['busqueda'])) {
                    $termino_busqueda = $_POST['busqueda'];
                    $sql = $conexion->query("SELECT * FROM productos
                                            INNER JOIN categorias ON productos.CategoriaId = categorias.IdCategoria
                                            INNER JOIN marcas ON productos.MarcaId = marcas.IdMarca
                                            WHERE productos.Nombre LIKE '%$termino_busqueda%'
                                            OR productos.IdProducto LIKE '%$termino_busqueda%'
                                            OR categorias.NombreCategoria LIKE '%$termino_busqueda%'");
                } else {
                    $sql = $conexion->query("SELECT * FROM productos
                                            INNER JOIN categorias ON productos.CategoriaId = categorias.IdCategoria
                                            INNER JOIN marcas ON productos.MarcaId = marcas.IdMarca");
                }

                while ($resultado = $sql->fetch_assoc()) {
                ?>
                    <tr>
                        <th scope="row" style="text-align: center">
                            <?php echo $resultado['IdProducto'] ?>
                        </th>
                        <th scope="row" style="text-align: center">
                            <?php echo $resultado['CategoriaId'] ?> -
                            <?php echo $resultado['NombreCategoria'] ?>
                        </th>
                        <th scope="row" style="text-align: center">
                            <?php echo $resultado['NombreMarca'] ?>
                        </th>
                        <th scope="row" style="text-align: center">$<?php echo $resultado['Precio'] ?></th>
                        <th scope="row" style="text-align: center">
                            <?php echo $resultado['DescripcionProducto'] ?>
                        </th>
                        <th scope="row" style="text-align: center">
                            <?php echo $resultado['Nombre'] ?>                       
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
<blockquote class="blockquote text-center">
    <p class="mb-0">UNIVERSIDAD DEL CAUCA - TECNOLOGIA EN TELEMÁTICA - APLIWEB 2023.</p>
    <footer class="blockquote-footer">CREADO POR: <cite title="Source Title">CAMILO ÁNDRES ORDOÑEZ</cite></footer>
</blockquote>
</html>