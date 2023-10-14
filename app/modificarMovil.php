<?php
$Modelo=$_GET['Modelo'];
$Marca=$_GET['Marca']
$Precio=$_GET['Precio']
$Gama=$_GET['Gama'];
$sistema_operativo=$_GET['SistemaOperativo'];
ob_start();
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
  
  <form class="formulario" action="modificarMovil.php?Modelo=<?=$Modelo?>&Marca=<?=$Marca?>&Precio=<?=$Precio?>&Gama=<?=$Gama?>&SistemaOperativo=<?=$sistema_operativo?>"method="POST" onsubmit="return comprobarCampos();">
    <h4>Modificar datos de:</h4>
    <h4> <?php echo $Modelo;
    ?></h4>
    <input type="hidden" name="Modelo" value="<?=$Modelo?>">
    <p>Modelo:</p>
    <input class="caja" type="text" name="modeloMovil" id ='modeloMovil' placeholder="p. ej iPhone15 ">

    <p>Marca:</p>
    <input class="caja"type="text" name="marcaMovil" id ='marcaMovil' placeholder="p. ej Apple">

    <p>Precio:</p>
    <input class="caja" type="text" name ="precioMovil" id ='precioMovil' placeholder="p. ej 1000" >

    <p>Gama:</p>
    <input class="caja" type="text" name ="gamaMovil" id ='gamaMovil' placeholder="p. ej Alta">

    <p>Sistema Operativo:</p>
    <input class="caja" type="text" name ="sistemaOperativo" id ='sistemaOperativo' placeholder="p. ej IOS">

    <input class="botones"type="submit" value="Modificar datos" name="registrar.movil">
    <input class="botones"type="button" value="Volver a la lista" name="volver.lista" onclick="location.href='lista.php'">
    <input class="botones"type="reset" value="Borrar datos" name="borrar">

</form>
</body>
</html>

<?php
ob_start();
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

$modelo=$_GET["Modelo"];
$Gama=$_GET["Gama"];
$sistema_operativo=$_GET["SistemaOperativo"];

$modelo=$_POST['modeloMovil'];
$marca = $_POST['marcaMovil'];
$precio = $_POST['precioMovil'];
$gama = $_POST['gamaMovil'];
$sistop=$_POST['sistemaOperativo'];

$sql1="UPDATE Movil SET Modelo ='$modelo'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
$sql2="UPDATE Movil SET SistemaOperativo='$sistop' WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
$sql3="UPDATE Movil SET Gama='$gama'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
$sql4="UPDATE Movil SET Precio='$precio'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
$sql5="UPDATE Movil SET Marca='$marca'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";

    if(!empty($modelo)){
        $ejecutar1=mysqli_query($conectar,$sql1);
            if($ejecutar1){
                $Modelo=$modelo;
                $sql2="UPDATE Movil SET SistemaOperativo='$sistop' WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
                $sql3="UPDATE Movil SET Gama='$gama'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
                $sql4="UPDATE Movil SET Precio='$precio'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
                $sql5="UPDATE Movil SET Marca='$marca'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";  
                ?> 
                    <h3 class="bien">Nodelo modificado correctamente!</h3>
                <?php
             }

            }
             if(!empty($sistop)){
                $ejecutar2=mysqli_query($conectar,$sql2);
                    if($ejecutar2){
                        $sistema_operativo=$sistop;
                        $sql1="UPDATE Movil SET Modelo ='$modelo'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
                        $sql3="UPDATE Movil SET Gama='$gama'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
                        $sql4="UPDATE Movil SET Precio='$precio'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
                        $sql5="UPDATE Movil SET Marca='$marca'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";                          
                        ?> 
                            <h3 class="bien">Sistema Operativo  modificados correctamente!</h3>
                        <?php
                        
                     }
                }
                if(!empty($gama)){
                    $ejecutar3=mysqli_query($conectar,$sql3);
                        if($ejecutar3){
                            $Gama=$gama;
                            $sql1="UPDATE Movil SET Modelo ='$modelo'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
                            $sql2="UPDATE Movil SET SistemaOperativo='$sistop' WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
                            $sql3="UPDATE Movil SET Gama='$gama'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
                            $sql4="UPDATE Movil SET Precio='$precio'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
                            $sql5="UPDATE Movil SET Marca='$marca'WHERE (Modelo='$Modelo' AND SistemaOperativo='$sistema_operativo' AND Gama='$Gama')";
                                ?> 
                                <h3 class="bien">Gama  modificados correctamente!</h3>
                            <?php
                                
                         }
                    }        
                
        if(!empty($precio)){
            $ejecutar4=mysqli_query($conectar,$sql4);
            if($ejecutar4){
                ?> 
                    <h3 class="bien">Precio modificado correctamente!</h3>
                <?php
             }

        }

        if(!empty($marca)){
            $ejecutar5=mysqli_query($conectar,$sql5);
            if($ejecutar5){
                ?> 
                    <h3 class="bien">Marca modificada correctamente!</h3>
                <?php
             }

        }

?>
