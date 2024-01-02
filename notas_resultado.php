<?php
session_start();

// Verificar la autenticación
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

// Conectar a la base de datos (ajusta según tus configuraciones)
$conexion = new mysqli("localhost", "root", "", "luisdb");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener las notas del usuario
$usuario_id = $_SESSION["id"];
$sql_notas = "SELECT id, contenido FROM notas WHERE usuario_id = ?";
$stmt_notas = $conexion->prepare($sql_notas);

if ($stmt_notas) {
    $stmt_notas->bind_param("i", $usuario_id);
    $stmt_notas->execute();
    $resultado_notas = $stmt_notas->get_result();
} else {
    die("Error al preparar la consulta: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Notas</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

    <?php include('includes/header.php'); ?>

    <main>
        <h1>Lista de Notas</h1>

        <?php
        // Mostrar las notas existentes con opciones de editar y eliminar
        if ($resultado_notas->num_rows > 0) {
            echo "<ul>";
            while ($fila = $resultado_notas->fetch_assoc()) {
                echo "<li>{$fila["contenido"]} 
                      <a href='editar_nota.php?id={$fila["id"]}'>Editar</a> 
                      <a href='eliminar_nota.php?id={$fila["id"]}'>Eliminar</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No tienes notas guardadas.</p>";
        }
        ?>
    </main>

    <?php include('includes/footer.php'); ?>

    <script src="assets/lib/jquery.js"></script>
    <script src="assets/lib/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
