<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto Web</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Barrio Manzanapamba</h1>
        
        <!-- Archivo: includes/header.php -->
<nav>
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            echo '<li><a href="notas.php">Notas</a></li>';
            echo '<li><a href="pages/logout.php">Cerrar Sesión</a></li>';
        } else {
            echo '<li><a href="pages/login.php">Iniciar Sesión</a></li>';
        }
        ?>
    </ul>
</nav>

    </header>
