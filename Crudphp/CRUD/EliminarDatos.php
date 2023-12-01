<?php
    include ("../Config/Conexion.php");

    $Id = $_GET['IdProducto'];
    $sql = "DELETE FROM productos WHERE IdProducto ='$Id'";

    $query = mysqli_query($conexion,$sql);
    if ($query === TRUE) {
        header("Location: ../Principal.php");
    }

?>
