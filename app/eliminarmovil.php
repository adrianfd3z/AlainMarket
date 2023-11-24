<?php
header('X-Frame-Options:SAMEORIGIN'); //click-jacking prevention
header('X-Content-Type-Options: nosniff');
//header("Content-Security-Policy: default-src 'self'");
ob_start();
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

 $modelo=$_GET["Modelo"];
 $marca=$_GET["Marca"];
 $sistemaOperativo=$_GET["SistemaOperativo"];
 if($sql=$conectar->prepare("DELETE FROM Movil WHERE (modelo=? AND sistemaOperativo=? AND marca=?)")){
    $sql->bind_param('sss',$modelo,$sistemaOperativo,$marca);
    $sql->execute();
    $eliminar=$sql->get_result();
    $sql->close();
 }
    $conectar->close();
    echo 'Se ha eliminado '.$modelo.' de la lista';
    header("Location:listapersonal.php");
?>
