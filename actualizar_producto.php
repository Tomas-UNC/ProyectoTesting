<?php
include 'db.php';

// Verificamos que se haya enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Manejo de imagen
    if ($_FILES['imagen']['name']) {
        $nombreImagen = $_FILES['imagen']['name'];
        $rutaTemporal = $_FILES['imagen']['tmp_name'];
        $carpetaDestino = 'uploads/' . $nombreImagen;

        // Movemos la imagen a la carpeta destino
        move_uploaded_file($rutaTemporal, $carpetaDestino);

        // Consulta con imagen
        $query = "UPDATE productos SET 
                    nombre = '$nombre',
                    descripcion = '$descripcion',
                    precio = '$precio',
                    imagen = '$carpetaDestino'
                  WHERE id = $id";
    } else {
        // Consulta sin cambiar imagen
        $query = "UPDATE productos SET 
                    nombre = '$nombre',
                    descripcion = '$descripcion',
                    precio = '$precio'
                  WHERE id = $id";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: listar_productos.php"); // Redirige al listado
        exit;
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
} else {
    echo "Acceso no válido.";
}
?>
<!--  -->