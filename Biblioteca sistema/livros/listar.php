<?php
require_once __DIR__ . '/../config/conexao.php';

$busca = trim($_GET['busca'] ?? '');
$status = $_GET['status'] ?? '';
$genero = trim($_GET['genero'] ?? '');

$sql = "SELECT * FROM livros WHERE 1=1";
$params = [];

if ($busca !== '') {
    $sql .= " AND (titulo LIKE :busca OR autor LIKE :busca)";
    $params[':busca'] = "%$busca%";
}
if ($status !== '') {
    $sql .= " AND status_leitura = :status";
    $params[':status'] = $status;
}
if ($genero !== '') {
    $sql .= " AND genero LIKE :genero";
    $params[':genero'] = "%$genero%";
}
$sql .= " ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$livros = $stmt->fetchAll();

$generos = $pdo->query("SELECT DISTINCT genero FROM livros ORDER BY genero")->fetchAll(PDO::FETCH_COLUMN);
?>
<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h1 class="h2 mb-1">Meus livros</h1>
        <p class="text-secondary mb-0">Consulte e gerencie os livros cadastrados.</p>
    </div>
    <a href="cadastrar.php" class="btn btn-primary">+ Cadastrar livro</a>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form class="row g-2" method="GET">
            <div class="col-lg-5">
                <input type="text" name="busca" class="form-control" placeholder="Buscar por título ou autor" value="<?= htmlspecialchars($busca) ?>">
            </div>
            <div class="col-lg-3">
                <select name="status" class="form-select">
                    <option value="">Todos os status</option>
                    <?php foreach (['Não lido','Lendo','Lido'] as $opcao): ?>
                        <option value="<?= $opcao ?>" <?= $status === $opcao ? 'selected' : '' ?>><?= $opcao ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-lg-2">
                <select name="genero" class="form-select">
                    <option value="">Todos os gêneros</option>
                    <?php foreach ($generos as $g): ?>
                        <option value="<?= htmlspecialchars($g) ?>" <?= $genero === $g ? 'selected' : '' ?>><?= htmlspecialchars($g) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-lg-2 d-grid">
                <button class="btn btn-dark">Filtrar</button>
            </div>
        </form>
    </div>
</div>

<?php if (!$livros): ?>
    <div class="alert alert-info">Nenhum livro encontrado.</div>
<?php else: ?>
<div class="table-responsive bg-white rounded-4 shadow-sm">
<table class="table align-middle mb-0">
    <thead class="table-light">
        <tr>
            <th>Livro</th><th>Autor</th><th>Ano</th><th>Gênero</th><th>Status</th><th>Emprestado para</th><th class="text-end">Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($livros as $livro): ?>
        <tr>
            <td class="fw-semibold"><?= htmlspecialchars($livro['titulo']) ?></td>
            <td><?= htmlspecialchars($livro['autor']) ?></td>
            <td><?= htmlspecialchars($livro['ano']) ?></td>
            <td><?= htmlspecialchars($livro['genero']) ?></td>
            <td>
                <?php
                $badge = ['Lido'=>'success','Lendo'=>'warning','Não lido'=>'secondary'][$livro['status_leitura']] ?? 'secondary';
                ?>
                <span class="badge text-bg-<?= $badge ?>"><?= htmlspecialchars($livro['status_leitura']) ?></span>
            </td>
            <td><?= $livro['emprestado_para'] ? htmlspecialchars($livro['emprestado_para']) : '<span class="text-secondary">Não emprestado</span>' ?></td>
            <td class="text-end text-nowrap">
                <a href="editar.php?id=<?= $livro['id'] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                <a href="excluir.php?id=<?= $livro['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirmarExclusao('<?= htmlspecialchars(addslashes($livro['titulo'])) ?>')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php endif; ?>

<?php include __DIR__ . '/../includes/footer.php'; ?>