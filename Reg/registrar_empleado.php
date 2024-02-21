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
$nombre_empleado = $_POST['nombre_empleado'];
$fecha_nacimiento_empleado = $_POST['fecha_nacimiento_empleado'];
$telefono_empleado = $_POST['telefono_empleado'];
$correo_empleado = $_POST['correo_empleado'];
$direccion_empleado = $_POST['direccion_empleado'];
$salario_empleado = $_POST['salario_empleado'];

// Inserta los datos en la tabla Empleados
$sql = "INSERT INTO Empleados (Nombre, Fecha_Nacimiento, Telefono, Correo, Direccion, Salario)
        VALUES ('$nombre_empleado', '$fecha_nacimiento_empleado', '$telefono_empleado', '$correo_empleado', '$direccion_empleado', $salario_empleado)";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Empleado registrado con éxito'); window.location.href = '../index.php';</script>";
    
} else {
    echo "<script>alert('Error al registrar el empleado:'); window.location.href = '../index.php';</script>";
    $conn->error;
}

// Cierra la conexión
$conn->close();
?>
