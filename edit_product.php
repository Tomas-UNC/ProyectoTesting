<?php
require 'db.php';
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM products WHERE id=$id");
$p = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $conn->prepare("UPDATE products SET name=?, type=?, price=?, stock=?, image_url=? WHERE id=?");
  $stmt->bind_param("ssdssi", $_POST['name'], $_POST['type'], $_POST['price'], $_POST['stock'], $_POST['image_url'], $id);
  $stmt->execute();
  header("Location: admin_products.php");
}
?>

<h2>Editar Producto</h2>
<form method="POST">
  Nombre: <input type="text" name="name" value="<?= $p['name'] ?>" required><br>
  Tipo: <input type="text" name="type" value="<?= $p['type'] ?>" required><br>
  Precio: <input type="number" step="0.01" name="price" value="<?= $p['price'] ?>" required><br>
  Stock: <input type="number" name="stock" value="<?= $p['stock'] ?>" required><br>
  Imagen URL: <input type="text" name="image_url" value="<?= $p['image_url'] ?>"><br>
  <button type="submit">Actualizar</button>
</form>