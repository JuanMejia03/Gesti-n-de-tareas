<?php
if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /TaskManager/views/login.php");
    exit;
}


$pageTitle = isset($pageTitle) ? $pageTitle : '';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/TaskManager/views/task/dashboard.php">Task Manager</a>
        <div class="d-flex align-items-center">
            <span class="navbar-text text-white me-3 fs-5">
                <?= htmlspecialchars($pageTitle) ?>
            </span>
            <?php if ($pageTitle === 'Bienvenido, ' . $_SESSION['username']): ?>
                <a href="/TaskManager/views/task/create.php" class="btn btn-success btn-sm">Crear tarea</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="/TaskManager/app/controllers/authController.php?action=logout" class="btn btn-outline-light btn-sm me-2">Cerrar sesión</a>
            <?php endif; ?>
        </div>
    </div>
</nav>