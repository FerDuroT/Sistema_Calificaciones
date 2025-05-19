<?php
session_start();
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['usuario_nombre'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <title>Gestión de Calificaciones</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card p-4 shadow-sm mb-4">
            <h2 class="mb-3">Calificaciones de <?php echo $_SESSION['usuario_nombre']; ?></h2>

            <h3>Primer Bimestre</h3>
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Asignatura</th>
                        <th>Parcial 1</th>
                        <th>Parcial 2</th>
                        <th>Parcial 3</th>
                        <th>Examen</th>
                        <th>Promedio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'conexion.php';
                    $sql = "SELECT * FROM calificaciones WHERE usuario_id = :usuario_id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['usuario_id' => $_SESSION['usuario_id']]);
                    $calificaciones = $stmt->fetchAll();

                    if ($calificaciones) {
                        foreach ($calificaciones as $row) {
                            echo "<tr>
                                    <td>{$row['asignatura']}</td>
                                    <td>{$row['parcial1']}</td>
                                    <td>{$row['parcial2']}</td>
                                    <td>{$row['parcial3']}</td>
                                    <td>{$row['examen']}</td>
                                    <td>{$row['promedio']}</td>
                                  </tr>";
                        }
                    } else {
                    echo "<tr><td colspan='6' class='text-center'>No hay calificaciones registradas.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Muestra los últimos usuarios que han ingresado al sistema -->
        <div class="card p-4 shadow-sm">
            <h3>Últimas 10 Sesiones Iniciadas</h3>
            <table class="table table-striped table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th><i class="bi bi-person-circle"></i> Usuario</th>
                        <th><i class="bi bi-calendar-event"></i> Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_sesiones = "SELECT usuario, fecha FROM registro_sesiones ORDER BY fecha DESC LIMIT 10";
                    $stmt_sesiones = $pdo->query($sql_sesiones);
                    $sesiones = $stmt_sesiones->fetchAll();

                    if ($sesiones) {
                        foreach ($sesiones as $row) {
                            echo "<tr>
                                    <td>{$row['usuario']}</td>
                                    <td>{$row['fecha']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2' class='text-center'>No hay sesiones registradas.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a class="btn btn-secondary w-100 mt-3" href="logout.php">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>
