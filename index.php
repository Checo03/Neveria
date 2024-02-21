<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neveria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <br><br>
    <h1>Nevería</h1>
    <br> 

    <div class="toggle-buttons">
        <button onclick="showForm('Ventas')">Dar Alta Ventas</button>
        <button onclick="showForm('Proveedores')">Dar Alta Proveedores Y Productos</button>
        <button onclick="showForm('Empleado')">Dar Alta Empleado</button>
        <button onclick="showForm('Clientes_bajas')">Dar Baja a cliente</button>
        <button onclick="showForm('Prod_bajas')">Dar Baja A Producto O Proveedor</button>
        <button onclick="showForm('Empl_bajas')">Dar Baja Empleado</button>
        <button onclick="showForm('Consultav')">Consulta de ventas</button>
    </div>

    <div id="Ventas" class="form-container">
        <!-- Formulario de Registro de Clientes -->
    <form action="Reg/registrar_cliente.php" method="post">
        <h2>Cliente</h2>
        <label for="nombre_cliente">Nombre del Cliente:</label>
        <input type="text" id="nombre_cliente" name="nombre_cliente" required>
        <br>
        <label for="telefono_cliente">Teléfono:</label>
        <input type="text" id="telefono_cliente" name="telefono_cliente" required>
        <br>
        <label for="correo_cliente">Correo Electrónico:</label>
        <input type="email" id="correo_cliente" name="correo_cliente" required>
        <br>
        <label for="direccion_cliente">Dirección:</label>
        <input type="text" id="direccion_cliente" name="direccion_cliente" required>
        <br>
        <button type="submit">Registrar Cliente</button>
    </form>
    <!-- Formulario de Registro de Ventas -->
    <form action="reg/registrar_venta.php" method="post">
        <h2>Venta</h2>
         
        <?php
   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "neve";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta para verificar si hay empleados registrados
    $query_empleados = "SELECT COUNT(*) as total_empleados FROM Empleados";
    $result_empleados = $conn->query($query_empleados);
    $row_empleados = $result_empleados->fetch_assoc();
    $total_empleados = $row_empleados['total_empleados'];

    // Cierra la conexión
    $conn->close();

    if ($total_empleados > 0) {
        // Si hay empleados, muestra el select de clientes
        ?>
        <label for="cliente_venta">Cliente:</label>
        <select id="cliente_venta" name="cliente_venta" required>
            <?php
            
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verifica la conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Consulta para obtener opciones de clientes
            $query_clientes = "SELECT Cliente_ID, Nombre FROM Clientes";
            $result_clientes = $conn->query($query_clientes);

            // Imprime las opciones de clientes
            while ($row_cliente = $result_clientes->fetch_assoc()) {
                echo "<option value='" . $row_cliente['Cliente_ID'] . "'>" . $row_cliente['Nombre'] . "</option>";
            }

            // Cierra la conexión
            $conn->close();
            ?>
        </select>

        <br>

        <?php
        // Muestra el select de empleados
        ?>
        <label for="empleado_venta">Empleado:</label>
        <select id="empleado_venta" name="empleado_venta" required>
            <?php
           
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verifica la conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Consulta para obtener opciones de empleados
            $query_empleados = "SELECT Empleado_ID, Nombre FROM Empleados";
            $result_empleados = $conn->query($query_empleados);

            // Imprime las opciones de empleados
            while ($row_empleado = $result_empleados->fetch_assoc()) {
                echo "<option value='" . $row_empleado['Empleado_ID'] . "'>" . $row_empleado['Nombre'] . "</option>";
            }

            // Cierra la conexión
            $conn->close();
            ?>
        </select>

        <br>
        <br>
        <label for="fecha_venta">Fecha de Venta:</label>
        <input type="date" id="fecha_venta" name="fecha_venta" required>
        <br>
        <label for="total_ventas">Total de Ventas:</label>
        <input type="number" id="total_ventas" name="total_ventas" step="0.01" required>
        <br>
        <label for="metodo_pago">Método de Pago:</label>
        <input type="text" id="metodo_pago" name="metodo_pago" required>
        <br>
        <button type="submit">Registrar Venta</button>
    </form>
    <?php
    } else {
        // Si no hay empleados, muestra un mensaje
        echo "<p>No hay empleados registrados aún. No se puede realizar la venta.</p>";
    }
