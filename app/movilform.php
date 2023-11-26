<?php
//header('X-Frame-Options:SAMEORIGIN'); //click-jacking prevention
//header('X-Content-Type-Options: nosniff');
//header("Content-Security-Policy: default-src 'self'");
ob_start();
session_start();
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
$Modelo=$_POST['modeloMovil']; //de aqui para abajo
$Marca=$_POST['marcaMovil'];
$Precio=$_POST['precioMovil'];
$Gama=$_POST['gamaMovil'];
$SistemaOperativo=$_POST['sistemaOperativoMovil'];
$sesionactual=$_SESSION['Usuario'];
$dniactual=$_SESSION['DNI'];
if(!isset($_SESSION['Usuario']) || !isset($_SESSION['DNI'])){
  header("location:iniciosesion.php");
}else{
  if(isset($Modelo,$Marca,$Precio,$Gama,$SistemaOperativo)){
    if($registrar=$conectar->prepare("INSERT INTO Movil VALUES(?,?,?,?,?,?)")){
      $registrar->bind_param('ssisss',htmlspecialchars(mysqli_real_escape_string($conectar,$Modelo)),htmlspecialchars(mysqli_real_escape_string($conectar,$Marca)),htmlspecialchars(mysqli_real_escape_string($conectar,$Precio)),htmlspecialchars(mysqli_real_escape_string($conectar,$Gama)),htmlspecialchars(mysqli_real_escape_string($conectar,$SistemaOperativo)),htmlspecialchars(mysqli_real_escape_string($conectar,$dniactual)));
      $registrar->execute();
      $registro=$registrar->get_result();
      $registrar->close();
    }
    $conectar->close(); 
    if($registro){
      logear_error("¡Ha ocurrido un error en el registro,vuelve a introducir los datos!");
        ?>      
            <h3 class="bad">¡Ha ocurrido un error en el registro,vuelve a introducir los datos!</h3>
              <?php
                
    }else{
        ?> 
        <h3 class="ok">¡Movil registrado correctamente!</h3>
      <?php
        header("Location:listapersonal.php");
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
    <script src="./registro.js"></script>
  <title>Formulario de Registro</title>
</head>
<body>
 
   <form class="formulario" action="movilform.php" method="POST" onsubmit="return TRUE">
    <h4>Registrar movil</h4>
    <p>Modelo:</p>
    <input class="caja" type="text" name="modeloMovil" id ='nombreRegistro' placeholder="p. ej iPhone15" required>
   
    <p>Marca:</p>
    <input class="caja"type="text" name="marcaMovil" id ='marcaRegistro' placeholder="p. ej Apple" required>

    <p>Precio:</p>
    <input class="caja" type="text" name ="precioMovil" id ='precioRegistro' placeholder="p. ej 1000" required>

    <p>Gama:</p>
    <input class="caja" type="text" name ="gamaMovil" id ='gamaRegistro' placeholder="p. ej Alta" required>

    <p>Sistema Operativo:</p>
    <input class="caja" type="text" name ="sistemaOperativoMovil" id ='sistemaOperativoRegisto' placeholder="p. ej IOS" required>

    <input class="botones"type="submit" value="Registrar Movil" name="registrar.Movil">
    <input class="botones"type="reset" value="Borrar datos" name="borrar">
    <input class="botones" type="button" value="Volver pagina principal" name="volver" onclick="location.href='areapersonal.php'">
    
</form>
</body>
</html>
