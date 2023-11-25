<?php
include "conexion.php";

// Variable para indicar si el correo electrónico está registrado
$emailAlreadyExists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $firstname = $_POST["name_name"];
    $lastname = $_POST["name_lastname"];
    $email = $_POST["name_email"];
    $password = ($_POST["name_password"]); 
    $birthdate = $_POST["name_birthdate"];
    $genre = $_POST["name_genre"];
    $emailSubscription = isset($_POST["name_email_subscription"]) ? 1 : 0;

    // Validar los datos si es necesario

    // Verificar si el correo ya está registrado
    $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conexion->query($emailCheckQuery);

    if ($result->num_rows > 0) {
        // El correo ya está registrado
        $emailAlreadyExists = true;
    } else {
        // Insertar en la base de datos
        $sql = "INSERT INTO users (firstname, lastname, email, user_password, birthdate, genre) VALUES ('$firstname', '$lastname', '$email', '$password', '$birthdate', '$genre')";

        if ($conexion->query($sql) == TRUE) {
            echo "Usuario registrado con éxito";
            // Aquí podrías redirigir al usuario a una página de éxito o hacer otras operaciones necesarias después del registro.
        } else {
            echo "Error al registrar el usuario: " . $conexion->error;
        }
    }
}

$conexion->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Agregar referencia a Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="index.php">
            <img src="images/LogoNav.png" alt="" width="40%" height="30%">
          </a>
        </div>
      </nav>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
<body style="background-color: rgb(223, 223, 223)">
    <div class="container mt-5 Contenedor">

        <div class="row ">
            <div class="col-md-4 col-sm-12 slogan">
                <h1>Crear Cuenta</h1>
                <br>
                <h4>Datos personales</h4>
            </div>
            <div class="col-md-8 col-sm-12 registro">
                <form  method="POST" enctype="multipart/form-data"  class="registro_form">
                    
                    <h2 class="mb-4">Ingresa tus datos</h2>
                    <div class="form-group">
                        <label for="id_name"></label>
                        <input type="text" class="dato" id="id_name" name="name_name" placeholder="Nombre(s)"required>
                    </div>
                    <div>
                        <label for="id_lastname"></label>
                        <input type="text" class="dato" id="id_lastname" name="name_lastname" placeholder = "Apellido(s)" required>
                    </div>
                    <div class="form-group">
    <label for="id_email"></label>
    <input type="email" class="dato" id="id_email" name="name_email" placeholder="Correo" required>
    <?php if ($emailAlreadyExists): ?>
        <p id="id_email_validation" style="color: red; font-weight: bold;">El correo electrónico ya está registrado.</p>
    <?php endif; ?>
</div>
                    <div class="form-group">
                        <label for="id_password"></label>
                        <input type="password" class="dato" id="id_password" placeholder="Contraseña" name="name_password" required>
                    </div>
                    <div id="id_pass_req" hidden>
                        <p  >La contraseña debe contener lo siguiente:</p>
                        <ul >
                            <li id="id_req_length">8 caracteres</li>
                            <li id="id_req_upper">Una mayúscula</li>
                            <li id="id_req_lower">Una minúscula</li>
                            <li id="id_req_number">Un número</li>
                            <li id="id_req_special">Un carácter especial</li>
                        </ul>
                    </div>                                                 
                    <div class="form-group">
                        <label for="id_birthdate"></label>
                        <input type="date" class="dato" id="id_birthdate" name="name_birthdate" placeholder="Fecha de Nacimiento " required>
                    </div>
                    <div class="form-group">
                        <label for="id_genre"></label>
                        <select class="dato" id="id_genre" name="name_genre" required>
                            <option disabled selected>Género</option>
                            <option value="0" class="opcion">Femenino</option>
                            <option value="1" class="opcion">Masculino</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="checkbox" id="id_email_subscription" name="name_email_subscription" >
                        <label class="information" for="id_email_subscription">Recibir ofertas de nosotros a su correo electrónico.</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="name_terms_and_conditions" id="id_terms_and_conditions" required>
                        <label class="information" for="id_terms_and_conditions">Acepto los términos y condiciones y la política de privacidad</label>
                    </div>
                    <br>
                    <p class="information">*Para finalizar tu registro completo es necesario que ingreses a tu cuenta, seccion de direcciones y agregues una dirección</p>
                    <br>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn_register" id="id_registerSubmit">Confirmar</button>
                    </div>
                    <br><br>
                    <span>¿Ya tienes una cuenta? &nbsp;</span>
                    <a href="login.php" style="color: white;">Inicia Sesión</a>

                </form>
            </div>
        </div>

    </div>
    <script src="javascript/jquery-3.7.1.min.js"></script>
    <script src="javascript/register.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>
</html>