?>
    <?php
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "neve";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta para verificar si hay ventas registradas
    $query_ventas = "SELECT COUNT(*) as total_ventas FROM Ventas";
    $result_ventas = $conn->query($query_ventas);
    $row_ventas = $result_ventas->fetch_assoc();
    $total_ventas = $row_ventas['total_ventas'];

    // Consulta para verificar si hay productos registrados
    $query_productos = "SELECT COUNT(*) as total_productos FROM Productos";
    $result_productos = $conn->query($query_productos);
    $row_productos = $result_productos->fetch_assoc();
    $total_productos = $row_productos['total_productos'];

    // Cierra la conexión
    $conn->close();
?>

<!-- Formulario de Registro de Detalles de Venta -->
<form action="Reg/registrar_detallesventa.php" method="post">
    <h2>Detalles de Venta</h2>

    <?php
    if ($total_ventas > 0 && $total_productos > 0) {
        // Si hay ventas y productos, muestra los selects

       
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consulta para obtener opciones de ventas
        $query_ventas = "SELECT Venta_ID FROM Ventas";
        $result_ventas = $conn->query($query_ventas);

        // Consulta para obtener opciones de productos
        $query_productos = "SELECT Producto_ID, Nombre_Producto FROM Productos";
        $result_productos = $conn->query($query_productos);
        ?>

        <label for="venta_detallesventa">Venta:</label>
        <select id="venta_detallesventa" name="venta_detallesventa" required>
            <?php
            // Imprime las opciones de ventas
            while ($row_venta = $result_ventas->fetch_assoc()) {
                echo "<option value='" . $row_venta['Venta_ID'] . "'>Venta " . $row_venta['Venta_ID'] . "</option>";
            }
            ?>
        </select>

        <br>

        <label for="producto_detallesventa">Producto:</label>
        <select id="producto_detallesventa" name="producto_detallesventa" required>
            <?php
            // Imprime las opciones de productos
            while ($row_producto = $result_productos->fetch_assoc()) {
                echo "<option value='" . $row_producto['Producto_ID'] . "'>" . $row_producto['Nombre_Producto'] . "</option>";
            }
            ?>
        </select>
        <br>

        <label for="cantidad_detallesventa">Cantidad:</label>
        <input type="number" id="cantidad_detallesventa" name="cantidad_detallesventa" required>

        <br>

        <button type="submit">Registrar Detalles de Venta</button>
        <?php
        // Cierra la conexión
        $conn->close();
    } else {
        // Si no hay ventas o productos, muestra un mensaje
        echo "<p>No hay ventas o productos registrados aún. No se pueden registrar detalles de venta.</p>";
    }
    ?>

    
</form>

   
    </div>

    <div id="Proveedores" class="form-container">
        <!-- Formulario de Registro de Proveedor -->
    <form action="Reg/registrar_proveedor.php" method="post">
        <h2>Proveedor</h2>
        <label for="nombre_empresa">Nombre de la Empresa:</label>
        <input type="text" id="nombre_empresa" name="nombre_empresa" required>
        <br>
        <label for="contacto_proveedor">Contacto:</label>
        <input type="text" id="contacto_proveedor" name="contacto_proveedor" required>
        <br>
        <label for="telefono_proveedor">Teléfono:</label>
        <input type="text" id="telefono_proveedor" name="telefono_proveedor" required>
        <br>
        <label for="correo_proveedor">Correo Electrónico:</label>
        <input type="email" id="correo_proveedor" name="correo_proveedor" required>
        <br>
        <label for="direccion_proveedor">Dirección:</label>
        <input type="text" id="direccion_proveedor" name="direccion_proveedor" required>
        <br>
        <label for="producto_proveedor">Producto:</label>
        <input type="text" id="producto_proveedor" name="producto_proveedor" required>
        <br>
        <button type="submit">Registrar Proveedor</button>
    </form>
    <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neve";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para verificar si hay proveedores registrados
