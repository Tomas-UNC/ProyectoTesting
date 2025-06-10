<?php
include 'db.php';

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];

$imagen = $_FILES['imagen']['name'];
$ruta_temporal = $_FILES['imagen']['tmp_name'];
$ruta_destino = 'imagenes/' . $imagen;

move_uploaded_file($ruta_temporal, $ruta_destino);

$sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) 
        VALUES ('$nombre', '$descripcion', '$precio', '$ruta_destino')";
mysqli_query($conn, $sql);

header('Location: listar_productos.php');
?>