<?php //https://www.youtube.com/watch?v=sYaEoNy5OGs
header('X-Frame-Options:SAMEORIGIN'); //click-jacking prevention
header('X-Content-Type-Options: nosniff');
//header("Content-Security-Policy: default-src 'self'");
ob_start();
session_start();
//conectamos Con el servidor
$conectar=@mysqli_connect("db","lK9pF81rtVq1","o80dGpAMjKb2","database");
//verificamos la conexion
if(!$conectar){
    echo"No Se Pudo Conectar Con El Servidor";
}else{
    $base=mysqli_select_db($conectar,"database");
        if(!$base){
            echo"No Se Encontro La Base De Datos";
        }
}
/*$sesionactual=$_SESSION['Usuario'];
$dniactual="SELECT DNI from Usuario where Nombre='$sesionactual'";

$sql=mysqli_query($conectar,$dniactual);
$dni=mysqli_fetch_array($sql)[0];
*/
$dni=$_SESSION['DNI'];
$listamoviles="SELECT * FROM Movil";
$lista=mysqli_query($conectar,$listaperros);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="listas.css">
    <title>Lista de Moviles Registrados</title>
</head>
<body>
    <div class="listamoviles">
        <h2>Moviles registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Gama</th>
                    <th>SistemaOperativo</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_array($lista)): ?>
                    <tr>
                        <th><?=$fila['Modelo'] ?></th>
                        <th><?=$fila['Marca'] ?></th>
                        <th><?=$fila['Precio'] ?></th>
                        <th><?=$fila['Gama'] ?></th>
                        <th><?=$fila['SistemaOperativo'] ?></th>
                    </tr>
                <?php endwhile; ?>
            </tbody>
           
        </table>
        
    </div>
    <p><a href="iniciosesion.php">Si eres el propietario de uno de estos moviles y deseas modificar sus datos o eliminarlo de la base de datos, pulsa aquí</a></p>
    <input class="botones" type="button" value="Volver pagina principal" name="volver" onclick="location.href='index.php'">
</body>


</html>
