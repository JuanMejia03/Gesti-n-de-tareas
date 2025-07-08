<?php 

function getConnection(){
    $host = 'localhost';
    $db = 'task_manager';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOExeption $e){
        die("Error de conexiòn: " . $e->getMessage());
    }
}

?>