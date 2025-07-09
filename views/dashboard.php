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
</head>

<body>

<h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']) ?></h2>

<div id="tasklist"></div>

    <a href="/TaskManager/app/controllers/authController.php?action=logout">Cerrar sesión</a>
    <a href="/TaskManager/views/task/create.php">crear tarea</a>

    <hr>


<script src="../assets/js/dashboard.js">

</script>

</body>

</html>