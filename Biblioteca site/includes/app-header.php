<?php
if (!isset($basePath)) {
    $basePath = (strpos($_SERVER['SCRIPT_NAME'], '/livros/') !== false) ? '../' : '';
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' • ' : '' ?>Biblioteca Virtual</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= $basePath ?>assets/css/style.css" rel="stylesheet">
</head>
<body class="app-body">
<div class="app-shell">
<aside class="sidebar">
    <a class="sidebar-brand" href="<?= $basePath ?>dashboard.php"><span class="brand-icon">📖</span><span>Biblioteca<br><b>Virtual</b></span></a>
    <nav class="side-nav">
        <small>MENU</small>
        <a href="<?= $basePath ?>dashboard.php" class="<?= basename($_SERVER['PHP_SELF'])==='dashboard.php'?'active':'' ?>">⌂ <span>Início</span></a>
        <a href="<?= $basePath ?>livros/listar.php" class="<?= basename($_SERVER['PHP_SELF'])==='listar.php'?'active':'' ?>">▤ <span>Meu acervo</span></a>
        <a href="<?= $basePath ?>livros/cadastrar.php" class="<?= basename($_SERVER['PHP_SELF'])==='cadastrar.php'?'active':'' ?>">＋ <span>Novo livro</span></a>
    </nav>
    <div class="sidebar-bottom">
        <div class="mini-user"><div class="avatar"><?= htmlspecialchars(mb_strtoupper(mb_substr(usuarioAtual(),0,1))) ?></div><div><strong><?= htmlspecialchars(usuarioAtual()) ?></strong><small>Leitor(a)</small></div></div>
        <a class="logout" href="<?= $basePath ?>logout.php">↪ Sair</a>
    </div>
</aside>
<main class="app-main">
<header class="topbar">
    <button class="mobile-menu" onclick="document.querySelector('.sidebar').classList.toggle('show')">☰</button>
    <div class="topbar-search">📚 <span>Minha biblioteca</span></div>
    <div class="topbar-user"><span><?= htmlspecialchars(usuarioAtual()) ?></span><div class="avatar small"><?= htmlspecialchars(mb_strtoupper(mb_substr(usuarioAtual(),0,1))) ?></div></div>
</header>
<div class="page-content">