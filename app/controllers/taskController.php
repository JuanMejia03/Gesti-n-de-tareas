<?php

session_start();
header('Content-Type: application/json');

require_once '../../config/database.php';
require_once '../models/task.php';

$action = $_GET['action'] ?? '';

if ($action === 'list' && isset($_SESSION['user_id'])) {
    $taskModel = new Task();
    $tasks = $taskModel->getByUser($_SESSION['user_id']);

    echo json_encode(['success' => true, 'tasks' => $tasks]);
    exit;
}

if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'No autenticado']);
        exit;
    }

    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (strlen($title) < 3) {
        echo json_encode(['success' => false, 'message' => 'El título debe tener al menos 3 caracteres']);
        exit;
    }

    $taskModel = new Task();
    $saved = $taskModel->create($_SESSION['user_id'], $title, $description);

    echo json_encode(['success' => $saved]);
    exit;
}

if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $task_id = $_POST['id'] ?? null;

    if (!$task_id) {
        echo json_encode(['success' => false, 'menssage' => 'id de tarea invalida']);
        exit;
    }

    $taskModel = new Task();
    $deleted = $taskModel->delete($task_id, $_SESSION['user_id']);

    echo json_encode(['success' => $deleted]);
    exit;
}
