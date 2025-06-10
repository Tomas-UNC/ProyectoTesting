<!-- agregar_producto.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom, #d2e8f7, #ffffff);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .agregar_producto {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 500px;
        }

        .agregar_producto label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
            text-align: left;
        }

        .agregar_producto input[type="text"],
        .agregar_producto input[type="number"],
        .agregar_producto textarea,
        .agregar_producto input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        .agregar_producto textarea {
            resize: vertical;
            min-height: 80px;
        }

        .agregar_producto button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.2s;
            width: 100%;
        }

        .agregar_producto button:hover {
            background-color: #45a049;
            transform: scale(1.03);
        }

        @media (max-width: 600px) {
            .agregar_producto {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <form class="agregar_producto" action="insertar_producto.php" method="post" enctype="multipart/form-data">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" class="nombre"><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion"></textarea><br>

        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio"><br>

        <label>Imagen:</label><br>
        <input type="file" name="imagen"><br>

        <br><button type="submit">Agregar producto</button>
    </form>
</body>
</html>
