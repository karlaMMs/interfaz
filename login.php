<?php
include "conexion.php";
session_start(); // Inicia la sesión si no está iniciada

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén las credenciales del formulario
    $email = $_POST["username"];
    $password = $_POST["password"];

    // Consulta para verificar las credenciales
    $query = "SELECT id_user FROM users WHERE email = '$email' AND user_password = '$password'";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        $num_rows = mysqli_num_rows($result);
        if ($num_rows == 1) {
            // Usuario autenticado correctamente
            $user_data = mysqli_fetch_assoc($result);
            $_SESSION['id_user'] = $user_data['id_user']; // Guarda el id_user en la sesión
            echo '<script>alert("Inicio de sesión exitoso");</script>';
            header("Location: index.php");
            exit();
        } else {
            // Usuario no autenticado, muestra alerta y redirige a la página de inicio de sesión
            echo '<script>alert("Nombre de usuario o contraseña incorrectos");</script>';
            header("Location: login.php");
            exit();
        }
    } else {
        // Manejo de errores, puedes personalizar según tus necesidades
        echo "Error en la consulta: " . mysqli_error($conexion);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Agregar la referencia a Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="index.html">
            <img src="images/LogoNav.png" alt="" width="40%" height="30%">
          </a>
        </div>
      </nav>
    <div class="container mt-5 ">
        <div class="row justify-content-center ">
            <div class="col-md-6 col-sm-12 Contenedor">
                <form class="mx-5" method="post" id="form_login" name="form_login" >
                    <h1 class="mb-4">Iniciar Sesión</h1>
                    <div class="form-group">
                        <label for="username"></label>
                        <input type="text" id="username" name="username" class="dato"  placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password"></label>
                        <input type="password" id="password" name="password" class="dato" placeholder="Contraseña" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn_login">Ingresar</button>
                    <br><br>
                    <span>¿Aún no tienes una cuenta? &nbsp;</span>
                    <a href="register.php">Registrate Aquí</a>
                </form>
            </div>
            
        </div>
    </div>
    <script src="javascript/jquery-3.7.1.min.js"></script>
    <script src="javascript/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
