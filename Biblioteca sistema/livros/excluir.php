<?php
require_once __DIR__ . '/../config/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM livros WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: listar.php?sucesso=excluido');
exit;
?>