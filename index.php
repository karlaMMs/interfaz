<?php
include "conexion.php";
session_start(); // Inicia la sesión si no está iniciada

// Realizar la consulta a la base de datos
$sql = "SELECT * FROM producto";
$result = $conexion->query($sql);

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];

    // Obtener el nombre del usuario desde la base de datos (asumiendo que tienes una tabla de usuarios relacionada con productos)
    $query = "SELECT firstname FROM users WHERE id_user = '$id_user'";
    $user_result = $conexion->query($query);

    if ($user_result) {
        $user_data = $user_result->fetch_assoc();
        $nombre_usuario = $user_data['firstname'];

        // Muestra el alert en JavaScript
        echo "<script>alert('¡Hola $nombre_usuario!');</script>";

        // Resto del código de index.php
    } else {
        // Manejo de errores, puedes personalizar según tus necesidades
        echo "Error en la consulta de usuario: " . $conexion->error;
    }
}

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <div class="container my-2 justify-content-center">
        <div class="row">
            <div class="col-md-3 my-auto d-none d-md-block d-lg-block d-xl-block">
                <a class="navbar-brand" href="index.php">
                    <img src="images/LogoNav.png" alt="" width="40%" height="30%">
                </a>
            </div>
            <div class="col-md-6 ">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn" type="submit">BUSCAR</button>
                </form>
            </div>
            <div class="col-md-3">
                <?php
                if (isset($_SESSION['id_user'])) {
                    // Si el usuario ha iniciado sesión, muestra su nombre y un botón de cerrar sesión
                    echo "<div class='d-flex align-items-center'>";
                    echo "<a href='perfil.php' class='me-2'><button class='btn' type='button'>¡Hola, $nombre_usuario!</button></a>";
                    echo "<a href='logout.php' class='me-2'><button class='btn' type='button'> Cerrar Sesión</button>
                    </a>";
                    echo "</div>";
                    
                } else {
                    // Si el usuario no ha iniciado sesión, muestra los botones para registrarse e iniciar sesión
                    echo "<a href='register.php'><button class='btn' type='button'>CREA TU CUENTA</button></a>";
                    echo "<a href='login.php'><button class='btn' type='button'>INGRESA</button></a>";
                }
                ?>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-md navbar-light " >
        <div class="container-fluid justify-content-center mb-2" style="background-color: #ABC684;">
            <div class="row">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">HIGH PRO EXPERTS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">PC'S LEGA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">PRODUCTOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">COMPONENTES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">ACCESORIOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">CONTACTO</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid justify-content-center my-4">
        <div class="row">
            <div class="col-3 d-flex justify-content-center">
                <div class="">
                    <div class="d-flex justify-content-center">
                        <i class="fa fa-truck"></i>
                    </div>
                    <div class="text-center">
                        <h3>
                            Envío Express
                        </h3>
                        <p>A toda la República Mexicana</p>
                    </div>
                </div>
            </div>
            <div class="col-3 d-flex justify-content-center">
                <div class="">
                    <div class="d-flex justify-content-center">
                        <i class="fa fa-check-square"></i>
                    </div>
                    <div class="text-center">
                        <h3>
                            Ensamblaje profesional
                        </h3>
                        <p>Hecho por expertos</p>
                    </div>
                </div>
            </div>
            <div class="col-3 d-flex justify-content-center">
                <div class="">
                    <div class="d-flex justify-content-center">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <div class="text-center">
                        <h3>
                            Pagos
                        </h3>
                        <p>Pagos 100% seguros</p>
                    </div>
                </div>
            </div>
            <div class="col-3 d-flex justify-content-center">
                <div class="">
                    <div class="d-flex justify-content-center">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="text-center">
                        <h3>
                            Soporte online
                        </h3>
                        <p>Atención en línea</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
        <h3 style="text-align: center;">Ofertas</h3>

        </div>
        <br>
        <?php
// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Iniciar una fila
    echo "<div class='row'>";

    // Iterar sobre los resultados y mostrar la información en tarjetas
    while ($row = $result->fetch_assoc()) {
        echo "<div class='col'>";
        echo "<div class='card' style='width: 18rem;'>";
        if (isset($_SESSION['id_user'])) {
            echo "<a href='pagina_producto.php?id=" . $row['id'] . "&user_id=" . $_SESSION['id_user'] . "'>";

        }else{
            echo "<a href='pagina_producto.php?id=" . $row['id'] . "'>"; 
        }
        echo "<img src='" . $row['imagen'] . "' class='card-img-top img-hover' alt='" . $row['nombre'] . "' style='width: 200px; height: 200px; object-fit: cover;'>";
        echo "</a>";
        echo "<div class='card-body'>";
        echo "<p class='card-text'>" . $row['nombre'] . "</p>";
        echo "<p class='card-text'>" . number_format($row['precio'], 2) . "</p>";
        echo "</div></div></div>";
    }

    // Cerrar la fila
    echo "</div>";
} else {
    echo "No se encontraron productos.";
}
?>


            
    </div>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

<style>
    .img-hover {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border: 2px solid transparent; /* Borde transparente por defecto */
    }

    .img-hover:hover {
        transform: scale(1.1);
        width: auto;
        height: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-color: #92D92D; /* Cambia el color del borde al pasar el mouse */
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener todas las imágenes con la clase img-hover
        var imgHoverElements = document.querySelectorAll('.img-hover');

        // Agregar un listener para cada imagen
        imgHoverElements.forEach(function(img) {
            img.addEventListener('mouseout', function() {
                // Restablecer el tamaño original y quitar la sombra y el borde al quitar el mouse
                img.style.transform = 'scale(1)';
                img.style.width = '200px'; // O el tamaño deseado
                img.style.height = '200px'; // O el tamaño deseado
                img.style.boxShadow = 'none';
                img.style.borderColor = 'transparent'; // Restablecer el color del borde
            });
        });
    });
</script>


</html>