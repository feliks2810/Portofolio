<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    echo "Connected successfully without DB\n";
    
    $pdo2 = new PDO('mysql:host=127.0.0.1;port=3306;dbname=portfolio_yfh', 'root', '');
    echo "Connected successfully to DB\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
