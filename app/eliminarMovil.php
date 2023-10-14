<?php

$conectar = @mysqli_connect("db", "admin", "test", "database");

ob_start();

// Verificamos la conexi�n

if (!$conectar) {
    echo "No Se Pudo Conectar Con El Servidor";
} else {
    $base = mysqli_select_db($conectar, "database");
    if (!$base) {
        echo "No Se Encontro La Base De Datos";
    }
}
$modelo = $_GET["Modelo"];
$marca = $_GET["Marca"];
$precio = $_GET["Precio"];
$gama=$_GET['Gama'];
$sistema_operativo=$_GET['SistemaOperativo'];



$sql = "DELETE FROM Movil WHERE (Modelo='$modelo' AND Marca='$marca' AND Precio='$precio' AND Gama='$gama' AND SistemaOperativo='$sistema_operativo' )";
$query = mysqli_query($conectar, $sql);

if ($query) {
    echo 'Se ha eliminado el registro con Modelo ' . $modelo . ' de la lista';
    // Cambia la redirecci�n a la p�gina apropiada seg�n tus necesidades
    header("Location: lista.php"); // Cambia "lista.php" por la p�gina que necesites
    exit();
}

?>