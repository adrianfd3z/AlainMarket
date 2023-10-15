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

$dni=$_SESSION['DNI'];
$listamoviles="SELECT * FROM Movil";
$lista=mysqli_query($conectar,$listamoviles);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lista.css">
    <title>Lista de Móviles Registrados</title>
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
        <h2 class="titulo">Moviles registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Gama</th>
                    <th>SistemaOperativo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_array($lista)): ?>
                    <tr>
                        <th><?=$fila['Modelo'] ?></th>
                        <th><?=$fila['Marca'] ?></th>
                        <th><?=$fila['Precio'] ?></th>
                        <th><?=$fila['Gama'] ?></th>
                        <th><?=$fila['SistemaOperativo'] ?></th>
                        <th><a href="modificarMovil.php?Modelo=<?= $fila['Modelo'] ?>&Marca=<?= $fila['Marca'] ?>&Precio=<?= $fila['Precio'] ?>&Gama=<?= $fila['Gama'] ?>&SistemaOperativo=<?= $fila['SistemaOperativo'] ?>" class="editar">Editar</a></th>
                        <th><a href="eliminarMovil.php?Modelo=<?= $fila['Modelo'] ?>&Marca=<?= $fila['Marca'] ?>&Precio=<?= $fila['Precio'] ?>&Gama=<?= $fila['Gama'] ?>&SistemaOperativo=<?= $fila['SistemaOperativo'] ?>" class="eliminar" onclick='return confirmacion()'>Eliminar</a></th>
                    </tr>
                <?php endwhile; ?>
            </tbody>
           
        </table>
        
    </div>
    <input class="botones" type="button" value="Volver pagina principal" name="volver" onclick="location.href='index.php'">
</body>


</html>
