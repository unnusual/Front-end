<?php
include 'config.php'; // Conectar a la base de datos

// Comprobar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_tarea = $_POST['nombre_tarea'];
    $materia = $_POST['materia'];
    $descripcion = $_POST['descripcion'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $importancia = $_POST['importancia'];

    // Insertar la tarea en la base de datos
    $sql = "INSERT INTO tareas (nombre_tarea, materia, descripcion, fecha_entrega, importancia) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nombre_tarea, $materia, $descripcion, $fecha_entrega, $importancia]);

    echo "Tarea agregada con éxito.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Organización de Tareas</title>
</head>
<body>
    <h1>Organizador de Tareas</h1>

    <!-- Formulario para añadir tareas -->
    <form action="index.php" method="POST">
        <label for="nombre_tarea">Nombre de la Tarea:</label><br>
        <input type="text" name="nombre_tarea" required><br><br>

        <label for="materia">Materia:</label><br>
        <input type="text" name="materia" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea name="descripcion" rows="4"></textarea><br><br>

        <label for="fecha_entrega">Fecha de Entrega:</label><br>
        <input type="date" name="fecha_entrega" required><br><br>

        <label for="importancia">Importancia:</label><br>
        <select name="importancia" required>
            <option value="Alta">Alta</option>
            <option value="Media">Media</option>
            <option value="Baja">Baja</option>
        </select><br><br>

        <input type="submit" value="Agregar Tarea">
    </form>

    <h2>Lista de Tareas</h2>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Materia</th>
            <th>Descripción</th>
            <th>Fecha de Entrega</th>
            <th>Importancia</th>
            <th>Estado</th>
        </tr>
        <?php
        // Consultar las tareas en la base de datos
        $stmt = $conn->query("SELECT * FROM tareas ORDER BY importancia DESC, fecha_entrega ASC");
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>{$row['nombre_tarea']}</td>";
            echo "<td>{$row['materia']}</td>";
            echo "<td>{$row['descripcion']}</td>";
            echo "<td>{$row['fecha_entrega']}</td>";
            echo "<td>{$row['importancia']}</td>";
            echo "<td>{$row['estado']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
