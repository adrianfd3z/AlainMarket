<?php
header('X-Frame-Options:SAMEORIGIN'); //click-jacking prevention
header('X-Content-Type-Options: nosniff');
//header("Content-Security-Policy: default-src 'self'");
$Modelo=$_POST['modeloMovil']; //de aqui para abajo
$Marca=$_POST['marcaMovil'];
$Precio=$_POST['precioMovil'];
$Gama=$_POST['gamaMovil'];
$SistemaOperativo=$_POST['sistemaOperativoMovil'];
$sesionactual=$_SESSION['Usuario'];
$dniactual=$_SESSION['DNI'];
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formularios.css">
    <script src="./mod.js"></script>
  <title>Formulario de Registro</title>
</head>
<body>
  
  <form class="formulario" action="modificarMovil.php?Modelo=<?=$Modelo?>&Marca=<?=$Marca?>&SistemaOperativo=<?=$SistemaOperativo?>&DNI=<?=$fila['DNI']?>"method="POST" onsubmit="return TRUE">
    <h4>Modificar datos de:</h4>
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

$Modelo=$_GET["Modelo"];
$Marca=$_GET["Marca"];
$SistemaOperativo=$_GET["SistemaOperativo"];

$Modelo=$_POST['Modelo'];
$Marca = $_POST['Marca'];
$Precio = $_POST['Precio'];
$gama = $_POST['gama'];
$sistemaOperativoform=$_POST['SistemaOperativo'];

