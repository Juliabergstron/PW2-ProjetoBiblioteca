<?php
$basePath = '';
if (strpos($_SERVER['SCRIPT_NAME'], '/livros/') !== false) {
    $basePath = '../';
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca Virtual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $basePath ?>assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= $basePath ?>index.php">📚 Biblioteca Virtual</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>index.php">Início</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>livros/listar.php">Livros</a></li>
                <li class="nav-item"><a class="btn btn-primary ms-lg-2" href="<?= $basePath ?>livros/cadastrar.php">Cadastrar</a></li>
            </ul>
        </div>
    </div>
</nav>
<main class="container py-4">