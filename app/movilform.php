<?php
ob_start(); 
session_start();
$conectar=@mysqli_connect("db","admin","test","database");
if(!$conectar){
    echo"No Se Pudo Conectar Con El Servidor";
}else{
    $base=mysqli_select_db($conectar,"database");
        if(!$base){
            echo"No Se Encontro La Base De Datos";
        }
}
$Modelo=$_POST['modeloMovil'];
$Marca=$_POST['marcaMovil'];
$Precio=$_POST['precioMovil'];
$Gama=$_POST['gamaMovil'];
$SistemaOperativo=$_POST['sistemaOperativoMovil'];
$sesionactual=$_SESSION['Usuario'];

$registrar="INSERT INTO Movil VALUES('$Modelo','$Marca','$Precio','$Gama','$SistemaOperativo')";
$registro=mysqli_query($conectar,$registrar);

if(isset($Modelo,$Marca,$Precio,$Gama,$SistemaOperativo)){
  if(!$registro){
      ?>      
          <h3 class="bad">¡Ha ocurrido un error en el registro,vuelve a introducir los datos!</h3>
            <?php
              
  }else{
      ?> 
      <h3 class="ok">¡Movil registrado correctamente!</h3>
    <?php
      header("Location:lista.php");
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
 
  <form class="formulario" action="movilform.php" method="POST" onsubmit="return registrarMovil();">
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
    <input class="botones" type="button" value="Volver pagina principal" name="volver" onclick="location.href='index.php'">
    
</form>
</body>
</html>