$query_proveedores = "SELECT COUNT(*) as total_proveedores FROM Proveedores";
$result_proveedores = $conn->query($query_proveedores);
$row_proveedores = $result_proveedores->fetch_assoc();
$total_proveedores = $row_proveedores['total_proveedores'];

// Cierra la conexión
$conn->close();
?>
<h2>Inventario</h2>
<!-- Formulario de Registro de Inventario -->
<?php
if ($total_proveedores > 0) {
    // Si hay proveedores, muestra el formulario de inventario
    ?>
     <form action="Reg/registrar_inventario.php" method="post">
        
        <label for="nombre_inventario">Nombre del Inventario:</label>
        <input type="text" id="nombre_inventario" name="nombre_inventario" required>
        <br>
        <label for="cantidad_inventario">Cantidad:</label>
        <input type="number" id="cantidad_inventario" name="cantidad_inventario" required>
        <br>
        <label for="fecha_ultima_act">Fecha Última Actualización:</label>
        <input type="date" id="fecha_ultima_act" name="fecha_ultima_act" required>
        <br>
        <label for="proveedor_inventario">Proveedor:</label>
        <select id="proveedor_inventario" name="proveedor_inventario" required>
            <!-- Opciones de proveedores obtenidas dinámicamente desde la base de datos -->
            <?php
            
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verifica la conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Consulta para obtener opciones de proveedores
            $query_proveedores = "SELECT Proveedor_ID, Nombre_Empresa FROM Proveedores";
            $result_proveedores = $conn->query($query_proveedores);

            // Imprime las opciones de proveedores
            while ($row_proveedor = $result_proveedores->fetch_assoc()) {
                echo "<option value='" . $row_proveedor['Proveedor_ID'] . "'>" . $row_proveedor['Nombre_Empresa'] . "</option>";
            }

            // Cierra la conexión
            $conn->close();
            ?>
        </select>
        <br>
        <button type="submit">Registrar Inventario</button>
    </form>
<?php
} else {
    // Si no hay proveedores, muestra un mensaje
    echo "<p>No hay proveedores registrados aún. No se pueden registrar inventarios.</p>";
}
?>

    <!-- Formulario de Registro de Producto -->
    <?php
// Conexión a la base de datos (reemplaza con tus datos de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neve";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para verificar si hay proveedores registrados
$query_proveedores = "SELECT COUNT(*) as total_proveedores FROM Proveedores";
$result_proveedores = $conn->query($query_proveedores);
$row_proveedores = $result_proveedores->fetch_assoc();
$total_proveedores = $row_proveedores['total_proveedores'];

// Consulta para verificar si hay inventario registrado
$query_inventario = "SELECT COUNT(*) as total_inventario FROM Inventario";
$result_inventario = $conn->query($query_inventario);
$row_inventario = $result_inventario->fetch_assoc();
$total_inventario = $row_inventario['total_inventario'];

// Cierra la conexión
$conn->close();
?>

