<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // No permitir que un usuario se elimine a sí mismo
    if ($id == $_SESSION['user_id']) {
        echo "No puedes eliminar tu propia cuenta.";
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: view_data.php");
    } else {
        echo "Error al eliminar usuario.";
    }
    $stmt->close();
}
$conn->close();
?>
