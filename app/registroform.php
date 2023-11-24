<?php
header('X-Frame-Options:SAMEORIGIN'); //click-jacking prevention
header('X-Content-Type-Options: nosniff');
//header("Content-Security-Policy: default-src 'self'");

ob_start();
session_start();
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
$contrasena=password_hash($_POST['contrasena'],PASSWORD_DEFAULT."\n");

$ip = $_SERVER['REMOTE_ADDR'];
$captcha=$_POST['g-recaptcha-response'];
$secretkey="6LfG2RMpAAAAAKGF1f8iZyQwn-Fhy-pF-schT8Pd";
$response= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&$remoteip=$ip");
$atributos=json_decode($response,TRUE);

header("Content-Security-Policy: connect-src *.google.com");


if(isset($nombre,$dni,$telefono,$fecha,$email,$contrasena)){
  if(!$atributos['success']){
    echo '<script language="javascript">alert("Debes verificar la casilla del Captcha");</script>';
  }else{
    if($sql=$conectar->prepare("INSERT INTO Usuario (Nombre,DNI,Telefono,Fecha,Email,Contrasena) VALUES(?,?,?,?,?,?)")){
      $sql->bind_param('ssisss',htmlspecialchars(mysqli_real_escape_string($conectar,$nombre)),htmlspecialchars(mysqli_real_escape_string($conectar,$dni)),htmlspecialchars(mysqli_real_escape_string($conectar,$telefono)),htmlspecialchars(mysqli_real_escape_string($conectar,$fecha)),htmlspecialchars(mysqli_real_escape_string($conectar,$email)),htmlspecialchars(mysqli_real_escape_string($conectar,$contrasena)));
      $sql->execute();
      $insertar=$sql->get_result();
      $sql->close();
    }
      $conectar->close();
      if($insertar){
        logear_error("¡Ha ocurrido un error,vuelve a introducir los datos! Error al registrarse.DNI:  ".$dni);
        ?> 
            <h3 class="bad">¡Ha ocurrido un error,vuelve a introducir los datos!</h3>
            
            <?php
    }
        //echo"Datos Guardados Correctamente";
        /*SESION*/
        logear_error("Se ha registrado el usuario con DNI"  .$dni);
        $_SESSION['Usuario']=$nombre;
        $_SESSION['DNI']=$dni;
        //logear_error("El usuario con DNI: ".$dni +"se ha registrado correctamente.")
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="./registro.js"></script>
  <title>Formulario de Registro</title>
</head>
<body>
 

  <form action="registroform.php" class="formulario" method="POST" onsubmit="return comprobarCamposRegistro();">
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

    <h4>Longitud 8 y 16 caracteres, al menos un dígito, al menos una minúscula ,al menos una mayúscula y puede contener simbolos</h4>
    <div class = "mb-3">
      <div class="g-recaptcha" data-sitekey="6LfG2RMpAAAAALb7mJUwVFewQVHcPbLQ8W6ANbpQ"></div>
  </div>
    <input class="botones"type="submit" value="Registrar usuario" name="registrar">
    <input class="botones"type="reset" value="Borrar datos" name="borrar">
    <input class="botones" type="button" value="Volver página principal" name="volver" onclick="location.href='index.php'">
    <p><a href="iniciosesion.php">Ya tengo Cuenta</a></p>
</form>
</body>
</html>
