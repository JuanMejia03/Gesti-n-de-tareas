<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Tarea</title>
</head>

<body>
    <h3>Crear nueva tarea</h3>
    <form id="taskForm">
        <input type="text" name="title" id="title" placeholder="Título" required><br>
        <textarea name="description" id="description" placeholder="Descripción"></textarea><br>
        <button type="submit">Crear tarea</button>
        <button type="button" onclick="window.history.back()">cancelar</button>
    </form>

    <div id="formMsg" style="color: green;"></div>
    <script src="../../assets/js/create.js"></script>
</body>

</html>