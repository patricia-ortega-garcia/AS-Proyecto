<?php
// Incluir archivo de configuración y verificar la sesión del usuario (debes implementar la lógica de autenticación)
include("config.php");
session_start();

// Verificar la sesión del usuario (debes implementar esta lógica)
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php"); // Redirigir a la página de inicio de sesión si el usuario no está autenticado
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- Agrega tu archivo CSS personalizado aquí -->
    <title>Goodgames</title>
</head>
<body>
    <header>
        <h1>Goodgames</h1>
    </header>
    <main>
        <h2>Estadísticas de Videojuegos</h2>
        <pre>     </pre>
        <p style="text-align:center;"><img src="./imagenes/frecuencia_generos.png" alt="Gráfico de Géneros de Videojuegos" width=90% height=auto></p>
    </main>
    <main>
        <div class="button-container">
            <button class="button secondary-button" onclick="window.location.href='principal.php'">Volver a Juegos</button>
            <pre>     </pre>
            <button class="button secondary-button" onclick="window.location.href='cerrar_sesion.php'">Cerrar Sesión</button>
        </div>
    </main>
</body>
</html>