<!-- Verifica si hay proveedores e inventario antes de mostrar el formulario -->
<?php
if ($total_proveedores > 0 && $total_inventario > 0) {
    // Si hay proveedores e inventario, muestra el formulario
    ?>

    <!-- Formulario de Registro de Producto -->
    <form action="Reg/registrar_producto.php" method="post">
        <h2>Producto</h2>

        <label for="nombre_producto">Nombre del Producto:</label>
        <input type="text" id="nombre_producto" name="nombre_producto" required>
        <br>

        <label for="descripcion_producto">Descripción:</label>
        <textarea id="descripcion_producto" name="descripcion_producto" required></textarea>
        <br>

        <label for="precio_producto">Precio:</label>
        <input type="number" id="precio_producto" name="precio_producto" required>
        <br>

        <label for="cantidad_disponible">Cantidad Disponible:</label>
        <input type="number" id="cantidad_disponible" name="cantidad_disponible" required>
        <br>

        <!-- Selección de proveedor -->
        <label for="proveedor_producto">Proveedor:</label>
        <select id="proveedor_producto" name="proveedor_producto" required>
            <?php
            // Conexión a la base de datos (reemplaza con tus datos de conexión)
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verifica la conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Consulta para obtener opciones de proveedores
            $query_proveedores = "SELECT Proveedor_ID, Nombre_Empresa FROM Proveedores";
            $result_proveedores = $conn->query($query_proveedores);

            // Imprime las opciones de proveedores
            while ($row_proveedor = $result_proveedores->fetch_assoc()) {
                echo "<option value='" . $row_proveedor['Proveedor_ID'] . "'>" . $row_proveedor['Nombre_Empresa'] . "</option>";
            }

            // Cierra la conexión
            $conn->close();
            ?>
        </select>
        <br>

        <!-- Selección de inventario -->
        <label for="inventario_producto">Inventario:</label>
        <select id="inventario_producto" name="inventario_producto" required>
            <?php
            // Conexión a la base de datos (reemplaza con tus datos de conexión)
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verifica la conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Consulta para obtener opciones de inventario
            $query_inventario = "SELECT Inventario_ID, Nombre_Inventario FROM Inventario";
            $result_inventario = $conn->query($query_inventario);

            // Imprime las opciones de inventario
            while ($row_inventario = $result_inventario->fetch_assoc()) {
                echo "<option value='" . $row_inventario['Inventario_ID'] . "'>" . $row_inventario['Nombre_Inventario'] . "</option>";
            }

            // Cierra la conexión
            $conn->close();
            ?>
        </select>
        <br>

        <button type="submit">Registrar Producto</button>
    </form>

    <?php
} else {
    // Si no hay proveedores o inventario, muestra un mensaje
    echo "<p>No hay proveedores o inventario registrados aún. No se pueden registrar productos.</p>";
}
?>
    
    </div>

    <div id="Empleado" class="form-container">
    
<!-- Formulario de Registro de Empleados -->
<form action="Reg/registrar_empleado.php" method="post">
    <h2>Empleado</h2>
    <label for="nombre_empleado">Nombre del Empleado:</label>
    <input type="text" id="nombre_empleado" name="nombre_empleado" required>
    <br>
    <label for="fecha_nacimiento_empleado">Fecha de Nacimiento:</label>
    <input type="date" id="fecha_nacimiento_empleado" name="fecha_nacimiento_empleado" required>
    <br>
    <label for="telefono_empleado">Teléfono:</label>
    <input type="text" id="telefono_empleado" name="telefono_empleado" required>
    <br>
    <label for="correo_empleado">Correo Electrónico:</label>
    <input type="email" id="correo_empleado" name="correo_empleado" required>
    <br>
    <label for="direccion_empleado">Dirección:</label>
    <input type="text" id="direccion_empleado" name="direccion_empleado" required>
    <br>
    <label for="salario_empleado">Salario:</label>
    <input type="number" id="salario_empleado" name="salario_empleado" step="0.01" required>
    <br>
    <button type="submit">Registrar Empleado</button>
