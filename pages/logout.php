<?php
session_start();

// Destruir todas las variables de sesión
session_destroy();

// Redirigir a la página de inicio después de cerrar sesión
header("Location: ../index.php");
exit();
?>