$sql1="UPDATE Movil SET Modelo=?WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)"; //Modelo
$sql2="UPDATE Movil SET SistemaOperativo=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)"; // SistemaOperativo 
$sql3="UPDATE Movil SET Marca=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)"; // Marca 
$sql4="UPDATE Movil SET Precio=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)"; //Precio
$sql5="UPDATE Movil SET SistemaOperativo=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)"; //Marca
if(!isset($_SESSION['Usuario']) || !isset($_SESSION['DNI'])){
    header("location:iniciosesion.php");
}else{
    if(!empty($Modelo)){
        if($ejecutar1=$conectar->prepare("UPDATE Movil SET Modelo=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
            $ejecutar1->bind_param('ssss',htmlspecialchars(mysqli_real_escape_string($conectar,$Modelo)),htmlspecialchars(mysqli_real_escape_string($conectar,$Modelo)),htmlspecialchars(mysqli_real_escape_string($conectar,$SistemaOperativo)),htmlspecialchars(mysqli_real_escape_string($conectar,$Marca)));
            $ejecutar1->execute();
            $ejecucion1=$ejecutar1->get_result();
            $ejecutar1->close();
        }
            if($ejecucion1){
                logear_error("No se ha podido modificar el Modelo!");
                ?> 
                    <h3 class="bad">No se ha podido modificar el Modelo!</h3>
                    
                <?php
               
             }else{
                $Modelo=$Modelo;
                /*if($sql2=$conectar->prepare("UPDATE Movil SET SistemaOperativo=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                    $sql2->bind_param('ssss',$sistemaOperativoform,$Modelo,$SistemaOperativo,$Marca);
                   // $sql2->execute();
                }
                if($sql3=$conectar->prepare("UPDATE Movil SET Marca=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                    $sql3->bind_param('ssss',$Marca,$Modelo,$SistemaOperativo,$Marca);
                    //$sql3->execute();
                }
                if($sql4=$conectar->prepare("UPDATE Movil SET Precio=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                    $sql4->bind_param('ssss',$Precio,$Modelo,$SistemaOperativo,$Marca);
                    //$sql4->execute();
                }
                if($sql5=$conectar->prepare("UPDATE Movil SET Marca=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                    $sql5->bind_param('ssss',$Marca,$Modelo,$SistemaOperativo,$Marca);
                    //$sql5->execute();
                }*/
                ?> 
                    <h3 class="bien">Modelo modificado correctamente!</h3>
                <?php
             }

            }
             if(!empty($sistemaOperativoform)){
                if($ejecutar2=$conectar->prepare("UPDATE Movil SET SistemaOperativo=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                    $ejecutar2->bind_param('ssss',htmlspecialchars(mysqli_real_escape_string($conectar,$sistemaOperativoform)),htmlspecialchars(mysqli_real_escape_string($conectar,$Modelo)),htmlspecialchars(mysqli_real_escape_string($conectar,$SistemaOperativo)),htmlspecialchars(mysqli_real_escape_string($conectar,$Marca)));
                    $ejecutar2->execute();
                    $ejecucion2=$ejecutar2->get_result();
                    $ejecutar2->close();
                }
                    if($ejecucion2){
                        logear_error("No se ha podido modificar el SistemaOperativo!");
                        ?> 
                        <h3 class="bad">No se ha podido modificar el SistemaOperativo!</h3>
                    <?php

                    }else{
                        $SistemaOperativo=$sistemaOperativoform;
                        /*if($sql1=$conectar->prepare("UPDATE Movil SET Modelo=?WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                            $sql1->bind_param('ssss',$Modelo,$Modelo,$sistemaOperativoform,$Marca);
                          //  $sql1->execute();
                        }
                        if($sql3=$conectar->prepare("UPDATE Movil SET Marca=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                            $sql3->bind_param('ssss',$Marca,$Modelo,$sistemaOperativoform,$Marca);
                            //$sql3->execute();
                        }
                        if($sql4=$conectar->prepare("UPDATE Movil SET Precio=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                            $sql4->bind_param('ssss',$Precio,$Modelo,$sistemaOperativoform,$Marca);
                          //  $sql4->execute();
                        }
                        if($sql5=$conectar->prepare("UPDATE Movil SET Marca=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                            $sql5->bind_param('ssss',$Marca,$Modelo,$sistemaOperativoform,$Marca);
                         //   $sql5->execute();  
                        }*/
                                                
                        ?> 
                            <h3 class="bien">SistemaOperativo de Origen modificados correctamente!</h3>
                        <?php
                        
                     }
                }
  
                        
                if(!empty($Marca)){
                    if($ejecutar3=$conectar->prepare("UPDATE Movil SET Marca=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                        $ejecutar3->bind_param('ssss',htmlspecialchars(mysqli_real_escape_string($conectar,$Marca)),htmlspecialchars(mysqli_real_escape_string($conectar,$Modelo)),htmlspecialchars(mysqli_real_escape_string($conectar,$SistemaOperativo)),htmlspecialchars(mysqli_real_escape_string($conectar,$Marca)));
                        $ejecutar3->execute();
                        $ejecucion3=$ejecutar3->get_result();
                        $ejecutar3->close();
                    }
                        if($ejecucion3){
                            logear_error("No se ha podido modificar la Marca!");
                            ?> 
                            <h3 class="bad">No se ha podido modificar la Marca!</h3>
                        <?php
                        }else{
                            $Marca=$Marca;
                            /*if($sql1=$conectar->prepare("UPDATE Movil SET Modelo=?WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                                $sql1->bind_param('ssss',$Modelo,$Modelo,$SistemaOperativo,$Marca);
                                //$sql1->execute();
                            }
                            if($sql2=$conectar->prepare("UPDATE Movil SET SistemaOperativo=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                                $sql2->bind_param('ssss',$sistemaOperativoform,$Modelo,$SistemaOperativo,$Marca);
                                //$sql2->execute();
                            }
                            if($sql3=$conectar->prepare("UPDATE Movil SET Marca=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                                $sql3->bind_param('ssss',$Marca,$Modelo,$SistemaOperativo,$Marca);
                                //$sql3->execute();
                            }
                            if($sql4=$conectar->prepare("UPDATE Movil SET Precio=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                                $sql4->bind_param('ssss',$Precio,$Modelo,$SistemaOperativo,$Marca);
                                //$sql4->execute();
                            }
                            if($sql5=$conectar->prepare("UPDATE Movil SET Marca=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)")){
                                $sql5->bind_param('ssss',$Marca,$Modelo,$SistemaOperativo,$Marca);
                               // $sql5->execute();
                            }*/
                            ?> 
                                <h3 class="bien">Marca  modificada correctamente!</h3>
                            <?php
                        }
                           
                                
             }       
                
        if(!empty($Precio)){
           $sql4=$conectar->prepare("UPDATE Movil SET Precio=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)");
           $sql4->bind_param('ssss',htmlspecialchars(mysqli_real_escape_string($conectar,$Precio)),htmlspecialchars(mysqli_real_escape_string($conectar,$Modelo)),htmlspecialchars(mysqli_real_escape_string($conectar,$SistemaOperativo)),htmlspecialchars(mysqli_real_escape_string($conectar,$Marca)));
           $sql4->execute();
           $ejecucion4=$sql4->get_result();
           $sql4->close();
            if($ejecucion4){
                logear_error("No se ha podido modificar el Precio!");
                ?> 
                <h3 class="bad">No se ha podido modificar el Precio!</h3>
            <?php
                
             }else{
                ?> 
                    <h3 class="bien">Precio modificado correctamente!</h3>
                <?php
             }

        }

        if(!empty($gama)){
           $sql5=$conectar->prepare("UPDATE Movil SET Gama=? WHERE (Modelo=? AND SistemaOperativo=? AND Marca=?)");
           $sql5->bind_param('ssss',htmlspecialchars(mysqli_real_escape_string($conectar,$Marca)),htmlspecialchars(mysqli_real_escape_string($conectar,$Modelo)),htmlspecialchars(mysqli_real_escape_string($conectar,$SistemaOperativo)),htmlspecialchars(mysqli_real_escape_string($conectar,$Marca)));
           $sql5->execute();
           $ejecucion5=$sql5->get_result();
           $sql5->close();
            if($ejecucion5){
                logear_error("No se ha podido modificar la gama!");
                ?> 
                <h3 class="bad">No se ha podido modificar la gama!</h3>
            <?php
                
             }else{
                ?> 
                    <h3 class="bien">Gama modificada correctamente!</h3>
                <?php
             }

        }
}    


?>