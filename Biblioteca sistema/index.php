<?php
require_once __DIR__ . '/config/conexao.php';

$total = $pdo->query("SELECT COUNT(*) FROM livros")->fetchColumn();
$lidos = $pdo->query("SELECT COUNT(*) FROM livros WHERE status_leitura = 'Lido'")->fetchColumn();
$lendo = $pdo->query("SELECT COUNT(*) FROM livros WHERE status_leitura = 'Lendo'")->fetchColumn();
$naoLidos = $pdo->query("SELECT COUNT(*) FROM livros WHERE status_leitura = 'Não lido'")->fetchColumn();
$emprestados = $pdo->query("SELECT COUNT(*) FROM livros WHERE emprestado_para IS NOT NULL AND emprestado_para <> ''")->fetchColumn();
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<div class="hero mb-4">
    <div>
        <span class="badge rounded-pill text-bg-light mb-3">Biblioteca Virtual</span>
        <h1 class="display-6 fw-bold">Organize seus livros de forma simples.</h1>
        <p class="lead mb-0">Cadastre, consulte, edite e exclua livros em um sistema CRUD desenvolvido com PHP, MySQL, Bootstrap e JavaScript.</p>
    </div>
    <a href="livros/cadastrar.php" class="btn btn-light btn-lg mt-3 mt-md-0">+ Cadastrar livro</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3"><div class="stat-card"><span>Total de livros</span><strong><?= $total ?></strong></div></div>
    <div class="col-6 col-lg-3"><div class="stat-card"><span>Livros lidos</span><strong><?= $lidos ?></strong></div></div>
    <div class="col-6 col-lg-3"><div class="stat-card"><span>Em leitura</span><strong><?= $lendo ?></strong></div></div>
    <div class="col-6 col-lg-3"><div class="stat-card"><span>Emprestados</span><strong><?= $emprestados ?></strong></div></div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h2 class="h4">Comece sua biblioteca</h2>
        <p class="text-secondary">Use o menu para visualizar os livros cadastrados ou adicionar um novo livro.</p>
        <a href="livros/listar.php" class="btn btn-primary">Ver livros</a>
        <a href="livros/cadastrar.php" class="btn btn-outline-primary">Cadastrar livro</a>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>