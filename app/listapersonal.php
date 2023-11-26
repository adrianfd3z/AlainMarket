<?php //https://www.youtube.com/watch?v=sYaEoNy5OGs
header('X-Frame-Options:SAMEORIGIN'); //click-jacking prevention
header('X-Content-Type-Options: nosniff');
//header("Content-Security-Policy: default-src 'self'");
ob_start();
session_start();
$conectar = @mysqli_connect("db", "DgfG5eVE1pEb8B", "yKbfwxEjRNByKz", "database");
if(!$conectar){
    echo"No Se Pudo Conectar Con El Servidor";
}else{
    $base=mysqli_select_db($conectar,"database");
        if(!$base){
            echo"No Se Encontro La Base De Datos";
        }
}

if(!isset($_SESSION['Usuario']) || !isset($_SESSION['DNI'])){
    header("location:iniciosesion.php");
}else{
$dni=$_SESSION['DNI'];
    if($listamoviles=$conectar->prepare("SELECT * FROM Movil WHERE DNIDueño=?")){
        $listamoviles->bind_param('s',$dni);
        $listamoviles->execute();
        $lista=$listamoviles->get_result();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lista.css">
    <title>Lista de moviles Registrados</title>
</head>
<script>
    function confirmacion(){
        var respuesta=confirm("¿Desea eliminar el registro seleccionado?");
        if(respuesta==true){
            return true;
        }else{
            return false;
        }
    }
</script>

<body>
    <div class="listamoviles">
        <h2>moviles registrados con el DNI: <?php echo $dni ?> </h2>
        <table>
            <thead>
                <tr> 
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Gama</th>
                    <th>SistemaOperativo</th>
                    <th>DNIDueño</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while ($fila = mysqli_fetch_array($lista)): ?>
                    <tr>
                        <th><?=$fila['Modelo'] ?></th>
                        <th><?=$fila['Marca'] ?></th>
                        <th><?=$fila['Precio'] ?></th>
                        <th><?=$fila['Gama'] ?></th>
                        <th><?=$fila['SistemaOperativo'] ?></th>
                        <th><?=$fila['DNIDueño']?></th>
                        <th><a href="modificarMovil.php?Modelo=<?=$fila['Modelo']?>&Gama=<?=$fila['Gama']?>&SistemaOperativo=<?=$fila['SistemaOperativo']?>&DNIDueño=<?=$fila['DNIDueño']?>&Marca=<?=$fila['Marca']?>&Precio=<?=$fila['Precio']?>" class="editar">Editar</a></th>
                        <th><a href="eliminarMovil.php?Modelo=<?=$fila['Modelo']?>&Gama=<?=$fila['Gama']?>&SistemaOperativo=<?=$fila['SistemaOperativo']?>&DNIDueño=<?=$fila['DNIDueño']?>&Marca=<?=$fila['Marca']?>&Precio=<?=$fila['Precio']?>" class="eliminar" onclick='return confirmacion()' >Eliminar</a></th>
                    </tr>
                        
                <?php endwhile; ?>
                    
            </tbody>
           
        </table>
        
    </div>
    <input class="botones" type="button" value="Volver area personal" name="volver.area" onclick="location.href='areapersonal.php'">
    <input class="botones" type="button" value="Volver pagina principal" name="volver.index" onclick="location.href='index.php'">
</body>


</html>
