<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto Web</title>
    <link rel="stylesheet" href="css/estilo.css">
    <style>
        .align-right {
            text-align: right;
        }

        .align-right-and-top {
            text-align: right;
            margin-top: 0; /* Puedes ajustar el valor según tu diseño */
        }
    </style>
</head>
<body>

    <?php include('includes/header.php'); ?>

    <main>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            echo "<h1 class='align-right-and-top'>Bienvenido, {$_SESSION['correo']}!</h1>";
            echo "<p class='align-right'> 
            Cuento <br> 
            Cuentos con valores similares <br> 
            Una aventura llena de pintura <br> 
            ¡Que alguien mueva esa sandía! <br> 
            El cantor de ópera
            
            </p>";
            // Agrega más contenido personalizado aquí
        } else {
            echo "<h1>Bienvenido a mi proyecto web</h1>";
            echo "<p>Este es un contenido de ejemplo. Puedes editar este archivo para agregar más contenido.</p>";
        }
        ?>
    </main>

    <?php include('includes/footer.php'); ?>

    <script src="assets/lib/jquery.js"></script>
    <script src="assets/lib/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
