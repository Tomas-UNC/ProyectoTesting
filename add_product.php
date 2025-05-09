<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $conn->prepare("INSERT INTO products (name, type, price, stock, image_url) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("ssdss", $_POST['name'], $_POST['type'], $_POST['price'], $_POST['stock'], $_POST['image_url']);
  $stmt->execute();
  header("Location: admin_products.php");
}
?>

<h2>Agregar Producto</h2>
<form method="POST">
  Nombre: <input type="text" name="name" required><br>
  Tipo: <input type="text" name="type" required><br>
  Precio: <input type="number" step="0.01" name="price" required><br>
  Stock: <input type="number" name="stock" required><br>
  Imagen URL: <input type="text" name="image_url"><br>
  <button type="submit">Guardar</button>
</form>