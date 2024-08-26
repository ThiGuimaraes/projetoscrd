<?php
require_once '../src/db.php';
require_once '../src/auth.php';

session_start();

if (!checarAuth() || !verificarAdministrador()) {
    echo "Acesso negado.";
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id === null) {
    echo "ID não fornecido.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $nivel = $_POST['nivel'];
    
    $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, nivel = ? WHERE id = ?");
    $stmt->execute([$nome, $nivel, $id]);
    header('Location: manage_users.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Editar Usuário</h1>
    <form action="edit_user.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
        <br>
        <label for="nivel">Nível:</label>
        <select id="nivel" name="nivel">
            <option value="usuario" <?php echo $usuario['nivel'] === 'usuario' ? 'selected' : ''; ?>>Usuário</option>
            <option value="admin" <?php echo $usuario['nivel'] === 'admin' ? 'selected' : ''; ?>>Administrador</option>
        </select>
        <br>
        <button type="submit">Salvar</button>
    </form>
    <a href="manage_users.php?id=<?php echo htmlspecialchars($id); ?>">Voltar</a>
</body>
</html>
