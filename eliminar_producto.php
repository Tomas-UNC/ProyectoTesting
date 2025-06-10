<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Obtener nombre de la imagen para eliminarla también (opcional)
    $queryImg = mysqli_query($conn, "SELECT imagen FROM productos WHERE id = $id");
    $data = mysqli_fetch_assoc($queryImg);
    if ($data && file_exists($data['imagen'])) {
        unlink($data['imagen']); // Elimina la imagen del servidor
    }

    // Eliminar el producto
    $sql = "DELETE FROM productos WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
    } else {
        echo "Error al eliminar: " . mysqli_error($conn);
    }
} else {
    echo "ID no especificado.";
}
?>