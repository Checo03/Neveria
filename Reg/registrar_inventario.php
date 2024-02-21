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
$nombre_inventario = $_POST['nombre_inventario'];
$cantidad_inventario = $_POST['cantidad_inventario'];
$fecha_ultima_act = $_POST['fecha_ultima_act'];
$proveedor_inventario = $_POST['proveedor_inventario'];

// Inserta los datos en la tabla Inventario
$sql = "INSERT INTO Inventario (Nombre_Inventario, Cantidad, Fecha_UltimaAct, Proveedor_ID)
        VALUES ('$nombre_inventario', $cantidad_inventario, '$fecha_ultima_act', $proveedor_inventario)";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Inventario registrado con éxito'); window.location.href = '../index.php';</script>";
    
} else {
    echo "<script>alert('Error al registrar el inventario:'); window.location.href = '../index.php';</script>";
     $conn->error;
}

// Cierra la conexión
$conn->close();
?>
