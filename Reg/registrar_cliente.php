<?php
// Conexión a la base de datos (debes tener tus propios datos de conexión)
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
$nombre_cliente = $_POST['nombre_cliente'];
$telefono_cliente = $_POST['telefono_cliente'];
$correo_cliente = $_POST['correo_cliente'];
$direccion_cliente = $_POST['direccion_cliente'];

// Inserta datos en la tabla de Clientes
$sql = "INSERT INTO Clientes (Nombre, Telefono, Correo, Direccion) VALUES ('$nombre_cliente', '$telefono_cliente', '$correo_cliente', '$direccion_cliente')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Cliente registrado exitosamente'); window.location.href = '../index.php';</script>";
    
} else {
   
    echo "<script>alert('Error al registrar cliente:'); window.location.href = '../index.php';</script>";
    $conn->error;
}

// Cierra la conexión
$conn->close();
?>
