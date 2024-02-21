<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neve";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe datos del formulario
    $nombre_producto = $_POST["nombre_producto"];
    $descripcion_producto = $_POST["descripcion_producto"];
    $precio_producto = $_POST["precio_producto"];
    $cantidad_disponible = $_POST["cantidad_disponible"];
    $proveedor_producto = $_POST["proveedor_producto"];
    $inventario_producto = $_POST["inventario_producto"];

    // Conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta para insertar datos en la tabla de productos
    $sql = "INSERT INTO Productos (Nombre_Producto, Descripcion, Precio, Cantidad_Disponible, Proveedor_ID, Inventario_ID) VALUES ('$nombre_producto', '$descripcion_producto', '$precio_producto', '$cantidad_disponible', '$proveedor_producto', '$inventario_producto')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Producto registrado con éxito.'); window.location.href = '../index.php';</script>";
        
    } else {
        echo "<script>alert('Error al registrar el producto:); window.location.href = '../index.php';</script>";
        $conn->error;
    }

    // Cierra la conexión
    $conn->close();
}
?>
