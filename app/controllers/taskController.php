<?php

session_start();
require_once '../../config/database.php';
require_once '../models/task.php';

$action = $_GET['action'] ?? '';

if ($action === 'list' && isset($_SESSION['user_id'])) {
    $taskModel = new Task();
    $tasks = $taskModel->getByUser($_SESSION['user_id']);

    echo json_encode(['success' => true, 'task' => $tasks]);
}
