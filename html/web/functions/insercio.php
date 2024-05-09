<?php
//Creamos el enlace de conexion a la base de datos 
$enllac = mysqli_connect("localhost","root","alumne","usuaris");

// Comprobamos si la conexión se ha realizado con éxito o no
if (!$enllac) {
    echo "Error a la conexi&oacute;: " . mysqli_connect_error();
    exit;
}

// Construimos la consulta SQL de insercion a la base de datos 
$nom = $_POST['nom'];
$cognom1 = $_POST['cognom1'];
$cognom2 = $_POST['cognom2'];
$adreca = $_POST['adreca'];
$cp = $_POST['cp'];
$ciutat = $_POST['ciutat'];
$pais = $_POST['pais'];
$telefon = $_POST['telefon'];
$data = $_POST['data'];

$insercio_sql = "INSERT INTO dades VALUES (NULL, '$nom', '$cognom1', '$cognom2', '$adreca', '$cp', '$ciutat', '$pais', '$telefon', '$data')";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Resultat inserció de dades</title>
</head>
<body>
    <?php
    // Hacemos una consulta SQL en la base de datos 
    $resultat = mysqli_query($enllac, $insercio_sql);
    if (!$resultat) {
        echo "Insercion de datos Incorrectamente realizada";
    } else {
        echo "Insercion de datos Correctamente realizada";
    }
    // Agrega esto después de la obtención de las variables POST
    var_dump($_POST);

    // Agrega esto después de la ejecución de la consulta SQL
    if (!$resultat) {
    echo "Error en la consulta SQL: " . mysqli_error($enllac);
    } else {
    echo "Consulta SQL ejecutada correctamente";
    }

    ?>
    
    <!-- Enlace para volver a index.php -->
    <a href="../index.php">Volver a la página principal</a>
</body>
</html>