</form>

    </div>
    <div id="Clientes_bajas" class="form-container">
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neve";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener la lista de clientes
$query_clientes = "SELECT Cliente_ID, Nombre, Telefono, Correo, Direccion FROM Clientes";
$result_clientes = $conn->query($query_clientes);
?>
    <h2>Clientes Registrados</h2>

    <?php
    // Verifica si hay clientes
    if ($result_clientes->num_rows > 0) {
    ?>
    <table border="1">
        <tr>
            <th>ID Cliente</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
            <th>Dirección</th>
        </tr>
        <?php
        // Imprime los datos de los clientes en la tabla
        while ($row_cliente = $result_clientes->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row_cliente['Cliente_ID'] . "</td>";
            echo "<td>" . $row_cliente['Nombre'] . "</td>";
            echo "<td>" . $row_cliente['Telefono'] . "</td>";
            echo "<td>" . $row_cliente['Correo'] . "</td>";
            echo "<td>" . $row_cliente['Direccion'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <form action="Baj/clientes_bajas.php" method="post">
        <label for="cliente_a_eliminar">Selecciona un cliente a eliminar:</label>
        <select id="cliente_a_eliminar" name="cliente_a_eliminar" required>
            <?php
            // Reinicia el puntero del resultado para mostrar en el formulario
            $result_clientes->data_seek(0);
            
            // Imprime las opciones de clientes en el formulario
            while ($row_cliente = $result_clientes->fetch_assoc()) {
                echo "<option value='" . $row_cliente['Cliente_ID'] . "'>" . $row_cliente['Nombre'] . "</option>";
            }
            ?>
        </select>
        <br>
        <button type="submit">Eliminar Cliente</button>
    </form>
    <?php
    } else {
        // Muestra un mensaje si no hay clientes
        echo "<p>No hay clientes registrados por el momento.</p>";
    }

    // Cierra la conexión
    $conn->close();
    ?>
    </div>

    <div id="Prod_bajas" class="form-container">
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neve";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener datos de productos con sus relaciones
$query_productos = "SELECT p.Producto_ID, p.Nombre_Producto, p.Descripcion, p.Precio, p.Cantidad_Disponible, 
                    pr.Nombre_Empresa AS Proveedor, i.Nombre_Inventario AS Inventario
                    FROM productos p
                    INNER JOIN proveedores pr ON p.Proveedor_ID = pr.Proveedor_ID
                    INNER JOIN inventario i ON p.Inventario_ID = i.Inventario_ID";
$result_productos = $conn->query($query_productos);

// Consulta para obtener datos de proveedores
$query_proveedores = "SELECT * FROM proveedores";
$result_proveedores = $conn->query($query_proveedores);

// Consulta para obtener datos de inventario
$query_inventario = "SELECT * FROM inventario";
$result_inventario = $conn->query($query_inventario);

// Cierra la conexión
$conn->close();
?>

<!-- Tabla de Productos -->
<table border="1">
    <thead>
        <tr>
            <th>ID Producto</th>
            <th>Nombre Producto</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad Disponible</th>
            <th>Proveedor</th>
            <th>Inventario</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row_producto = $result_productos->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row_producto['Producto_ID']}</td>";
            echo "<td>{$row_producto['Nombre_Producto']}</td>";
            echo "<td>{$row_producto['Descripcion']}</td>";
            echo "<td>{$row_producto['Precio']}</td>";
            echo "<td>{$row_producto['Cantidad_Disponible']}</td>";
            echo "<td>{$row_producto['Proveedor']}</td>";
            echo "<td>{$row_producto['Inventario']}</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<!-- Tabla de Proveedores -->
<table border="1">
    <thead>
        <tr>
            <th>ID Proveedor</th>
            <th>Nombre Empresa</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Correo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row_proveedor = $result_proveedores->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row_proveedor['Proveedor_ID']}</td>";
            echo "<td>{$row_proveedor['Nombre_Empresa']}</td>";
            echo "<td>{$row_proveedor['Direccion']}</td>";
            echo "<td>{$row_proveedor['Telefono']}</td>";
            echo "<td>{$row_proveedor['Correo']}</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<!-- Tabla de Inventario -->
