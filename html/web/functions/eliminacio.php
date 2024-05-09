<?php
//Creamos el enlace de conexion a la base de datos 
$enllac = mysqli_connect("localhost","root","alumne","usuaris");

// Comprobamos si la conecion se ha realizado con exito o no
if (!$enllac) {
    echo "Error a la conexi&oacute;: " . mysqli_connect_error();
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Formulari d'eliminació d'un registre</title>
</head>
<body>
    <?php
    // Obtengo el identificador del registro 
    $identificador = $_GET['id'] ;
    // Construyo la consulta de eliminacion
    $consulta_eliminacio = "DELETE FROM dades WHERE id=$identificador";
    // Hago la eliminacion 
    if (!mysqli_query($enllac,$consulta_eliminacio)) {
        ?>
        Error en la eliminacion del registro!!
        <?php
    } else {
        ?>
        Eliminacción realizada!! <a href="../index.php">Tornar al llistat</a>
        <?php
    }
    ?>
</body>
</html>
