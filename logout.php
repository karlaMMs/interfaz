<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir a una página después de cerrar sesión (opcional)
header("Location: index.php"); // Cambia "index.php" al archivo al que quieras redirigir al usuario
exit();
?>
