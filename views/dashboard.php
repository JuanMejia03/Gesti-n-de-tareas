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
    <link rel="strylesheet" href="../assets/css/style.css">
</head>

<body>

    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']) ?></h2>

    <div id="tasklist"></div>

    <a href="/TaskManager/app/controllers/authController.php?action=logout">Cerrar sesión</a>
    <a href="/TaskManager/views/task/create.php">crear tarea</a>

    <hr>

    <div id="editModal" style="    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 9999;">
        <div id="div2" style="    background: white;
    padding: 20px;
    border-radius: 8px;
    width: 300px;">
            <h3>Editar tarea</h3>
            <form id="ediForm">
                <input type="text" id="editTaskId">

                <label for="editTitle">Titulo: </label>
                <input type="text" id="editTitle" require><br><br>

                <label for="editDescription">Descripción: </label>
                <textarea0 id="editDescription" rows="4" cols="30"></textarea0><br><br>

                <button type="submit">Guardar</button>
                <button type="button" id="cancelEdit">cancelar</button>
            </form>
        </div>
    </div>

    <script src="../assets/js/dashboard.js"></script>

</body>

</html>