<?php
$dsn = 'mysql:host=localhost;dbname=myproject;charset=utf8';
$username = 'root'; // Altere se necessário
$password = ''; // Altere se necessário

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Não foi possível conectar ao banco de dados: ' . $e->getMessage());
}
