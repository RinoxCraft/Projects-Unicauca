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
    <h1 class="bg-black p-2 text-white text-center">❆ ☃𝓔𝓓𝓘𝓣𝓞𝓡 𝓓𝓔 𝓟𝓡𝓞𝓓𝓤𝓒𝓣𝓞𝓢 🌟 🎄</h1>
    <br>
    <form class="container" action="../CRUD/EditarDatos.php" method="POST">
        <?php
            include_once('../Config/Conexion.php');

            $sql = "SELECT * FROM productos WHERE IdProducto = ".$_REQUEST['IdProducto'];
            $resultado = $conexion->query($sql);

            $row = $resultado->fetch_assoc();      
        ?>

        <input type="Hidden" class="form-control" name="IdProducto" value="<?php echo $row['IdProducto'];?>">

        <!--Traemos los Datos Categoria-->

        <label>Categorias</label>
        <select class="form-select mb-3" aria-label="Default select example" name="Categorias">
            <option selected disabled>---Seleccione Categorias---</option>

            <?php
                include ("../Config/Conexion.php");

                $sql1 = "SELECT * FROM categorias WHERE IdCategoria=".$row['CategoriaId'];
                $resultado1 = $conexion -> query($sql1);
                
                $row1 = $resultado1->fetch_assoc();
                
                # Proyecta solo la Categoria que pertenece el producto

                echo "<option selected value='".$row1['IdCategoria']."'>".$row1['NombreCategoria']."</option>";
                
                $sql2 = "SELECT * FROM categorias";
                $resultado2 = $conexion->query($sql2);

                # se proyectan las otras categorias apartes de la normal (para cambiar estado de Categoria)

                while ($Fila = $resultado2->fetch_array()) {
                    echo "<option value='".$Fila['IdCategoria']."'>".$Fila['NombreCategoria']."</option>";
                }
            ?>    

        </select>
        <label>Marcas</label>
        <select class="form-select mb-3" aria-label="Default select example" name="Marcas">
            <option selected disabled>---Seleccione Marcas---</option>
            <?php
                include ("../Config/Conexion.php");

                $sql3 = "SELECT * FROM marcas WHERE IdMarca=".$row['MarcaId'];
                $resultado3 = $conexion -> query($sql3);
                
                $row3 = $resultado3->fetch_assoc();
                
                # Proyecta solo la Marcas que pertenece el producto

                echo "<option selected value='".$row3['IdMarca']."'>".$row3['NombreMarca']."</option>";
                
                $sql4 = "SELECT * FROM Marcas";
                $resultado4 = $conexion -> query($sql4);

                # se proyectan las otras Marcas apartes de la normal (para cambiar estado de Marca)

                while ($Fila = $resultado4->fetch_array()) {
                    echo "<option value='".$Fila['IdMarca']."'>".$Fila['NombreMarca']."</option>";
                }
            ?>

        </select>
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="text" class="form-control" name="Precio" value="<?php echo $row['Precio']; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Descripcion</label>
            <input type="text" class="form-control" name="Descripcion" value="<?php echo $row['DescripcionProducto']; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="Nombre" value="<?php echo $row['Nombre']; ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn btn-outline-danger">𝐌𝐨𝐝𝐢𝐟𝐢𝐜𝐚𝐫/𝐑𝐞𝐞𝐬𝐜𝐫𝐢𝐛𝐢𝐫</button>
            <a href="../Principal.php" class="btn btn btn-outline-dark">𝐑𝐞𝐠𝐫𝐞𝐬𝐚𝐫/𝐂𝐚𝐧𝐜𝐞𝐥𝐚𝐫</a>
        </div>
    </form>
<blockquote class="blockquote text-center">
    <p class="mb-0">UNIVERSIDAD DEL CAUCA - TECNOLOGIA EN TELEMÁTICA - APLIWEB 2023.</p>
    <footer class="blockquote-footer">CREADO POR: <cite title="Source Title">CAMILO ÁNDRES ORDOÑEZ</cite></footer>
</blockquote>
</body>
