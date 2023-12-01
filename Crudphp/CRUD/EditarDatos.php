<?php

    include_once("../Config/Conexion.php");

    $IdProducto = $_POST['IdProducto']; 
    $Categoria = $_POST['Categorias']; 
    $Marca = $_POST['Marcas']; 
    $Precio = $_POST['Precio']; 
    $Descripcion = $_POST['Descripcion']; 
    $Nombre = $_POST['Nombre']; 



    $sql = "UPDATE productos SET

                CategoriaId='".$Categoria."',    
                MarcaId='".$Marca."',    
                Precio='".$Precio."',    
                DescripcionProducto='".$Descripcion."',    
                Nombre='".$Nombre."' WHERE IdProducto = '".$IdProducto."'";
    
    if ($resultado = $conexion->query($sql)) {
        header("location:../Principal.php");
    }
