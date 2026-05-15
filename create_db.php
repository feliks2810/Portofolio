<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3309', 'root', '');
    $pdo->exec('CREATE DATABASE IF NOT EXISTS portfolio_yfh');
    echo 'Database created successfully';
} catch (PDOException $e) {
    echo $e->getMessage();
}
