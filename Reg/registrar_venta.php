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

// Recibe datos del formulario
$cliente_venta = $_POST['cliente_vesnta'];
$empleado_venta = $_POST['empleado_venta'];
$fecha_venta = $_POST['fecha_venta'];
$total_ventas = $_POST['total_ventas'];
$metodo_pago = $_POST['metodo_pago'];

// Inserta datos en la tabla de Ventas
$sql = "INSERT INTO Ventas (Cliente_ID, Empleado_ID, Fecha_Venta, Total_Ventas, Metodo_Pago) 
        VALUES ('$cliente_venta', '$empleado_venta', '$fecha_venta', '$total_ventas', '$metodo_pago')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Venta registrado exitosamente'); window.location.href = '../index.php';</script>";
} else {
    echo "<script>alert('Error al registrar venta:'$conn->error); window.location.href = '../index.php';</script>";
}

// Cierra la conexión
$conn->close();
?>


