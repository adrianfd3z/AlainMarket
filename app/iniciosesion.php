<?php
header('X-Frame-Options:SAMEORIGIN'); //click-jacking prevention
header('X-Content-Type-Options: nosniff');
//header("Content-Security-Policy: default-src 'self'");
ob_start();
session_start();
$_SESSION["token"] = bin2hex(random_bytes(32));
$_SESSION["token-expire"] = time() + 3600; //3600s

include 'logear.php';
$conectar = @mysqli_connect("db", "DgfG5eVE1pEb8B", "yKbfwxEjRNByKz", "database");
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
//----------------------------------------------------------------------------------------------------------------------------------------
//recuperar las variables 
$nombre=$_POST['nombre'];
$dni=$_POST['dni'];
$contrasena=$_POST['contrasena'];

$ip = $_SERVER['REMOTE_ADDR'];
$captcha=$_POST['g-recaptcha-response'];
$secretkey="6LfG2RMpAAAAAKGF1f8iZyQwn-Fhy-pF-schT8Pd";
$response= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&$remoteip=$ip");
$atributos=json_decode($response,TRUE);
if(isset($dni) && isset($contrasena)){ 
if(!$atributos['success']){
echo '<script language="javascript">alert("Debes verificar la casilla del Captcha");</script>';
}else{
//----------------------------------------------------------------------------------------
    if($contrasenaUsuario = $conectar->prepare("SELECT Contrasena FROM Usuario WHERE DNI=?")){
        $contrasenaUsuario->bind_param('s',htmlspecialchars(mysqli_real_escape_string($conectar,$dni)));
        $contrasenaUsuario->execute();
        $contrasenaAcomparar = $contrasenaUsuario->get_result(); //recogemos resultado
        $contrasenaUsuario->close(); //cerramos el prepare
    }
    //----------------------------------------------------------------------------------------
    if($usuario=$conectar->prepare("SELECT * FROM Usuario WHERE DNI=?")){
        $usuario->bind_param('s',htmlspecialchars(mysqli_real_escape_string($conectar,$dni))); //vinculamos el parámetro
        $usuario->execute();
        $datosUsuario = $usuario->get_result(); //recogemos resultado
        $usuario->close(); //cerramos el prepare
    }
    //----------------------------------------------------------------------------------------
    if($nombreUsuario=$conectar->prepare("SELECT Nombre FROM Usuario WHERE (DNI=?)")){
        $nombreUsuario->bind_param('s',htmlspecialchars(mysqli_real_escape_string($conectar,$dni)));
        $nombreUsuario->execute(); 
        $nombre = $nombreUsuario->get_result(); //recogemos resultado
        $nombreUsuario->close(); //cerramos el prepare
    } 
    $conectar->close();
    //---------------------------------------------------------------------------------------
    if(mysqli_num_rows($datosUsuario)>0){ // es decir, si existe el usuario...
        $hash=mysqli_fetch_array($contrasenaAcomparar)[0]; 
    if(password_verify($contrasena,$hash)){ // y la compara con la que ha introducido. 
    /*SESION*/
        $_SESSION['Usuario']=(mysqli_fetch_array($nombre)[0]);
        $_SESSION['DNI']=$dni;
        $_SESSION['tiempo']=time();       
        header("Location:areapersonal.php");
        logear_error("Se ha iniciado sesión correctamente");
        //logear_error("El usuario con DNI: ".$dni "ha iniciado sesión correctamente.");
    }else{
         logear_error("Contraseña incorrecta,usuario con DNI ".$dni);
    ?>
    <h3 class="bad">Contrasena incorrecta!</h3> 
    <?php 
    }
    }else{
         logear_error("El usuario no existe! DNI introducido: ".$dni);
    ?>
    <h3 class="bad">El usuario no existe!</h3>
    <?php 
    } 
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
<title>Iniciar sesión</title>
</head>
<body>
<form class="formulario" method="POST" action="iniciosesion.php">
<h4>Iniciar Sesion</h4>
<p>DNI:</p>
<input class="caja" type="text" name="dni" id ='dni' placeholder="p. ej 78675431L" required>
<p>Contraseña:</p>
<input class="caja" type="password" name ="contrasena" id='contrasena'required><br>
<div class = "mb-3">
<div class="g-recaptcha" data-sitekey="6LfG2RMpAAAAALb7mJUwVFewQVHcPbLQ8W6ANbpQ"></div>
</div>

<input class="botones" type="submit" value="Iniciar Sesion" name="iniciar">
<input class="botones"type="reset" value="Borrar datos" name="borrar">
<input class="botones" type="button" value="Volver página principal" name="volver" onclick="location.href='index.php'">
<input type="hidden" name="token" value="<?=$_SESSION["token"]?>">
<p><a href="registroform.php">No tengo una cuenta</a></p>
</section>

</body>
</html>

