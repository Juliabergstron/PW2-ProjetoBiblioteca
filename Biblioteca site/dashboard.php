<?php
require_once __DIR__ . '/config/auth.php';
exigirLogin();
require_once __DIR__ . '/config/conexao.php';

$total = $pdo->query("SELECT COUNT(*) FROM livros")->fetchColumn();
$lidos = $pdo->query("SELECT COUNT(*) FROM livros WHERE status_leitura = 'Lido'")->fetchColumn();
$lendo = $pdo->query("SELECT COUNT(*) FROM livros WHERE status_leitura = 'Lendo'")->fetchColumn();
$naoLidos = $pdo->query("SELECT COUNT(*) FROM livros WHERE status_leitura = 'Não lido'")->fetchColumn();
$emprestados = $pdo->query("SELECT COUNT(*) FROM livros WHERE emprestado_para IS NOT NULL AND emprestado_para <> ''")->fetchColumn();
$recentes = $pdo->query("SELECT * FROM livros ORDER BY id DESC LIMIT 5")->fetchAll();
?>
<?php include __DIR__ . '/includes/app-header.php'; ?>

<div class="welcome-banner">
    <div>
        <span class="eyebrow light">SEU ESPAÇO DE LEITURA</span>
        <h1>Olá, <?= htmlspecialchars(usuarioAtual()) ?>! 👋</h1>
        <p>Que história você vai descobrir hoje?</p>
    </div>
    <a href="livros/cadastrar.php" class="btn btn-light btn-lg">+ Novo livro</a>
</div>

<div class="row g-3 mt-1">
    <div class="col-6 col-xl-3"><div class="metric"><span>Total no acervo</span><strong><?= $total ?></strong><small>livros cadastrados</small></div></div>
    <div class="col-6 col-xl-3"><div class="metric"><span>Já lidos</span><strong><?= $lidos ?></strong><small>finalizados</small></div></div>
    <div class="col-6 col-xl-3"><div class="metric"><span>Em leitura</span><strong><?= $lendo ?></strong><small>atualmente</small></div></div>
    <div class="col-6 col-xl-3"><div class="metric"><span>Emprestados</span><strong><?= $emprestados ?></strong><small>fora da estante</small></div></div>
</div>

<div class="row g-4 mt-2">
    <div class="col-lg-8">
        <div class="content-card h-100">
            <div class="card-heading">
                <div><span class="eyebrow">ACERVO</span><h2>Adicionados recentemente</h2></div>
                <a href="livros/listar.php" class="link-main">Ver todos →</a>
            </div>
            <?php if (!$recentes): ?>
                <div class="empty-state"><div>📚</div><h3>Seu acervo está vazio</h3><p>Cadastre seu primeiro livro para começar.</p><a href="livros/cadastrar.php" class="btn btn-primary">Cadastrar livro</a></div>
            <?php else: ?>
                <div class="book-list">
                    <?php foreach ($recentes as $livro): ?>
                    <div class="book-row">
                        <div class="book-cover"><span><?= htmlspecialchars(mb_substr($livro['titulo'], 0, 1)) ?></span></div>
                        <div class="book-info">
                            <strong><?= htmlspecialchars($livro['titulo']) ?></strong>
                            <span><?= htmlspecialchars($livro['autor']) ?> • <?= htmlspecialchars($livro['genero']) ?></span>
                        </div>
                        <span class="status-pill status-<?= strtolower(str_replace(' ', '-', str_replace('ã','a',$livro['status_leitura']))) ?>"><?= htmlspecialchars($livro['status_leitura']) ?></span>
                        <a href="livros/editar.php?id=<?= $livro['id'] ?>" class="icon-btn" title="Editar">✎</a>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="content-card h-100">
            <div class="card-heading"><div><span class="eyebrow">PROGRESSO</span><h2>Leitura</h2></div></div>
            <div class="progress-ring">
                <div><strong><?= $total ? round(($lidos / $total) * 100) : 0 ?>%</strong><span>lidos</span></div>
            </div>
            <div class="legend"><span><i class="dot dot-read"></i> Lidos <b><?= $lidos ?></b></span><span><i class="dot dot-reading"></i> Lendo <b><?= $lendo ?></b></span><span><i class="dot dot-unread"></i> Não lidos <b><?= $naoLidos ?></b></span></div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/app-footer.php'; ?>