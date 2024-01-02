<?php
session_start();
require_once('../config/db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Inicio de sesión exitoso
        $_SESSION['loggedin'] = true;
        $_SESSION['correo'] = $correo;
        header("Location: ../index.php"); // Redirige a la página principal
        exit();
    } else {
        $error = "Correo o contraseña incorrectos";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>

    <?php include('../includes/header.php'); ?>

    <main>
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="login.php" method="post">
            <label for="correo">Correo:</label>
            <input type="text" name="correo" required>
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </main>

    <?php include('../includes/footer.php'); ?>

    <script src="../assets/lib/jquery.js"></script>
    <script src="../assets/lib/bootstrap.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>
