<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>👻𝗩𝗜𝗩𝗜𝗖𝗔𝗠👻</title>
    <link rel="icon" href="../Icon/CarritoIcon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
    body {
        background-color: #F5F5DC;
    }
</style>
<body>
    
    <h1 class="bg-black p-2 text-white text-center">🎁 ❄️𝓐𝓖𝓡𝓔𝓖𝓐𝓡 𝓟𝓡𝓞𝓓𝓤𝓒𝓣𝓞❄️❄️</h1>
    <br>
    <div class="container">
        <form action="../CRUD/InsertarDatos.php" method="POST">
            <label for="">Categorias</label>
            <select class="form-select mb-3" name="CategoriaP">
                <option selected disabled>--Seleccionar Categoria--</option>
                <?php
                include("../Config/Conexion.php");
                $sql = $conexion->query("SELECT * FROM categorias");
                while ($resultado = $sql->fetch_assoc()) {
                    echo "<option value='" .$resultado['IdCategoria']. "'>" .$resultado['NombreCategoria']. "</option>";
                }
                ?>
            </select>
            <label for="">Marcas</label>
            <select class="form-select mb-3" name="MarcaP">
                <option selected disabled>--Seleccionar Marca--</option>
                <?php
                include("../Config/Conexion.php");
                $sql = $conexion->query("SELECT * FROM marcas");
                while ($resultado = $sql->fetch_assoc()) {
                    echo "<option value='" .$resultado['IdMarca']. "'>" .$resultado['NombreMarca']. "</option>";
                }
                ?>
            </select>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="text" class="form-control" name="Precio">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input type="text"  class="form-control" name="Descripcion">
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="Nombre">
            </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn  btn-outline-danger">𝐄𝐧𝐯𝐢𝐚𝐫</button>
        <a href="../Principal.php" class="btn btn-outline-dark">𝐑𝐞𝐠𝐫𝐞𝐬𝐚𝐫 </a>
    </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
<blockquote class="blockquote text-center">
    <p class="mb-0">UNIVERSIDAD DEL CAUCA - TECNOLOGIA EN TELEMÁTICA - APLIWEB 2023.</p><
    <footer class="blockquote-footer">CREADO POR: <cite title="Source Title">CAMILO ÁNDRES ORDOÑEZ</cite></footer>
</blockquote>
</html>
