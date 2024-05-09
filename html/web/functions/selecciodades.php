<?php
//Creamos el enlace de conexion a la base de datos 
$enllac = mysqli_connect("localhost","erik","alumne","usuaris");

// Comprobamos si la conecion se ha realizado con exito o no
if (!$enllac) {
    echo "Error a la conexi&oacute;: " . mysqli_connect_error();
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Resultat selecció de dades</title>
</head>
<body>
    <table border="1">
        <tr><td>Id</td><td>Nom</td><td>Cognom1</td><td>Cognom2</td></tr>
        <?php
        // Hago una consulta SQL en la base de datos 
        $resultat = mysqli_query($enllac, "SELECT * FROM dades") ;
        while ( $registre = mysqli_fetch_array($resultat) ) {
            echo "<tr>" ;
            echo "<td>" . $registre['id'] . "</td>";
            echo "<td>" . $registre['nom'] . "</td>";
            echo "<td>" . $registre['cognom1'] . "</td>";
            echo "<td>" . $registre['cognom2'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>