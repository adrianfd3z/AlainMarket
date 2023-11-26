<?php
header('X-Frame-Options:SAMEORIGIN'); //click-jacking prevention
header('X-Content-Type-Options: nosniff');
//header("Content-Security-Policy: default-src 'self'");
ob_start();
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

 $modelo=$_GET["Modelo"];
 $marca=$_GET["Marca"];
 $sistemaOperativo=$_GET["SistemaOperativo"];
 $precio=$_GET["Precio"];
 $gama=$_GET["Gama"];
 $dniDueño=$_GET["DNIDueño"];
 if($sql=$conectar->prepare("DELETE FROM Movil WHERE (Modelo=? AND SistemaOperativo=? AND Gama=? AND Marca=? AND Precio=? AND DNIDueño=?)")){
    $sql->bind_param('ssssis',$modelo,$sistemaOperativo,$gama,$marca,$precio,$dniDueño);
    $sql->execute();
    $eliminar=$sql->get_result();
    $sql->close();
 }
    $conectar->close();
    echo 'Se ha eliminado '.$modelo.' de la lista';
    header("Location:listapersonal.php");
?>
