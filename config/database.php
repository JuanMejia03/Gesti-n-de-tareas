<?php 

function getConnection(){
    $host = 'lamp-mariadblts';
    $db = 'TaskManager';
    $user = 'root';
    $pass = 'docker';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e){
        die("Error de conexiòn: " . $e->getMessage());
    }
}

?>