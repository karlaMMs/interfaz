<?php
include "conexion.php";
session_start(); 
// Verificar si se proporciona el parámetro 'id' en la URL


if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];

    // Obtener el nombre del usuario desde la base de datos (asumiendo que tienes una tabla de usuarios relacionada con productos)
    $query = "SELECT firstname FROM users WHERE id_user = '$id_user'";
    $user_result = $conexion->query($query);

    if ($user_result) {
        $user_data = $user_result->fetch_assoc();
        $nombre_usuario = $user_data['firstname'];


        // Resto del código de index.php
    } else {
        // Manejo de errores, puedes personalizar según tus necesidades
        echo "Error en la consulta de usuario: " . $conexion->error;
    }
}

if (isset($_GET['id'])) {
    // Obtener el valor del parámetro 'id'
    $productoID = $_GET['id'];
  
    // Realizar una consulta a la base de datos para obtener la información del producto
    $consulta = "SELECT * FROM producto WHERE id = $productoID";
    $resultado = $conexion->query($consulta);

    // Verificar si la consulta fue exitosa
    if ($resultado) {
        // Obtener los datos del producto
        $producto = $resultado->fetch_assoc();

        // Ahora puedes utilizar $producto en tu código para mostrar la información del producto

        // Ejemplo de cómo mostrar el nombre del producto
        $nombreProducto = $producto['nombre'];

        // ... Continuar mostrando otros detalles del producto según sea necesario

        // Cerrar el resultado de la consulta
        $resultado->close();
    } else {
        // Si hay un error en la consulta, muestra un mensaje de error
        echo "Error en la consulta: " . $conexion->error;
    }
} else {
    // Si no se proporciona el parámetro 'id', muestra un mensaje de error o redirige a otra página
    echo "Error: ID del producto no proporcionado.";
}
// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/shoppingCart.css">
</head>
<body>
    <!--Nav bar-->
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

    <nav class="navbar navbar-expand-md navbar-light ">
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
    <!--Producto-->
    <div class="container">
        <div class="my-2">
            <div class="d-flex flex-row justify-content-center">
                <div class="col-sm-2">
                    <?php
                        // Mostrar imágenes del producto (puedes adaptar esto según cómo almacenas las imágenes en tu base de datos)
                        echo "<img src='" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "' class='rounded img-thumbnail' style='width: 100px; height: 100px; object-fit:cover;'>";
                        // Puedes mostrar más imágenes según sea necesario
                    ?>
                </div>
                <div class="col-sm-4 d-flex align-items-center">
                    <?php
                        // Mostrar imagen principal del producto
                        echo "<div class='image'>";
                        echo "<img src='" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "' class='rounded img-thumbnail' style='object-fit:fill;'>";
                        echo "</div>";
                    ?>
                </div>
                <div class="col-sm-4">
                    <div class="card rounded">
                        <div class="card-body">
                            <p class="card-text"><small class="text-muted">Cantidad disponible</small></p>
                            <?php
                                // Mostrar otros detalles del producto
                                echo "<h4 class='card-title'>" . $producto['nombre'] . "</h4>";
                                echo "<p class='card-text'><small class='text-muted'>" . $producto['categoria'] . "</small></p>";
                                echo "<p class='card-text'>" . $producto['descripcion'] . "</p>";
                                echo "<h5 class='card-title'>Precio: $" . $producto['precio'] . "</h5>";
                                echo "<p class='card-text'>Valoración: " . $producto['rate'] . "</p>";
                            ?>
                            <div class="row justify-content-center ">
                                <button class="btn btn_hp my-1">Comprar</button>
                                <button class="btn btn_hp my-1">Agregar al carrito</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <br>
    <br>
    <div class="container">
        <div class="d-flex flex-row justify-content-center">
            
            <div class="col-sm-4">
                <div>
                    <h1>Comentarios</h1>
                </div>
                
                <div class="card rounded">
                    <div class="card-body">
                        <h5 class="card-title">Autor</h5>
                        <p class="card-text">Comentario</p>
                        <p class="card-text"><small class="text-muted">Fecha</small></p>
                    </div>
                </div>
                <div>
                    <form class="" role="search">
                        <input class="form-control my-2" type="search" placeholder="Escribe un comentario..." aria-label="Search">
                        <button class="btn btn_hp" type="submit">Publicar</button>
                    </form>
                    <br>
                </div>
                
            </div>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>