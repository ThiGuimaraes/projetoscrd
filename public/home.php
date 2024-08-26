<?php
// public/home.php
require_once '../src/auth.php';

if (!checarAuth()) {
    redirecionar('login.php');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Bem-vindo, <?php echo $_SESSION['nome']; ?></h2>
    <?php if (checarPapel('admin')): ?>
        <a href="manage_users.php">Gerenciar Usuários</a>
    <?php endif; ?>
    <a href="logout.php">Sair</a>
</body>
</html>
