<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neve";

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se seleccionó un producto para eliminar
    if (isset($_POST["producto_a_eliminar"]) && !empty($_POST["producto_a_eliminar"])) {
        $producto_id = $_POST["producto_a_eliminar"];

        // Conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Elimina el producto
        $query_eliminar_producto = "DELETE FROM productos WHERE Producto_ID = $producto_id";

        if ($conn->query($query_eliminar_producto) === TRUE) {
            echo "<script>alert('Producto eliminado exitosamente.'); window.location.href = '../index.php';</script>";
            
        } else {
            echo "<script>alert('Error al eliminar el producto: '); window.location.href = '../index.php';</script>";
            $conn->error;
        }

        // Cierra la conexión
        $conn->close();
    } else {
        echo "<script>alert('Por favor, selecciona un producto para eliminar.'); window.location.href = '../index.php';</script>";
       
    }
} else {
    echo "<script>alert('Acceso no autorizado.'); window.location.href = '../index.php';</script>";
  
}
?>
