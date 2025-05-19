<?php
// Variables para la conexión
$servidor = '127.0.0.1';
$base = 'colegio';
$user = 'root';
$pass = '';

// Realiza la conexión a la base
$pdo = new PDO("mysql:host=$servidor;dbname=$base", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($pdo) {
    echo "Se estableció conexión a la base de datos.";
} else {
    die("Error al intentar conectar con la base de datos.");
}
?>
