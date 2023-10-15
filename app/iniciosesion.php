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
	$nombre=$_POST['nombre'];
	$dni=$_POST['dni'];
	$contrasena=$_POST['contrasena'];
	$contrasenaUsuario="SELECT Contrasena FROM Usuario WHERE (DNI='$dni')";
	$usuario="SELECT * FROM Usuario WHERE (DNI='$dni')";
	$nombreUsuario="SELECT Nombre FROM Usuario WHERE (DNI='$dni')"; 
	$ejecutar=mysqli_query($conectar,$contrasenaUsuario); 
	$existeUsuario=mysqli_query($conectar,$usuario);     
	$nombreSesion=mysqli_query($conectar,$nombreUsuario);  
    if(isset($dni) && isset($contrasena)){                                           
      if(mysqli_num_rows($existeUsuario)>0){ 
        $cont=mysqli_fetch_array($ejecutar);
        if(strcmp($cont[0],$contrasena) === 0){    
          $sesion=mysqli_fetch_array($nombreSesion);
          header("Location:areapersonal.php");
          $_SESSION['Usuario']=$sesion[0];
          $_SESSION['DNI']=$dni;
          
        }else{
?>
          <h3 class="bad">Contrasena incorrecta!</h3>
<?php 
        }
      }else{
?>
          <h3 class="bad">El usuario no existe!</h3>	
<?php 
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
  <title>Iniciar sesión</title>
</head>
<body>
  <form class="formulario" method="POST" action="iniciosesion.php">
    <h4>Iniciar Sesion</h4>
    <p>DNI:</p>
    <input class="caja" type="text" name="dni" id ='dni' placeholder="p. ej 78675431L" required>
    
    <p>Contraseña:</p>
    <input class="caja" type="password" name ="contrasena" id='contrasena'required><br>
    <input class="botones" type="submit" value="Iniciar Sesion" name="iniciar">
    <input class="botones"type="reset" value="Borrar datos" name="borrar">
    <input class="botones" type="button" value="Volver página principal" name="volver" onclick="location.href='index.php'">
  </section>

</body>
</html>
