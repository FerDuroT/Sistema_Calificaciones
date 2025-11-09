<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Para que sea responsivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Uso de Bootstrap para estilos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Iniciar Sesión</title>
</head>
<body class="bg-light">
    <!-- Contenedor principal para centrar el formulario -->
    <div class="container mt-5">
        <!-- Bootstrap para un estilo elegante -->
        <div class="card p-4 shadow-sm" style="max-width: 400px; margin: auto;">
            <h2 class="mb-3 text-center">Bienvenido al sistema de calificaciones</h2>
            <p class="text-center text-muted mb-4">Por favor ingresa tus credenciales para autenticarte en el sistema</p>
            <!-- Formulario para iniciar sesión -->
            <form method="POST">
                <div class="mb-3">
                    <input type="text" name="usuario" class="form-control" placeholder="Nombre de Usuario" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                </div>
                <!-- Botón para enviar el formulario -->
                <button type="submit" name="login" class="btn btn-primary w-100">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
// Iniciar sesión, habilitar el uso de variables de sesión
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    // Consulta para buscar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['usuario' => $usuario, 'password' => $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) { // Si el usuario existe:
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nombre'] = $user['nombre'];

        // Registrar la sesión en la base de datos
        $log_sql = "INSERT INTO registro_sesiones (usuario) VALUES (:usuario)";
        $log_stmt = $pdo->prepare($log_sql);
        $log_stmt->execute(['usuario' => $usuario]);

        header('Location: calificaciones.php');
    } else {
        //Caso contrario: XXXXmostrar un mensaje de error si el usuario o contraseña son incorrectos
        echo "<div class='alert alert-danger mt-3 text-center'>Usuario o contraseña incorrectos.</div>";
    }
}
?>
