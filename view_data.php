<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

$result = $conn->query("SELECT id, username FROM users");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Usuarios Registrados</title>
</head>
<body>
  <h2>Lista de Usuarios</h2>
  <table border="1">
    <tr><th>ID</th><th>Usuario</th><th>Acción</th></tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td>
          <?php if ($row['id'] != $_SESSION['user_id']): ?>
            <form method="POST" action="delete_user.php" onsubmit="return confirm('¿Seguro que quieres eliminar este usuario?');">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <button type="submit">Eliminar</button>
            </form>
          <?php else: ?>
            (Tú)
          <?php endif; ?>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
  <p><a href="dashboard.php">Volver</a></p>
  <script src="js/main.js"></script>
</body>
</html>
