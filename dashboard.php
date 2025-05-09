<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
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

    <div id="message"></div>

    <div id="products"></div>

    <div id="cart-panel">
        <h2>Carrito</h2>
        <div id="cart-items"></div>
    </div>

    <script>
        const products = [
            { id: 1, name: 'Camisa Blanca', type: 'camisa', stock: true, img: 'imagenes/camisablanca.jpg' },
            { id: 2, name: 'Camisa Azul', type: 'camisa', stock: true, img: 'imagenes/camisaazul.jpg' },
            { id: 3, name: 'Camisa Negra', type: 'camisa', stock: true, img: 'imagenes/camisanegra.jpg' },
            { id: 4, name: 'Camisa Roja', type: 'camisa', stock: false, img: 'imagenes/camisaroja.jpg' },
            { id: 5, name: 'Camisa Verde', type: 'camisa', stock: true, img: 'imagenes/camisaverde.jpg' },
            { id: 6, name: 'Short Gris', type: 'corto', stock: true, img: 'imagenes/cortogris.jpg' },
            { id: 7, name: 'Short Azul', type: 'corto', stock: true, img: 'imagenes/cortoazul.jpg' },
            { id: 8, name: 'Short Negro', type: 'corto', stock: true, img: 'imagenes/cortonegro.jpg' },
            { id: 9, name: 'Short Rojo', type: 'corto', stock: true, img: 'imagenes/cortorojo.jpg' },
            { id: 10, name: 'Short Verde', type: 'corto', stock: true, img: 'imagenes/cortoverde.jpg' },
            { id: 11, name: 'Pantalón Invierno Gris', type: 'invierno', stock: true, img: 'imagenes/largogris.jpg' },
            { id: 12, name: 'Pantalón Invierno Negro', type: 'invierno', stock: true, img: 'imagenes/largonegro.jpg' },
            { id: 13, name: 'Pantalón Invierno Azul', type: 'invierno', stock: true, img: 'imagenes/largoazul.jpg' },
            { id: 14, name: 'Pantalón Invierno Rojo', type: 'invierno', stock: true, img: 'imagenes/largorojo.jpg' },
            { id: 15, name: 'Pantalón Invierno Marrón', type: 'invierno', stock: true, img: 'imagenes/largomarron.jpg' }
        ];

        const cart = [];

        function showProducts(filter = 'all') {
            const container = document.getElementById('products');
            container.innerHTML = '';
            products.forEach(product => {
                if (filter !== 'all' && product.type !== filter) return;
                const div = document.createElement('div');
                div.className = 'product';
                div.innerHTML = `
                    <img src="${product.img}" alt="${product.name}">
                    <strong>${product.name}</strong><br>
                    ${!product.stock ? '<span style="color:red;">Sin stock</span>' : ''}<br>
                    <button onclick="${product.stock ? `addToCart(${product.id})` : `showNotAvailable()`}">
                        ${product.stock ? 'Agregar al carrito' : 'No hay stock'}
                    </button>
                `;
                container.appendChild(div);
            });
        }

        function addToCart(id) {
            const product = products.find(p => p.id === id);
            cart.push(product);
            document.getElementById('message').innerText = `${product.name} agregado al carrito`;
            updateCart();
        }

        function showNotAvailable() {
            document.getElementById('message').innerText = 'No disponible';
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
            showProducts(type);
        }

        showProducts();
    </script>
</body>
</html>
