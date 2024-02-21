<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neve";

// Verifica si se ha enviado un cliente para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cliente_a_eliminar'])) {
    $cliente_id_eliminar = $_POST['cliente_a_eliminar'];

    // Conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtén las ventas asociadas al cliente
    $query_ventas_cliente = "SELECT Venta_ID FROM ventas WHERE Cliente_ID = $cliente_id_eliminar";
    $result_ventas_cliente = $conn->query($query_ventas_cliente);

    if ($result_ventas_cliente->num_rows > 0) {
        while ($row_venta = $result_ventas_cliente->fetch_assoc()) {
            // Elimina los detalles de venta asociados a cada venta
            $venta_id_eliminar = $row_venta['Venta_ID'];
            $query_eliminar_detalles = "DELETE FROM detallesventa WHERE Venta_ID = $venta_id_eliminar";
            $result_eliminar_detalles = $conn->query($query_eliminar_detalles);

            if (!$result_eliminar_detalles) {
                echo "Error al eliminar detalles de venta.";
                $conn->close();
                exit;
            }
        }
    }

    // Ahora, elimina las ventas asociadas al cliente
    $query_eliminar_ventas = "DELETE FROM ventas WHERE Cliente_ID = $cliente_id_eliminar";
    $result_eliminar_ventas = $conn->query($query_eliminar_ventas);

    if ($result_eliminar_ventas) {
        // Finalmente, elimina al cliente
        $query_eliminar_cliente = "DELETE FROM clientes WHERE Cliente_ID = $cliente_id_eliminar";
        $result_eliminar_cliente = $conn->query($query_eliminar_cliente);

        // Cierra la conexión
        $conn->close();

        if ($result_eliminar_cliente) {
            echo "<script>alert('Cliente y sus ventas asociadas eliminados correctamente.'); window.location.href = '../index.php';</script>";
           
        } else {
            echo "<script>alert('Error al eliminar el cliente.'); window.location.href = '../index.php';</script>";
            
        }
    } else {
        echo "<script>alert('Error al eliminar las ventas asociadas al cliente.'); window.location.href = '../index.php';</script>";
        
    }
} else {
    echo "<script>alert('No se proporcionó un cliente para eliminar.'); window.location.href = '../index.php';</script>";
    
}
?>