<table border="1">
    <thead>
        <tr>
            <th>ID Inventario</th>
            <th>Nombre Inventario</th>
            <th>Cantidad</th>
            <th>Fecha Última Actualización</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row_inventario = $result_inventario->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row_inventario['Inventario_ID']}</td>";
            echo "<td>{$row_inventario['Nombre_Inventario']}</td>";
            echo "<td>{$row_inventario['Cantidad']}</td>";
            echo "<td>{$row_inventario['Fecha_UltimaAct']}</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<!-- Selector para eliminar Producto -->
<form action="Baj/eliminar_producto.php" method="post">
    <label for="producto_a_eliminar">Selecciona un Producto para eliminar:</label>
    <select id="producto_a_eliminar" name="producto_a_eliminar">
        <option value="" selected disabled>Selecciona un Producto</option>
        <?php
        // Conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consulta para obtener opciones de productos
        $query_productos_eliminar = "SELECT Producto_ID, Nombre_Producto FROM productos";
        $result_productos_eliminar = $conn->query($query_productos_eliminar);

        // Imprime las opciones de productos
        while ($row_producto_eliminar = $result_productos_eliminar->fetch_assoc()) {
            echo "<option value='" . $row_producto_eliminar['Producto_ID'] . "'>" . $row_producto_eliminar['Nombre_Producto'] . "</option>";
        }

        // Cierra la conexión
        $conn->close();
        ?>
    </select>
    <br>
    <button type="submit">Eliminar Producto</button>
</form>

<!-- Selector para eliminar Inventario -->
<form action="Baj/eliminar_inventario.php" method="post">
    <label for="inventario_a_eliminar">Selecciona un Inventario para eliminar:</label>
    <select id="inventario_a_eliminar" name="inventario_a_eliminar">
        <option value="" selected disabled>Selecciona un Inventario</option>
        <?php
        // Conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consulta para obtener opciones de inventario
        $query_inventario_eliminar = "SELECT Inventario_ID, Nombre_Inventario FROM inventario";
        $result_inventario_eliminar = $conn->query($query_inventario_eliminar);

        // Imprime las opciones de inventario
        while ($row_inventario_eliminar = $result_inventario_eliminar->fetch_assoc()) {
            echo "<option value='" . $row_inventario_eliminar['Inventario_ID'] . "'>" . $row_inventario_eliminar['Nombre_Inventario'] . "</option>";
        }

        // Cierra la conexión
        $conn->close();
        ?>
    </select>
    <br>
    <button type="submit">Eliminar Inventario</button>
</form>

<!-- Selector para eliminar Proveedor -->
<form action="Baj/eliminar_proveedor.php" method="post">
    <label for="proveedor_a_eliminar">Selecciona un Proveedor para eliminar:</label>
    <select id="proveedor_a_eliminar" name="proveedor_a_eliminar">
        <option value="" selected disabled>Selecciona un Proveedor</option>
        <?php
        // Conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consulta para obtener opciones de proveedores
        $query_proveedores_eliminar = "SELECT Proveedor_ID, Nombre_Empresa FROM proveedores";
        $result_proveedores_eliminar = $conn->query($query_proveedores_eliminar);

        // Imprime las opciones de proveedores
        while ($row_proveedor_eliminar = $result_proveedores_eliminar->fetch_assoc()) {
            echo "<option value='" . $row_proveedor_eliminar['Proveedor_ID'] . "'>" . $row_proveedor_eliminar['Nombre_Empresa'] . "</option>";
        }

        // Cierra la conexión
        $conn->close();
        ?>
    </select>
    <br>
    <button type="submit">Eliminar Proveedor</button>
