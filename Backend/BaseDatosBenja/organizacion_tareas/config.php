<?php
$servername = "localhost";
$username = "Benjamin";  // Usuario por defecto
$password = "benjaelias507";      // Contraseña por defecto
$dbname = "base_datos_sistemas_colabs"; // Nombre de la base de datos

try {
    // Establecer conexión
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
