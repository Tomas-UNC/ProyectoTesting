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
  <style>
    body {
      background: #d2e8f7;
      margin: 0;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
    }

    table {
      border-collapse: collapse;
      width: 90%;
      max-width: 800px;
      background-color: white;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 15px;
      text-align: center;
      border-bottom: 1px solid #eee;
    }

    th {
      background-color: #f5f5f5;
      color: #333;
      font-weight: bold;
    }

    tr:hover {
      background-color: #f0f8ff;
    }

    button {
      background-color: #dc3545; /* rojo */
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #c82333;
    }

    a {
      margin-top: 20px;
      display: inline-block;
      text-decoration: none;
      color: #007bff;
      font-weight: bold;
      transition: color 0.3s;
    }

    a:hover {
      color: #0056b3;
    }

    form {
      margin: 0;
    }
  </style>

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