</form>


    </div>




    <div id="Empl_bajas" class="form-container">
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neve";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener la lista de empleados
$query_empleados = "SELECT Empleado_ID, Nombre, Fecha_Nacimiento, Telefono, Correo, Direccion, Salario FROM Empleados";
$result_empleados = $conn->query($query_empleados);
?>
      <?php
    // Verifica si hay empleados
    if ($result_empleados->num_rows > 0) {
    ?>
    <table border="1">
        <tr>
            <th>ID Empleado</th>
            <th>Nombre</th>
            <th>Fecha de Nacimiento</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
            <th>Dirección</th>
            <th>Salario</th>
        </tr>
        <?php
        // Imprime los datos de los empleados en la tabla
        while ($row_empleado = $result_empleados->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row_empleado['Empleado_ID'] . "</td>";
            echo "<td>" . $row_empleado['Nombre'] . "</td>";
            echo "<td>" . $row_empleado['Fecha_Nacimiento'] . "</td>";
            echo "<td>" . $row_empleado['Telefono'] . "</td>";
            echo "<td>" . $row_empleado['Correo'] . "</td>";
            echo "<td>" . $row_empleado['Direccion'] . "</td>";
            echo "<td>" . $row_empleado['Salario'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <form action="Baj/empleados_bajas.php" method="post">
        <label for="empleado_a_eliminar">Selecciona un empleado a eliminar:</label>
        <select id="empleado_a_eliminar" name="empleado_a_eliminar" required>
            <?php
            // Reinicia el puntero del resultado para mostrar en el formulario
            $result_empleados->data_seek(0);
            
            // Imprime las opciones de empleados en el formulario
            while ($row_empleado = $result_empleados->fetch_assoc()) {
                echo "<option value='" . $row_empleado['Empleado_ID'] . "'>" . $row_empleado['Nombre'] . "</option>";
            }
            ?>
        </select>
        <br>
        <button type="submit">Eliminar Empleado</button>
    </form>
    <?php
    } else {
        // Muestra un mensaje si no hay empleados
        echo "<p>No hay empleados registrados por el momento.</p>";
    }

    // Cierra la conexión
    $conn->close();
    ?>
    </div>
    <div id="Consultav" class="form-container">
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neve";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener las ventas de clientes con información adicional
$query_ventas_clientes = "
    SELECT
        ventas.Venta_ID,
        ventas.Fecha_Venta,
        clientes.Nombre,
        productos.Nombre_Producto,
        detallesventa.Cantidad,
        detallesventa.Precio_Unitario,
        (detallesventa.Cantidad * detallesventa.Precio_Unitario) AS Monto_Total
    FROM
        ventas
    INNER JOIN clientes ON ventas.Cliente_ID = clientes.Cliente_ID
    INNER JOIN detallesventa ON ventas.Venta_ID = detallesventa.Venta_ID
    INNER JOIN productos ON detallesventa.Producto_ID = productos.Producto_ID
";

$result_ventas_clientes = $conn->query($query_ventas_clientes);

// Verifica si hay resultados
if ($result_ventas_clientes->num_rows > 0) {
    // Imprime la tabla de ventas
    echo "<h2>Ventas de Clientes</h2>";
    echo "<table border='1'>
            <tr>
                <th>Venta ID</th>
                <th>Fecha Venta</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Monto Total</th>
            </tr>";

    // Imprime los datos de cada venta
    while ($row = $result_ventas_clientes->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["Venta_ID"] . "</td>
                <td>" . $row["Fecha_Venta"] . "</td>
                <td>" . $row["Nombre"] . "</td>
                <td>" . $row["Nombre_Producto"] . "</td>
                <td>" . $row["Cantidad"] . "</td>
                <td>" . $row["Precio_Unitario"] . "</td>
                <td>" . $row["Monto_Total"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No hay ventas de clientes registradas.</p>";
}

// Cierra la conexión
$conn->close();
?>


    </div>
    <script>
        function showForm(formId) {
            // Oculta todos los formularios
            var forms = document.getElementsByClassName('form-container');
            for (var i = 0; i < forms.length; i++) {
                forms[i].classList.remove('active');
            }

            // Muestra el formulario seleccionado
            document.getElementById(formId).classList.add('active');
        }
    </script>

</body>
</html>
