<?php
// src/user.php

require_once 'db.php';

function obterTodosUsuarios() {
    global $pdo;
    $stmt = $pdo->query("SELECT id, nome, papel FROM usuarios");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function excluirUsuario($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
}

function atualizarUsuario($id, $nome, $papel) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, papel = ? WHERE id = ?");
    $stmt->execute([$nome, $papel, $id]);
}
?>
