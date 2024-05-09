<?php
//Creamos el enlace de conexion a la base de datos 
$enllac = mysqli_connect("localhost", "root", "alumne", "usuaris");

// Comprobamos si la conexión se ha realizado con éxito o no
if (!$enllac) {
    echo "Error a la conexión: " . mysqli_connect_error();
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Llistat de registres amb actualització</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div>
        <h1>Bienvenido a mi Formulario</h1>
        <p>¡Aquí puedes encontrar nuestra tabla de registros y acceder al formulario de inserción!</p>
        <ul>
            <li><a href="functions/formulari.php">Formulario de inserción</a></li>
        </ul>
    </div>
    <table border="1">
        <tr><td>Id</td><td>Nom</td><td>Cognom1</td><td>Cognom2</td><td>Acción</td></tr>
        <?php
        // Hacemos una consulta SQL a la base de datos 
        $resultat = mysqli_query($enllac, "SELECT * FROM dades");
        while ($registre = mysqli_fetch_array($resultat)) {
            echo "<tr>";
            echo "<td>" . $registre['id'] . "</td>";
            echo "<td>" . $registre['nom'] . "</td>";
            echo "<td>" . $registre['cognom1'] . "</td>";
            echo "<td>" . $registre['cognom2'] . "</td>";
            // Construimos los enlaces 
            $linkactualitzacio = "functions/formulariactualitzacio.php?id=" . $registre['id'];
            $linkeliminacio = "functions/eliminacio.php?id=" . $registre['id'];
            echo "<td><a href=\"$linkactualitzacio\">Actualizar</a> / <a href=\"$linkeliminacio\">Eliminar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
