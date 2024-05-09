<!DOCTYPE html>
<html lang="es">
<head>
    <title> Inserció de dades  </title>
    <link rel="stylesheet"  href="../css/estilos.css">
</head>
<body>
    <form method="post" action="insercio.php">
    <table border="1">
    <tr><td colspan="2"> Formulari d'insercio de dades </td></tr>
    <tr>
        <td>Nom</td><td><input type="text" name="nom" /></td>
    </tr>
    <tr>
        <td>Primer Cognom</td><td><input type="text" name="cognom1" /></td>
    </tr>
    <tr>
        <td>Segon Cognom</td><td><input type="text" name="cognom2" /></td>
    </tr>
    <tr>
        <td>Adreça</td><td><textarea name="adreca"></textarea></td>
    </tr>
    <tr>
        <td>Codi Postal</td><td><input type="text" name="cp" /></td>
    </tr>
    <tr>
        <td>Ciutat</td><td><input type="text" name="ciutat" /></td>
    </tr>
    <tr>
        <td>Pais</td><td><input type="text" name="pais" /></td>
    </tr>
    <tr>
        <td>Telèfon</td><td><input type="text" name="telefon" /></td>
    </tr>
    <tr>
        <td>Data de naixement</td><td><input type="text" name="data" /></td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" value="Enviar" /></td>
    </tr>
    </table>
    </form>
</body>
</html>