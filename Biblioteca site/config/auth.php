<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function exigirLogin(): void {
    if (empty($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit;
    }
}

function usuarioAtual(): string {
    return $_SESSION['usuario_nome'] ?? 'Usuário';
}
