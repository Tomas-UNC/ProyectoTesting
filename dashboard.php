<?php
error_reporting(0); // Desactiva los errores, warnings y notices
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM productos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Bajo Fortuna</title>
    <link rel="stylesheet" href="css/dashboardStyle.css">
</head>
<body>
    <div id="overlay" onclick="toggleCart()"></div>

    <header>
        <img id="logo" src="imagenes/LogoBajoFortuna.jpeg" alt="Logo Bajo Fortuna">
        <div id="title">Bajo Fortuna</div>
        <div id="cart-button">
            <button onclick="toggleCart()">Carrito (<span id="cart-count">0</span>)</button>
        </div>
    </header>

    <div id="menu">
        <button onclick="filterProducts('all')">Todos</button>
        <button onclick="filterProducts('camisa')">Camisas</button>
        <button onclick="filterProducts('invierno')">Pantalones de invierno</button>
    </div>

    <!-- Enlaces al CRUD -->
    <div style="padding: 1rem;">
        <a href="agregar_producto.php">➕ Agregar Producto</a> |
        <a href="listar_productos.php">📋 Listar Productos</a> |
        <a href="view_data.php">Ver usuarios</a>
    </div>

    <div id="message"></div>

    <div id="products">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="product" data-type="<?= $row['categoria'] ?>">
                <img src="<?= htmlspecialchars($row['imagen']) ?>" alt="<?= htmlspecialchars($row['nombre']) ?>">
                <strong><?= htmlspecialchars($row['nombre']) ?></strong><br>
                <p><?= htmlspecialchars($row['descripcion']) ?></p>
                <p>Precio: $<?= htmlspecialchars($row['precio']) ?></p>
                <button onclick="addToCart('<?= htmlspecialchars($row['nombre']) ?>', '<?= htmlspecialchars($row['imagen']) ?>')">Agregar al carrito</button>
            </div>
        <?php endwhile; ?>
    </div>

    <div id="cart-panel">
        <h2>Carrito</h2>
        <div id="cart-items"></div>
    </div>

    <script>
        const cart = [];

        function addToCart(name, img) {
            cart.push({ name, img });
            document.getElementById('message').innerText = `${name} agregado al carrito`;
            updateCart();
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            document.getElementById('message').innerText = 'Se eliminó el producto con éxito';
            updateCart();
        }

        function updateCart() {
            const container = document.getElementById('cart-items');
            const count = document.getElementById('cart-count');
            container.innerHTML = '';
            cart.forEach((item, index) => {
                const div = document.createElement('div');
                div.className = 'cart-item';
                div.innerHTML = `
                    <img src="${item.img}" alt="${item.name}"> ${item.name}
                    <button onclick="removeFromCart(${index})">Eliminar</button>
                `;
                container.appendChild(div);
            });
            count.innerText = cart.length;
        }

        function toggleCart() {
            const panel = document.getElementById('cart-panel');
            const overlay = document.getElementById('overlay');
            panel.classList.toggle('open');
            overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
        }

        function filterProducts(type) {
            const all = document.querySelectorAll('.product');
            all.forEach(p => {
                if (type === 'all' || p.dataset.type === type) {
                    p.style.display = 'inline-block';
                } else {
                    p.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
