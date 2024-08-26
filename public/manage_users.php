<?php
session_start();
require_once '../src/auth.php';

if (!checarAuth() || $_SESSION['nivel'] !== 'admin') {
    header('Location: index.php');
    exit();
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    deletarUsuario($id);
    header('Location: manage_users.php');
    exit();
}

$usuarios = obterUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Gerenciar Usuários</h2>
        <a href="index.php" class="btn btn-secondary mb-3">Voltar</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nível</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nivel']); ?></td>
                        <td>
                            <a href="manage_users.php?delete=<?php echo $usuario['id']; ?>" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
