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

// Si se envió un formulario para guardar la nota
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar el contenido de la nota
    $contenido_nota = trim($_POST["contenido_nota"]);
    if (empty($contenido_nota)) {
        $mensaje = "El contenido de la nota no puede estar vacío.";
    } else {
        $contenido_nota = $conexion->real_escape_string($contenido_nota);

        // Insertar la nota en la base de datos
        $sql = "INSERT INTO notas (usuario_id, contenido) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("is", $_SESSION["id"], $contenido_nota);
            if ($stmt->execute()) {
                $mensaje = "Nota guardada con éxito.";
            } else {
                $mensaje = "Error al guardar la nota: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $mensaje = "Error al preparar la consulta: " . $conexion->error;
        }
    }

    // Redirigir a otra página con el mensaje
    header("Location: notas_resultado.php?mensaje=" . urlencode($mensaje));
    exit();
}

// Obtener las notas del usuario
$usuario_id = $_SESSION["correo"];
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
    <title>Notas</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

    <?php include('includes/header.php'); ?>

    <main>
        <h1>Notas</h1>

        <!-- Formulario para agregar una nueva nota -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <textarea name="contenido_nota" rows="4" cols="50"></textarea>
            <br>
            <input type="submit" value="Guardar Nota">
        </form>

        <!-- Mostrar las notas existentes -->
        <?php
        if ($resultado_notas->num_rows > 0) {
            echo "<h2>Tus Notas:</h2>";
            while ($fila = $resultado_notas->fetch_assoc()) {
                echo "<p>Nota #" . $fila["correo"] . ": " . nl2br(htmlspecialchars($fila["contenido"])) . "</p>";
            }
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
