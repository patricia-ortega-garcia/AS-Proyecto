<?php
include("config.php");
session_start();

// Verificar si el usuario está autenticado; si no, redirigirlo a la página de inicio de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $telefono = $_POST["telefono"];
    $fechaNacimiento = $_POST["fecha_nacimiento"];
    $email = $_POST["email"];
    $usuario = $_POST["username"];
    $contrasena = $_POST["password"];


    // Actualiza los datos en la base de datos
    $dni = $_SESSION['DNI'];
    $actualizarDatos = "UPDATE Usuario SET Nombre='$nombre', Apellidos='$apellidos', Telefono='$telefono', FechaNacimiento='$fechaNacimiento', Email='$email', Usuario='$usuario', Contrasena='$contrasena' WHERE DNI='$dni'";
    
    if (mysqli_query($conn, $actualizarDatos)) {
        // Datos actualizados con éxito
        header("Location: ajustes_cuenta.php?success=Datos actualizados correctamente");
        exit();
    } else {
        // Error al actualizar los datos
        header("Location: ajustes_cuenta.php?error=Error al actualizar los datos");
        exit();
    }
} else {
    // Si no es una solicitud POST, redirige al usuario a la página de ajustes_cuenta.php
    header("Location: ajustes_cuenta.php");
    exit();
}
?>
