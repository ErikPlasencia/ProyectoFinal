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
    <title>Formulari d'actualització d'un registre</title>
    
</head>
<body>
    <?php
    // Obtengo el identificador del registro 
    $identificador = $_GET['id'] ;
    // Construyo la consulta de actualizacion 
    $consulta_actualitzacio = "UPDATE dades SET nom = '" . $_POST['nom'] . "',
                                                cognom1 = '" . $_POST['cognom1'] . "',
                                                cognom2 = '" . $_POST['cognom2'] . "',
                                                adreca = '" . $_POST['adreca'] . "',
                                                cp = '" . $_POST['cp'] . "',
                                                ciutat = '" . $_POST['ciutat'] . "',
                                                pais = '" . $_POST['pais'] . "',
                                                telefon = '" . $_POST['telefon'] . "',
                                                datanaixement = '" . $_POST['datanaixement'] . "',
                                                WHERE id = $identificador";
    // Hago la actualizacion 
    if (!mysqli_query($enllac,$consulta_actualitzacio)) {
        ?>
        Error en la actualizacion!!!
        <?php
    } else {
        ?>
        Actuaizacion Realizada!! <a href="llistat.php">Tornar al llistat </a>
        <?php
    }
    ?>
</body>
</html>