<?php

session_start();
require_once '../../config/database.php';
require_once '../models/user.php';

$action = $_GET['action'] ?? '';

if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = ($_POST['password'] ?? '');
}

if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'todos los campos son obligatorios']);
    exit;
}
$user = new User();
$found = $user->getByUsername($username);

if ($found && password_verify($password, $found['password'])) {
    $_SESSION['user_id'] = $found['id'];
    $_SESSION['username'] = $found['username'];
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrecta papa']);
}
