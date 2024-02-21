<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neve";

// Verifica si se ha enviado un empleado para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['empleado_a_eliminar'])) {
    $empleado_id_eliminar = $_POST['empleado_a_eliminar'];

    // Conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Elimina al empleado seleccionado
    $query_eliminar_empleado = "DELETE FROM Empleados WHERE Empleado_ID = $empleado_id_eliminar";
    $result_eliminar_empleado = $conn->query($query_eliminar_empleado);

    // Cierra la conexión
    $conn->close();

    if ($result_eliminar_empleado) {
        echo "<script>alert('Empleado eliminado correctamente.'); window.location.href = '../index.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el empleado.'); window.location.href = '../index.php';</script>";
        
    }
} else {
    echo "<script>alert('No se proporcionó un empleado para eliminar.'); window.location.href = '../index.php';</script>";
}
?>
