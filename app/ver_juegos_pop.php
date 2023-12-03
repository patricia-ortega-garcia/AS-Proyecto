<?php
// Incluir archivo de configuración y verificar la sesión del usuario (debes implementar la lógica de autenticación)
include("config.php");
session_start();

// Verificar la sesión del usuario
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php"); // Redirigir a la página de inicio de sesión si el usuario no está autenticado
    exit();
}

// Archivo a leer
$ruta_archivo = "./mas_populares.txt";
if (file_exists($ruta_archivo)) {
    $lineas = file($ruta_archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    $lineas = array("No se han podido obtener los juegos más populares del año");
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
        <h2>Juegos maś populares del último año</h2>
        <pre>     </pre>
        <ul>
            <?php foreach ($lineas as $linea): ?>
                <li><?php echo htmlspecialchars($linea); ?></li>
            <?php endforeach; ?>
        </ul>
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