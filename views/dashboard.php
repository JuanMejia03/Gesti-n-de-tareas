<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Tareas</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']) ?></h2>

    <div id="tasklist"></div>

    <a href="/TaskManager/app/controllers/authController.php?action=logout">Cerrar sesión</a>
    <a href="/TaskManager/views/task/create.php">crear tarea</a>

    <hr>

    <div id="editModal">
            <h3>Editar tarea</h3>
            <form id="ediForm">
                <input type="text" id="editTaskId"><br>

                <label for="editTitle">Titulo: </label><br>
                <input type="text" id="editTitle" require><br><br>

                <label for="editDescription">Descripción: </label>
                <textarea id="editDescription" rows="4" cols="30"></textarea><br><br>

                <button type="submit">Guardar</button>
                <button type="button" id="cancelEdit">cancelar</button>
            </form>
        </div>
    </div>

    <script src="../assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>