<?php
require_once 'db.php';

function registrarUsuario($nome, $senha, $nivel) {
    global $pdo;
    $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

    $sql = 'INSERT INTO usuarios (nome, senha, nivel) VALUES (:nome, :senha, :nivel)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nome' => $nome, 'senha' => $senhaHash, 'nivel' => $nivel]);
}

function fazerLogin($nome, $senha) {
    global $pdo;
    $sql = 'SELECT * FROM usuarios WHERE nome = :nome';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nome' => $nome]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = $usuario['nome'];
        $_SESSION['nivel'] = $usuario['nivel'];
        return true;
    }
    return false;
}

function checarAuth() {
    return isset($_SESSION['usuario']);
}

function obterUsuarios() {
    global $pdo;
    $sql = 'SELECT * FROM usuarios';
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deletarUsuario($id) {
    global $pdo;
    $sql = 'DELETE FROM usuarios WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
}
?>
