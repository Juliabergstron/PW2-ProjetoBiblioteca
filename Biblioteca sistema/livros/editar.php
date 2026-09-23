<?php
require_once __DIR__ . '/../config/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: listar.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM livros WHERE id = :id");
$stmt->execute([':id' => $id]);
$livro = $stmt->fetch();

if (!$livro) {
    header('Location: listar.php');
    exit;
}

$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livro['titulo'] = trim($_POST['titulo'] ?? '');
    $livro['autor'] = trim($_POST['autor'] ?? '');
    $livro['ano'] = trim($_POST['ano'] ?? '');
    $livro['genero'] = trim($_POST['genero'] ?? '');
    $livro['status_leitura'] = trim($_POST['status_leitura'] ?? '');
    $livro['emprestado_para'] = trim($_POST['emprestado_para'] ?? '');

    if ($livro['titulo'] === '') $erros[] = 'Informe o título.';
    if ($livro['autor'] === '') $erros[] = 'Informe o autor.';
    if (!filter_var($livro['ano'], FILTER_VALIDATE_INT) || $livro['ano'] < 0 || $livro['ano'] > date('Y')) $erros[] = 'Informe um ano válido.';
    if ($livro['genero'] === '') $erros[] = 'Informe o gênero.';
    if (!in_array($livro['status_leitura'], ['Não lido','Lendo','Lido'], true)) $erros[] = 'Status inválido.';

    if (!$erros) {
        $stmt = $pdo->prepare("UPDATE livros SET titulo=:titulo, autor=:autor, ano=:ano, genero=:genero, status_leitura=:status_leitura, emprestado_para=:emprestado_para WHERE id=:id");
        $stmt->execute([
            ':titulo'=>$livro['titulo'],
            ':autor'=>$livro['autor'],
            ':ano'=>$livro['ano'],
            ':genero'=>$livro['genero'],
            ':status_leitura'=>$livro['status_leitura'],
            ':emprestado_para'=>$livro['emprestado_para'] !== '' ? $livro['emprestado_para'] : null,
            ':id'=>$id
        ]);
        header('Location: listar.php?sucesso=editado');
        exit;
    }
}
?>
<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="mb-4">
    <h1 class="h2">Editar livro</h1>
    <p class="text-secondary">Atualize as informações do livro.</p>
</div>

<?php if ($erros): ?>
<div class="alert alert-danger"><ul class="mb-0"><?php foreach ($erros as $erro): ?><li><?= htmlspecialchars($erro) ?></li><?php endforeach; ?></ul></div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
<div class="card-body p-4">
<form method="POST" class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Título *</label>
        <input type="text" name="titulo" class="form-control" maxlength="150" required value="<?= htmlspecialchars($livro['titulo']) ?>">
    </div>
    <div class="col-md-4">
        <label class="form-label">Ano *</label>
        <input type="number" name="ano" class="form-control" min="0" max="<?= date('Y') ?>" required value="<?= htmlspecialchars($livro['ano']) ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Autor *</label>
        <input type="text" name="autor" class="form-control" maxlength="100" required value="<?= htmlspecialchars($livro['autor']) ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Gênero *</label>
        <input type="text" name="genero" class="form-control" maxlength="50" required value="<?= htmlspecialchars($livro['genero']) ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Status de leitura *</label>
        <select name="status_leitura" class="form-select" required>
            <?php foreach (['Não lido','Lendo','Lido'] as $opcao): ?>
                <option value="<?= $opcao ?>" <?= $livro['status_leitura'] === $opcao ? 'selected' : '' ?>><?= $opcao ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Emprestado para</label>
        <input type="text" name="emprestado_para" class="form-control" maxlength="100" value="<?= htmlspecialchars($livro['emprestado_para'] ?? '') ?>">
    </div>
    <div class="col-12 d-flex gap-2">
        <button type="submit" class="btn btn-primary">Salvar alterações</button>
        <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</form>
</div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>