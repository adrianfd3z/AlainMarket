<?php
header('X-Frame-Options:SAMEORIGIN'); //click-jacking prevention
header('X-Content-Type-Options: nosniff');
//header("Content-Security-Policy: default-src 'self'");
$Modelo = $_GET['Modelo'];
$Marca = $_GET['Marca'];
$Precio = $_GET['Precio'];
$Gama = $_GET['Gama'];
$sistema_operativo = $_GET['SistemaOperativo'];

//Solo sirve para autorrellenar los valores de la casilla con la info del movil anterior
$v1=$_GET['Modelo'];
$v2 = $_GET['Marca'];
$v3 = $_GET['Precio'];
$v4 = $_GET['Gama'];
$v5 = $_GET['SistemaOperativo'];

ob_start();
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
  
  <form class="formulario" action="modificarMovil.php?Modelo=<?=$Modelo?>&Marca=<?=$Marca?>&Precio=<?=$Precio?>&Gama=<?=$Gama?>&SistemaOperativo=<?=$sistema_operativo?>"method="POST" onsubmit="return comprobarCampos();">
    <h4>Modificar datos de:</h4>
    <h4> <?php echo $Modelo;
    ?></h4>
    <input type="hidden" name="Modelo" value="<?=$Modelo?>">
    <p>Modelo:</p>
    <input class="caja" type="text" name="modeloMovil" id ='modeloMovil' placeholder="p. ej iPhone15" value= <?php echo $v1;
    ?>>

    <p>Marca:</p>
    <input class="caja"type="text" name="marcaMovil" id ='marcaMovil' placeholder="p. ej Apple" value= <?php echo $v2;
    ?>>

    <p>Precio:</p>
    <input class="caja" type="text" name ="precioMovil" id ='precioMovil' placeholder="p. ej 1000" value= <?php echo $v3;
    ?>>

    <p>Gama:</p>
    <input class="caja" type="text" name ="gamaMovil" id ='gamaMovil' placeholder="p. ej Alta" value= <?php echo $v4;
    ?>>

    <p>Sistema Operativo:</p>
    <input class="caja" type="text" name ="sistemaOperativo" id ='sistemaOperativo' placeholder="p. ej IOS" value= <?php echo $v5;
    ?>>

    <input class="botones"type="submit" value="Modificar datos" name="registrar.movil">
    <input class="botones"type="button" value="Volver a la lista" name="volver.lista" onclick="location.href='listapersonal.php'">
    <input class="botones"type="reset" value="Borrar datos" name="borrar">

</form>
</body>
</html>

<?php
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

$Modelo=$_GET["Modelo"];
$Gama=$_GET["Gama"];
$sistema_operativo=$_GET["SistemaOperativo"];
//$dniDueño = $_GET["DNIDueño"];
$dniDueño=$_SESSION['DNI'];


$modelo=$_POST['modeloMovil'];
$marca = $_POST['marcaMovil'];
$precio = $_POST['precioMovil'];
$gama = $_POST['gamaMovil'];
$sistop=$_POST['sistemaOperativo'];

$sql1 = "UPDATE Movil SET Modelo='$modelo', SistemaOperativo='$sistop', Gama='$gama', Precio='$precio', Marca='$marca' WHERE Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama'";

if (!isset($_SESSION['Usuario']) || !isset($_SESSION['DNI'])) {
    header("location:iniciosesion.php");
} 
else {
    if(isset($modelo,$marca,$precio,$gama,$sistop)){
        if($sql = $conectar->prepare("UPDATE Movil SET Modelo=?, Marca=?, Precio=?, Gama=?, SistemaOperativo=? WHERE Modelo=? AND SistemaOperativo=? AND Gama=? AND DNIDueño=?")){
            $sql->bind_param('ssissssss', $modelo, $marca, $precio, $gama, $sistop, $Modelo, $sistema_operativo, $Gama, $dniDueño);
            $sql->execute();
            $ejecutar=$sql->get_result();
            if(!$ejecutar){
                ?> 
                    <h3 class="bien">¡Datos modificados correctamente!</h3>
                  <?php
            }
            $sql->close();
            header("Location:listapersonal.php");
            
        }
        /*if(isset($modelo,$marca,$precio,$gama,$sistop)){
        $ejecutar1=mysqli_query($conectar,$sql1); 
        header("Location:listapersonal.php");
            
        }*/
         
    }
        
}
    


    

?>
