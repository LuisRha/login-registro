<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero del Usuario</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

    <?php include('includes/header.php'); ?>

    <main>
        <h1>Bienvenido, <?php echo $_SESSION['nombre']; ?>, a tu tablero de usuario</h1>
        <p>Este es tu contenido personalizado.</p>
        <!-- Agrega más contenido personalizado aquí -->
    </main>

    <?php include('includes/footer.php'); ?>

    <script src="assets/lib/jquery.js"></script>
    <script src="assets/lib/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
