<?php
include("../Config/Conexion.php");

// Verificar si se han seleccionado tanto la categoría como la marca
if (isset($_POST['CategoriaP'], $_POST['MarcaP'])) {
    $categoria = $_POST['CategoriaP'];
    $marca = $_POST['MarcaP'];
    $precio = $_POST['Precio'];
    $descripcion = $_POST['Descripcion'];
    $nombre = $_POST['Nombre'];

    // Verificar si tanto la categoría como la marca tienen valores válidos
    if ($categoria !== '' && $marca !== '') {
        $sql = "INSERT INTO productos(CategoriaId, MarcaId, Precio, DescripcionProducto, Nombre)
                VALUES('$categoria', '$marca', '$precio', '$descripcion', '$nombre')";

        $resultado = mysqli_query($conexion, $sql);

        if ($resultado === TRUE) {
            $mensaje = "𝐏𝐫𝐨𝐝𝐮𝐜𝐭𝐨 𝐈𝐧𝐬𝐞𝐫𝐭𝐚𝐝𝐨 𝐂𝐨𝐫𝐫𝐞𝐜𝐭𝐚𝐦𝐞𝐧𝐭𝐞";
            setcookie("mensaje", $mensaje, time() + 6, "/"); // Cookie válida por 6 segundos
            header("location:../Principal.php");
        } else {
            $mensaje = "𝐄𝐫𝐫𝐨𝐫 𝐚𝐥 𝐈𝐧𝐬𝐞𝐫𝐭𝐚𝐫 𝐞𝐥 𝐏𝐫𝐨𝐝𝐮𝐜𝐭𝐨";
            setcookie("mensaje", $mensaje, time() + 6, "/"); // Cookie válida por 6 segundos
            header("location:../Principal.php");
        }
    } else {
        $mensaje = "𝐏𝐨𝐫 𝐅𝐚𝐯𝐨𝐫, 𝐒𝐞𝐥𝐞𝐜𝐜𝐢𝐨𝐧𝐞 𝐓𝐚𝐧𝐭𝐨 𝐔𝐧𝐚 𝐂𝐚𝐭𝐞𝐠𝐨𝐫í𝐚 𝐂𝐨𝐦𝐨 𝐔𝐧𝐚 𝐌𝐚𝐫𝐜𝐚 𝐕á𝐥𝐢𝐝𝐚𝐬";
        setcookie("mensaje", $mensaje, time() + 6, "/"); // Cookie válida por 6 segundos
        header("location:../Principal.php");
    }
} else {
    $mensaje = "𝗣𝗼𝗿𝗳𝗮𝘃𝗼𝗿 𝗔𝘀𝗲𝗴𝘂𝗿𝗮𝘁𝗲 𝗾𝘂𝗲 𝘀𝗲𝗹𝗲𝗰𝗶𝗼𝗻𝗮𝘀𝘁𝗲 𝘂𝗻𝗮 𝗠𝗮𝗿𝗰𝗮 𝗼 𝘂𝗻𝗮 𝗖𝗮𝘁𝗲𝗴𝗼𝗿𝗶𝗮";
    setcookie("mensaje", $mensaje, time() + 6, "/"); // Cookie válida por 6 segundos
    header("location:../Principal.php");
}
?>
