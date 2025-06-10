<style>
    .product-card {
        display: flex;
        align-items: flex-start;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        padding: 20px;
        margin-bottom: 18px;
    }
    .product-card img {
        width: 200px;
        height: 200px;
        object-fit: contain;
        border-radius: 8px;
        margin-right: 24px;
        border: 1px solid #eee;
        background: #fff;
        display: block;
    }
    .product-info {
        flex: 1;
    }
    .product-info h3 {
        margin-top: 0;
        margin-bottom: 8px;
    }
    .product-info p {
        margin: 6px 0;
    }
    .product-actions {
        margin-top: 12px;
    }
    .product-actions a {
        text-decoration: none;
        background: #3b82f6;
        color: #fff;
        padding: 7px 18px;
        border-radius: 5px;
        margin-right: 12px;
        font-weight: bold;
        transition: background 0.17s;
    }
    .product-actions a:last-child {
        background: #ef4444;
        margin-right: 0;
    }
    .product-actions a:hover {
        filter: brightness(1.08);
    }
    .volver-btn {
        display: inline-block;
        margin: 30px 0 30px 20px;
        background: #10b981;
        color: #fff;
        padding: 10px 30px;
        border-radius: 7px;
        font-size: 1rem;
        font-weight: bold;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(16,185,129,0.08);
        transition: background 0.18s;
    }
    .volver-btn:hover {
        background: #059669;
    }
    body {
        background: #f5f6fa;
        font-family: 'Segoe UI', Arial, sans-serif;
    }
</style>
<a href="dashboard.php" class="volver-btn">← Volver al Dashboard</a>
<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM productos");

while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='product-card'>";
    echo "<img src='{$row['imagen']}' alt='{$row['nombre']}'>";
    echo "<div class='product-info'>";
    echo "<h3>{$row['nombre']}</h3>";
    echo "<p>{$row['descripcion']}</p>";
    echo "<p>Precio: <strong>\${$row['precio']}</strong></p>";
    echo "<div class='product-actions'>";
    echo "<a href='editar_producto.php?id={$row['id']}'>Editar</a>";
    echo "<a href='eliminar_producto.php?id={$row['id']}'>Eliminar</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
?>