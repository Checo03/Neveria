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

// Recibe los datos del formulario
$venta_id = $_POST['venta_detallesventa'];
$producto_id = $_POST['producto_detallesventa'];
$cantidad = $_POST['cantidad_detallesventa'];

// Obtén el precio unitario del producto
$query_precio_unitario = "SELECT Precio, Cantidad_Disponible FROM Productos WHERE Producto_ID = ?";
$stmt = $conn->prepare($query_precio_unitario);
$stmt->bind_param("i", $producto_id);
$stmt->execute();
$result_precio_unitario = $stmt->get_result();

if ($result_precio_unitario->num_rows > 0) {
    $row_precio_unitario = $result_precio_unitario->fetch_assoc();
    $precio_unitario = $row_precio_unitario['Precio'];
    $existencias_disponibles = $row_precio_unitario['Cantidad_Disponible'];

    // Verifica si hay suficientes existencias
    if ($existencias_disponibles >= $cantidad) {
        // Calcula el total
        $total = $cantidad * $precio_unitario;

        // Inserta los detalles de la venta en la tabla DetallesVenta
        $query_insert = "INSERT INTO DetallesVenta (Venta_ID, Producto_ID, Cantidad, Precio_Unitario) 
                         VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($query_insert);
        $stmt_insert->bind_param("iiid", $venta_id, $producto_id, $cantidad, $precio_unitario);

        if ($stmt_insert->execute()) {
            // Actualiza la cantidad disponible en el inventario
            $nueva_existencia = $existencias_disponibles - $cantidad;
            $query_actualizar_inventario = "UPDATE Productos SET Cantidad_Disponible = ? WHERE Producto_ID = ?";
            $stmt_actualizar_inventario = $conn->prepare($query_actualizar_inventario);
            $stmt_actualizar_inventario->bind_param("ii", $nueva_existencia, $producto_id);
            
            if ($stmt_actualizar_inventario->execute()) {
                echo "<script>alert('Detalle de la Venta registrado exitosamente'); window.location.href = '../index.php';</script>";
            } else {
                echo "<script>alert('Error al actualizar el inventario: '); window.location.href = '../index.php';</script>";
            }
        } else {
            echo "<script>alert('Error al registrar detalles de venta:'); window.location.href = '../index.php';</script>";
        }
    } else {
        echo "<script>alert('No hay suficientes existencias para la venta.'); window.location.href = '../index.php';</script>";
    }
} else {
    echo "<script>alert('Error al obtener el precio unitario del producto: '); window.location.href = '../index.php';</script>";
}

// Cierra la conexión
$stmt->close();
$stmt_insert->close();
$stmt_actualizar_inventario->close();
$conn->close();
?>
