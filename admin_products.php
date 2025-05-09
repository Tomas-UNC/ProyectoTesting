<?php
require 'db.php';
$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Administrar Productos</title>
</head>
<body>
  <h1>Productos</h1>
  <a href="add_product.php">Agregar Producto</a>
  <table border="1">
    <tr>
      <th>ID</th><th>Nombre</th><th>Tipo</th><th>Precio</th><th>Stock</th><th>Acciones</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['name'] ?></td>
      <td><?= $row['type'] ?></td>
      <td>$<?= $row['price'] ?></td>
      <td><?= $row['stock'] ?></td>
      <td>
        <a href="edit_product.php?id=<?= $row['id'] ?>">Editar</a> |
        <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Borrar este producto?')">Eliminar</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
