<?php
$servername = "localhost";
$username = "root"; // Tu nombre de usuario de MySQL
$password = "";     // Tu contraseña de MySQL
$dbname = "luisdb"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}
?>
