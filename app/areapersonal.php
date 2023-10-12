<?php
ob_start();
session_start();
$conectar=@mysqli_connect("db","admin","test","database");
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
$datosusuario="SELECT * FROM Usuario WHERE(DNI='$dni')";
$lista=mysqli_query($conectar,$datosusuario);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formularios.css">
  <title>Area Personal</title>
</head>
<body>
<form action="registrar.php" class="formulario" method="POST">
  <h2> ¡Bienvenido <?php echo $_SESSION['Usuario']?> !</h2>
  <h2> ¿Qué deseas hacer? </h2>
  <input class="botones" type="button" value="Modificar datos" name="modificar" onclick="location.href='modificarUsuario.php'">
  <input class="botones" type="button" value="Volver página principal" name="volver" onclick="location.href='index.html'">
</form>
<div class="lista">
        <h2>Tus datos</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>FechaNacimiento</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_array($lista)): ?>
                    <tr>
                        <th><?= $fila['Nombre'] ?></th>
                        <th><?= $fila['DNI'] ?></th>
                        <th><?= $fila['Telefono'] ?></th>
                        <th><?= $fila['Fecha'] ?></th>
                        <th><?= $fila['Email'] ?></th>
                        <th><?= $fila['Contrasena'] ?></th>
                        </tr>
                <?php endwhile; ?>
            </tbody>
        </table>    
                </div>   
</body>
</html>
