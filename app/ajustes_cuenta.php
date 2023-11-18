<?php
// Incluir archivo de configuración y verificar la sesión del usuario (debes implementar la lógica de autenticación)
include("config.php");
session_start();

// Verificar la sesión del usuario (debes implementar esta lógica)
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php"); // Redirigir a la página de inicio de sesión si el usuario no está autenticado
    exit();
}

// Recuperar información del usuario desde la base de datos (debes implementar esta lógica)
$usuario = $_SESSION["usuario"];
$dni = $_SESSION["dni"];
$sql = "SELECT * FROM usuarios WHERE usuario = ? AND dni = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $usuario, $dni);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$datosUsuario = mysqli_fetch_assoc($resultado);
$nm = $datosUsuario["nombre"];
$ap = $datosUsuario["apellidos"];
$tlf = $datosUsuario["telefono"];
$em = $datosUsuario["email"];
$fn = $datosUsuario["fecha_nacimiento"];

if ($resultado) {
    $datosUsuario = mysqli_fetch_assoc($resultado);
    print_r($datosUsuario); // Imprime los datos del usuario para depuración
} else {
    echo "Error al recuperar la información del usuario: " . mysqli_error($conn);
}


mysqli_stmt_close($stmt);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $telefono = $_POST["telefono"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $email = $_POST["email"];
    $usuario = $_POST["username"];
    $password = $_POST["password"];
    $actual=$_SESSION["dni"];

    $nombresql="UPDATE usuarios SET nombre='$nombre' WHERE dni='$actual' ";
    $apellidossql="UPDATE usuarios SET apellidos='$apellidos' WHERE dni='$actual' ";
    $telefonosql="UPDATE usuarios SET telefono='$telefono' WHERE dni='$actual' ";
    $fechasql="UPDATE usuarios SET fecha_nacimiento='$fecha_nacimiento' WHERE dni='$actual' ";
    $emailsql="UPDATE usuarios SET email='$email' WHERE dni='$actual' ";
    $usuariosql="UPDATE usuarios SET usuario='$usuario' WHERE dni='$actual' ";
    $contrasenasql="UPDATE usuarios SET contrasena='$password' WHERE dni='$actual' ";

    if(!empty($usuario)){
        $ejecutar1=mysqli_query($conn,$usuariosql);
        if($ejecutar1){
        /*Cerrar sesion*/
          $_SESSION['usuario']=$usuario;
          ?> 
          <h3 class="bien">¡Nombre de usuario modificado correctamente!</h3>
            <?php
        }
    }
    
    if(!empty($nombre)){
        $ejecutar2=mysqli_query($conn,$nombresql);
        if($ejecutar2){
          ?> 
          <h3 class="bien">¡Nombre modificado correctamente!</h3>
            <?php
        }
    }
    
    if(!empty($apellidos)){
        $ejecutar7=mysqli_query($conn,$apellidossql);
        if($ejecutar7){
          ?> 
          <h3 class="bien">¡Apellido modificado correctamente!</h3>
            <?php
        }
    }

    if(!empty($telefono)){
      $ejecutar3=mysqli_query($conn,$telefonosql);
      if($ejecutar3){
        ?> 
        <h3 class="bien">¡Telefono modificado correctamente!</h3>
          <?php
      }
    }

    if(!empty($fecha_nacimiento)){
      $ejecutar4=mysqli_query($conn,$fechasql);
      if($ejecutar4){
        ?> 
        <h3 class="bien">¡Fecha modificada correctamente!</h3>
          <?php
      }
    }

    if(!empty($email)){
      $ejecutar5=mysqli_query($conn,$emailsql);
      if($ejecutar5){
        ?> 
              <h3 class="bien">¡Email modificado correctamente!</h3>
                <?php
      }
    }

    if(!empty($password)){
      $ejecutar6=mysqli_query($conn,$contrasenasql);
      if($ejecutar6){
        ?> 
              <h3 class="bien">¡Contraseña modificada correctamente!</h3>
                <?php
      }
    }

    /*
    // Actualiza la información del usuario en la base de datos (debes implementar esta lógica)
    $sql = "UPDATE usuarios SET nombre=?, apellidos=?, dni=?, telefono=?, fecha_nacimiento=?, email=?, contrasena=? WHERE dni=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", $nombre, $apellidos, $dni, $telefono, $fechaNacimiento, $email, $contrasena, $dni);

    if (mysqli_stmt_execute($stmt)) {
        // Redirige al usuario a la página de perfil actualizada
        header("Location: ajustes_cuenta.php");
        exit();
    } else {
        echo "Error al actualizar la información del usuario: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    */
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="./script.js"></script>
    <title>Goodgames</title>
</head>
<body>
    <header>
        <h1>Goodgames</h1>
    </header>
    <main>
        <section>
            <h2>¡Bienvenido <?php echo $_SESSION['usuario']?>!</h2>
            <h3>Información a cambiar: </h3>

            <form id="ajustes-form" action="ajustes_cuenta.php" method="POST" onsubmit="return modificarUsuario();">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="<?php echo $nm; ?>"><br>

                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" placeholder="<?php echo $ap; ?>"><br>

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" placeholder="<?php echo $tlf; ?>"><br>

                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="<?php echo $fn; ?>"><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="<?php echo $em; ?>"><br>

                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username"><br>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password"><br>


                <button class="button secondary-button" type="submit">Guardar Cambios</button>
            </form>
        </section>
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

<?php
/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $telefono = $_POST["telefono"];
    $fechaNacimiento = $_POST["fecha_nacimiento"];
    $email = $_POST["email"];
    $usuario = $_POST["username"];
    $contrasena = $_POST["password"];


    
    // Verifica la conexión
    if (!$conn) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

    // Crea la consulta SQL para insertar el nuevo usuario en la tabla
    //$sql = "INSERT INTO usuarios (nombre, apellidos, dni, telefono, fecha_nacimiento, email, usuario, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $sql = "UPDATE INTO usuarios SET nombre=?, apellidos=?, telefono=?, fecha_nacimiento=?, email=?, usuario=?, contrasena=? WHERE ";

    // Prepara la consulta SQL
    $stmt = mysqli_prepare($conn, $sql);

    //Verificar que la función 'mysqli_prepare' haya tenido éxito
    if (!$stmt) {
        die("Error al preparar la consulta SQL: " . mysqli_error($conn));
    }

    // Asocia los parámetros con los valores
    mysqli_stmt_bind_param($stmt, "ssssssss", $nombre, $apellidos, $dni, $telefono, $fechaNacimiento, $email, $usuario, $contrasena);

    // Ejecuta la consulta SQL
    if (mysqli_stmt_execute($stmt)) {
        //echo "Registro exitoso. ¡Bienvenido, $nombre!";
        session_start();
        $_SESSION["usuario"] = $usuario;
        $_SESSION["dni"] = $dni;
        header("Location: principal.php");
        exit();
    } else {
        //echo "Error al registrar el usuario: " . mysqli_error($conn);
    }

    // Cierra la conexión y la declaración
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
*/
?>
