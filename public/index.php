<?php
session_start();
require_once '../src/auth.php';

if (!checarAuth()) {
    header('Location: login.php');
    exit();
}

$nome = $_SESSION['usuario'];
$nivel = $_SESSION['nivel'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Painel</h2>
        <p>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</p>
        <p>Nível de Acesso: <?php echo htmlspecialchars($nivel); ?></p>
        <a href="manage_users.php" class="btn btn-secondary">Gerenciar Usuários</a>
        <a href="logout.php" class="btn btn-danger">Sair</a>
    </div>
</body>
</html>
