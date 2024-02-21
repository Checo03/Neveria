<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neve";

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se seleccionó un inventario para eliminar
    if (isset($_POST["inventario_a_eliminar"]) && !empty($_POST["inventario_a_eliminar"])) {
        $inventario_id = $_POST["inventario_a_eliminar"];

        // Conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Elimina el inventario
        $query_eliminar_inventario = "DELETE FROM inventario WHERE Inventario_ID = $inventario_id";

        if ($conn->query($query_eliminar_inventario) === TRUE) {
            echo "<script>alert('Inventario eliminado exitosamente'.); window.location.href = '../index.php';</script>";
        
        } else {
            echo "<script>alert('Error al eliminar el inventario:'); window.location.href = '../index.php';</script>";
            $conn->error;
        }

        // Cierra la conexión
        $conn->close();
    } else {
        echo "<script>alert('Por favor, selecciona un inventario para eliminar.'); window.location.href = '../index.php';</script>";
        
    }
} else {
    echo "<script>alert('Acceso no autorizado.'); window.location.href = '../index.php';</script>";
    
}
?>
