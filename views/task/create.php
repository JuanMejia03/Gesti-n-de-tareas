<?php

session_start();

/* if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
} */

$pageTitle = 'Creación de nueva tarea';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">
    <?php include_once '../layout/navbar.php'; ?>

    <main class="container my-4">
        <h3>Crear nueva tarea</h3>
        <form id="taskForm">
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" name="description" id="description" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Crear tarea</button>
            <a href="javascript:history.back()" class="btn btn-secondary">Cancelar</a>
        </form>

        <div id="formMsg" class="mt-3 text-success"></div>
    </main>

    <script src="../../assets/js/create.js"></script>
</body>

</html>