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

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Task Manager</a>
            <div class="d-flex">
                <span class="navbar-text text-white me-3">
                    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']) ?></h2>
                </span>

                <a href="/TaskManager/app/controllers/authController.php?action=logout">Cerrar sesión</a>
                <a href="/TaskManager/views/task/create.php">crear tarea</a>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <h2 class="mb-4">Tus tareas</h2>
        <div id="tasklist" class="row gy-3"></div>
    </main>
    <hr>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="ediForm">
                <div>
                    <h5 class="modal-title" id="editModalLabel">Editar tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editTaskId" />

                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Titulo</label>
                        <input type="text" class="form-control" id="editTitle" require />
                    </div>

                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Descripción</label>
                        <textarea class="form-control" id="editDescription" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>