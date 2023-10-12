<?php
ob_start(); // para borrar el output buffer https://stackoverflow.com/questions/12654831/php-headers-already-sent-caused-by-session-start
session_start();
//conectamos Con el servidor
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
//recuperar las variables
$nombre=$_POST['nombre'];
$dni=$_POST['dni'];
$telefono=$_POST['telefono'];
$fecha=$_POST['fecha'];
$email=$_POST['email'];
$contrasena=$_POST['contrasena'];

//hacemos la sentencia de sql
$sql="INSERT INTO Usuario (Nombre,DNI,Telefono,Fecha,Email,Contrasena) VALUES('$nombre','$dni','$telefono','$fecha','$email','$contrasena')";
//ejecutamos la sentencia de sql
$ejecutar=mysqli_query($conectar,$sql);
//verificamos la ejecucion
if(isset($nombre,$dni,$telefono,$fecha,$email,$contrasena)){
  if(!$ejecutar){
      ?> 
          <h3 class="bad">¡Ha ocurrido un error,vuelve a introducir los datos!</h3>
            <?php
  }else{
      echo"Datos Guardados Correctamente";
      /*SESION*/
      $_SESSION['Usuario']=$nombre;
      $_SESSION['DNI']=$dni;
      header("Location:areapersonal.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formularios.css">
    <script src="./script.js"></script>
  <title>Formulario de Registro</title>
</head>
<body>
 

  <form action="registroform.php" class="formulario" method="POST" onsubmit="return comprobarCampos();">
    <h4>Formulario de Registro</h4>
    <p>Nombre:</p>
    <input class="caja" type="text" name="nombre" id ='nombre' placeholder="p. ej Ander" required>
   
    <p>DNI:</p>
    <input class="caja"type="text" name="dni" id ='dni' placeholder="p. ej 79087651A" required>

    <p>Telefono:</p>
    <input class="caja" type="text" name ="telefono" id ='telefono' placeholder="p. ej 123456789" required>

    <p>Fecha de nacimiento:</p>
    <input class="caja" type="text" name ="fecha" id ='fecha' placeholder="p. ej 2000-10-10" required>

    <p>Email:</p>
    <input class="caja" type="text" name ="email" id='email' placeholder="p. ej xxxxxxx@gmail.com" required><br>
<p>Contrasena:</p>
    <input class="caja" type="password" name ="contrasena" id='contrasena'required><br>

    <input class="botones"type="submit" value="Registrar usuario" name="registrar">
    <input class="botones"type="reset" value="Borrar datos" name="borrar">
    <input class="botones" type="button" value="Volver página principal" name="volver" onclick="location.href='index.html'">
    <p><a href="iniciosesion.php">Ya tengo Cuenta</a></p>
</form>
</body>
</html>
