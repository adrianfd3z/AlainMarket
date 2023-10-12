<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formularios.css">
    <script src="./prueba.js"></script>
  <title>Modificacion de datos</title>
</head>
<body>
  
  <form action="modificarUsuario.php" class="formulario" method="POST" onsubmit="return modificarUsuario();">
    <h4>Modificar datos</h4>
    <h4>Rellena los campos que quieres que se modifiquen</h4>
    <p>Nombre:</p>
    <input class="caja" type="text" name="nombre" id ='nombreMod' placeholder="p. ej Ander">
  
      
    <p>DNI:</p>
    <input class="caja"type="text" name="dni" id ='dniMod' placeholder="p. ej XXXXXXXX-A">
  

    <p>Teléfono:</p>
    <input class="caja" type="text" name ="telefono" id ='telefonoMod' placeholder="p. ej 123456789">


    <p>Fecha de nacimiento:</p>
    <input class="caja" type="text" name ="fecha" id ='fechaMod' placeholder="p. ej 2000-10-10">
  

    <p>Email:</p>
    <input class="caja" type="text" name ="email" id='emailMod' placeholder="p. ej xxxxxxx@gmail.com" ><br>
 
<p>Contrasena:</p>
    <input class="caja" type="password" name ="contrasena" id='contrasenaMod'><br>
  
    <input class="botones"type="submit" value="Modificar datos" name="modificarDatos">
    <input class="botones"type="reset" value="Borrar datos" name="borrar">
    <input class="botones"type="button" value="Volver al area" name="volver.area" onclick="location.href='areapersonal.php'">
</form>
</body>
</html>

<?php
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
$actual=$_SESSION['DNI'];
$actualNombre=$_SESSION['Usuario'];


// si el campo esta vacio, no actualizar los datos.
  
    $nombresql="UPDATE Usuario SET Nombre='$nombre' WHERE DNI='$actual' ";
    $dnisql="UPDATE Usuario SET DNI='$dni' WHERE DNI='$actual' ";
    $telefonosql="UPDATE Usuario SET Telefono='$telefono' WHERE DNI='$actual' ";
    $fechasql="UPDATE Usuario SET Fecha='$fecha' WHERE DNI='$actual' ";
    $emailsql="UPDATE Usuario SET Email='$email' WHERE DNI='$actual' ";
    $contrasenasql="UPDATE Usuario SET Contrasena='$contrasena' WHERE DNI='$actual' ";

//-------------------------------------------------------------------------------
if(!empty($dni)){
    $ejecutar2=mysqli_query($conectar,$dnisql);
    if($ejecutar2){
      $_SESSION['DNI']=$dni;
      $nombresql="UPDATE Usuario SET Nombre='$nombre' WHERE DNI='$dni' ";
      $dnisql="UPDATE Usuario SET DNI='$dni' WHERE DNI='$dni' ";
      $telefonosql="UPDATE Usuario SET Telefono='$telefono' WHERE DNI='$dni' ";
      $fechasql="UPDATE Usuario SET Fecha='$fecha' WHERE DNI='$dni' ";
      $emailsql="UPDATE Usuario SET Email='$email' WHERE DNI='$dni' ";
      $contrasenasql="UPDATE Usuario SET Contrasena='$contrasena' WHERE DNI='$dni' ";
      ?> 
      <h3 class="bien">¡DNI modificado correctamente!</h3>
        <?php
      }
}  
  if(!empty($nombre)){
        $ejecutar1=mysqli_query($conectar,$nombresql);
        if($ejecutar1){
        /*Cerrar sesion*/
          $_SESSION['Usuario']=$nombre;
          ?> 
          <h3 class="bien">¡Nombre modificado correctamente!</h3>
            <?php
    }
}
     if(!empty($telefono)){
      $ejecutar3=mysqli_query($conectar,$telefonosql);
      if($ejecutar3){
        ?> 
        <h3 class="bien">¡Telefono modificado correctamente!</h3>
          <?php
      }
  }
  if(!empty($fecha)){
      $ejecutar4=mysqli_query($conectar,$fechasql);
      if($ejecutar4){
        ?> 
        <h3 class="bien">¡Fecha modificada correctamente!</h3>
          <?php
      }
  }
  if(!empty($email)){
      $ejecutar5=mysqli_query($conectar,$emailsql);
      if($ejecutar5){
        ?> 
              <h3 class="bien">¡Email modificado correctamente!</h3>
                <?php
      }
  }
  if(!empty($contrasena)){
      $ejecutar6=mysqli_query($conectar,$contrasenasql);
      if($ejecutar6){
        ?> 
              <h3 class="bien">¡Contraseña modificada correctamente!</h3>
                <?php
      }
  }
?>
