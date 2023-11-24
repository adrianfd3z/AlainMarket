<?php
header('X-Frame-Options:SAMEORIGIN'); //click-jacking prevention
header('X-Content-Type-Options: nosniff');
//header("Content-Security-Policy: default-src 'self'");
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
    <script src="./mod.js"></script>
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
include 'logear.php';
$conectar=@mysqli_connect("db","lK9pF81rtVq1","o80dGpAMjKb2","database");
//verificamos la conexion
if(!$conectar){
    echo"No Se Pudo Conectar Con El Servidor";
    logear_error("No se ha podido conectar con el servidor");
    
}else{
    $base=mysqli_select_db($conectar,"database");
        if(!$base){
            logear_error("No se ha encontrado la base de datos,comprueba que esta bien importada");
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

//-------------------------------------------------------------------------------

if(!isset($_SESSION['Usuario']) || !isset($_SESSION['DNI'])){
  header("location:iniciosesion.php");
}else{
  if(!empty($dni)){
    if($dnisql=$conectar->prepare("UPDATE Usuario SET DNI=? WHERE DNI=?")){
      $dnisql->bind_param('ss',htmlspecialchars(mysqli_real_escape_string($conectar,$dni)),htmlspecialchars(mysqli_real_escape_string($conectar,$actual)));
      $dnisql->execute();
      $dnisqlejec=$dnisql->get_result();
      $dnisql->close();
        $_SESSION['DNI']=$dni;
        $actual=$dni;
        /*if($nombresql=$conectar->prepare("UPDATE Usuario SET Nombre=? WHERE DNI=?")){
          $nombresql->bind_param('ss',$nombre,$dni);
        }
        if($telefonosql=$conectar->prepare("UPDATE Usuario SET Telefono=? WHERE DNI=? ")){
          $telefonosql->bind_param('is',$telefono,$dni);
        }
        if($fechasql=$conectar->prepare("UPDATE Usuario SET Fecha=? WHERE DNI=?")){
          $fechasql->bind_param('ss',$fecha,$dni);
        }
        if($emailsql=$conectar->prepare("UPDATE Usuario SET Email=? WHERE DNI=? ")){
          $emailsql->bind_param('ss',$email,$dni);
        }
        if($contrasenasql=$conectar->prepare("UPDATE Usuario SET Contrasena=? WHERE DNI=? ")){
          $contrasenasql->bind_param('ss',$contrasena,$dni);
        }*/
            
        ?> 
        <h3 class="bien">¡DNI modificado correctamente!</h3>
          <?php
        }
    }
    if(!empty($nombre)){
      $nombresql=$conectar->prepare("UPDATE Usuario SET Nombre=? WHERE DNI=?");
      $nombresql->bind_param('ss',htmlspecialchars(mysqli_real_escape_string($conectar,$nombre)),htmlspecialchars(mysqli_real_escape_string($conectar,$actual)));
      $nombresql->execute();
      $ejecutar1=$nombresql->get_result();
          /*Cerrar sesion*/
            $_SESSION['Usuario']=$nombre;
            ?> 
            <h3 class="bien">¡Nombre modificado correctamente!</h3>
              <?php
      
  }
      if(!empty($telefono)){
        $telefonosql=$conectar->prepare("UPDATE Usuario SET Telefono=? WHERE DNI=? ");
        $telefonosql->bind_param('is',htmlspecialchars(mysqli_real_escape_string($conectar,$telefono)),htmlspecialchars(mysqli_real_escape_string($conectar,$actual)));
        $telefonosql->execute();
        $ejecutar3=$telefonosql->get_result();
        if(!$ejecutar3){
          ?> 
          <h3 class="bien">¡Telefono modificado correctamente!</h3>
            <?php
        }
    }
      if(!empty($fecha)){
        $fechasql=$conectar->prepare("UPDATE Usuario SET Fecha=? WHERE DNI=?");
        $fechasql->bind_param('ss',htmlspecialchars(mysqli_real_escape_string($conectar,$fecha)),htmlspecialchars(mysqli_real_escape_string($conectar,$actual)));
        $fechasql->execute();
        $ejecutar4=$fechasql->get_result();
        if(!$ejecutar4){
          ?> 
          <h3 class="bien">¡Fecha modificada correctamente!</h3>
            <?php
        }
    }
    if(!empty($email)){
      $emailsql=$conectar->prepare("UPDATE Usuario SET Email=? WHERE DNI=? ");
        $emailsql->bind_param('ss',htmlspecialchars(mysqli_real_escape_string($conectar,$email)),htmlspecialchars(mysqli_real_escape_string($conectar,$actual)));
        $emailsql->execute();
        $ejecutar5=$emailsql->get_result();
        if(!$ejecutar5){
          ?> 
                <h3 class="bien">¡Email modificado correctamente!</h3>
                  <?php
        }
    }
    if(!empty($contrasena)){
        $contrasenasql=$conectar->prepare("UPDATE Usuario SET Contrasena=? WHERE DNI=? ");
        $contrasenasql->bind_param('ss',password_hash($contrasena,PASSWORD_DEFAULT."\n"),$actual);
        $contrasenasql->execute();
        $ejecutar6=$contrasenasql->get_result();
        if(!$ejecutar6){
          ?> 
                <h3 class="bien">¡Contraseña modificada correctamente!</h3>
                  <?php
        }
    }
}  
?>
