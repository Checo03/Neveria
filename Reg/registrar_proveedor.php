<?php
// Verifica si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $nombre_empresa = $_POST["nombre_empresa"];
    $contacto_proveedor = $_POST["contacto_proveedor"];
    $telefono_proveedor = $_POST["telefono_proveedor"];
    $correo_proveedor = $_POST["correo_proveedor"];
    $direccion_proveedor = $_POST["direccion_proveedor"];
    $producto_proveedor = $_POST["producto_proveedor"];

    // Consulta SQL para insertar en la tabla de proveedores
    $query = "INSERT INTO Proveedores (Nombre_Empresa, Contacto, Telefono, Correo, Direccion, Producto) 
              VALUES ('$nombre_empresa', '$contacto_proveedor', '$telefono_proveedor', '$correo_proveedor', '$direccion_proveedor', '$producto_proveedor')";

    // Ejecuta la consulta y verifica si fue exitosa
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Proveedor registrado exitosamente.'); window.location.href = '../index.php';</script>";
        
    } else {
        echo "<script>alert('Error al registrar el proveedor´.'); window.location.href = '../index.php';</script>";
        $conn->error;
    }

    // Cierra la conexión
    $conn->close();
} else {
    // Si no se recibieron los datos por POST, redirige al formulario
    header("Location: ../index.php");
    exit();
}
?>
