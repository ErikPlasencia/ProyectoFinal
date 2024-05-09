<?php
//Creamos el enlace de conexion a la base de datos 
$enllac = mysqli_connect("localhost","root","alumne","usuaris");

// Comprobamos si la conexión se ha realizado con éxito o no
if (!$enllac) {
    echo "Error a la conexión: " . mysqli_connect_error();
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Formulario de actualización de un registro</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php
    // Obtengo el identificador del registro 
    $identificador = $_GET['id'];
    // Hago una consulta SQL a la base de datos para obtener los datos de registro 
    $resultat = mysqli_query($enllac, "SELECT * FROM dades WHERE id=$identificador");
    // Obtengo registros 
    $registre = mysqli_fetch_array($resultat);
    // Cargo el formulario 
    ?>
    <form method="post" action="actualitzacio.php?id=<?php echo $identificador ?>">
    <table border="1">
        <tr><td colspan="2">Formulario de actualización</td></tr>
        <tr>
            <td>Nom</td><td><input type="text" name="nom" value="<?php echo $registre['nom']; ?>" /> </td>
        </tr>
        <tr>
            <td>Primer cognom</td><td><input type="text" name="cognom1" value="<?php echo $registre['cognom1']; ?>" /> </td>
        </tr>
        <tr>
            <td>Segon cognom</td><td><input type="text" name="cognom2" value="<?php echo $registre['cognom2']; ?>" /> </td>
        </tr>
        <tr>
            <td>Adreça</td><td><textarea name="adreca"><?php echo $registre['adreca']; ?> </textarea></td>
        </tr>
        <tr>
            <td>Codi postal</td><td><input type="text" name="cp" value="<?php echo $registre['cp']; ?>" /> </td>
        </tr>
        <tr>
            <td>Ciutat</td><td><input type="text" name="ciutat" value="<?php echo $registre['ciutat']; ?>" /> </td>
        </tr>
        <tr>
            <td>Pais</td><td><input type="text" name="pais" value="<?php echo $registre['pais']; ?>" /> </td>
        </tr>
        <tr>
            <td>Telèfon</td><td><input type="text" name="telefon" value="<?php echo $registre['telefon']; ?>" /> </td>
        </tr>
        <tr>
            <td>Data de naixement</td><td><input type="text" name="datanaixement" value="<?php echo $registre['datanaixement']; ?>" /> </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Enviar" /></td>
        </tr>
    </table>
    </form>
    <a href="../index.php">Volver al índice</a>
</body>
</html>
