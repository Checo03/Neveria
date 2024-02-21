<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neve";

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se seleccionó un proveedor para eliminar
    if (isset($_POST["proveedor_a_eliminar"]) && !empty($_POST["proveedor_a_eliminar"])) {
        $proveedor_id = $_POST["proveedor_a_eliminar"];

        // Conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Elimina el proveedor
        $query_eliminar_proveedor = "DELETE FROM proveedores WHERE Proveedor_ID = $proveedor_id";

        if ($conn->query($query_eliminar_proveedor) === TRUE) {
            echo "<script>alert('Proveedor eliminado exitosamente.'); window.location.href = '../index.php';</script>";
            
        } else {
            echo "<script>alert('Error al eliminar el proveedor:'); window.location.href = '../index.php';</script>";
           $conn->error;
        }

        // Cierra la conexión
        $conn->close();
    } else {
        echo "<script>alert('Por favor, selecciona un proveedor para eliminar.'); window.location.href = '../index.php';</script>";
        
    }
} else {
    echo "<script>alert('Acceso no autorizado.'.); window.location.href = '../index.php';</script>";
    
}
?>
