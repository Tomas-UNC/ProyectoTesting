<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM productos WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        echo "Producto no encontrado.";
        exit;
    }
} else {
    echo "ID no especificado.";
    exit;
}
?>

<form action="actualizar_producto.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= $row['nombre'] ?>"><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion"><?= $row['descripcion'] ?></textarea><br>

    <label>Precio:</label><br>
    <input type="number" step="0.01" name="precio" value="<?= $row['precio'] ?>"><br>

    <label>Imagen actual:</label><br>
    <img src="<?= $row['imagen'] ?>" width="100"><br>

    <label>Cambiar imagen:</label><br>
    <input type="file" name="imagen"><br><br>

    <button type="submit">Actualizar</button>
</form>
