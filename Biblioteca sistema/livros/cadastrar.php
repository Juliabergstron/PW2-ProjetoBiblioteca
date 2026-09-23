<?php
require_once __DIR__ . '/../config/conexao.php';

$erros = [];
$dados = [
    'titulo' => '',
    'autor' => '',
    'ano' => '',
    'genero' => '',
    'status_leitura' => 'Não lido',
    'emprestado_para' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($dados as $campo => $valor) {
        $dados[$campo] = trim($_POST[$campo] ?? '');
    }

    if ($dados['titulo'] === '') $erros[] = 'Informe o título.';
    if ($dados['autor'] === '') $erros[] = 'Informe o autor.';
    if (!filter_var($dados['ano'], FILTER_VALIDATE_INT) || $dados['ano'] < 0 || $dados['ano'] > date('Y')) $erros[] = 'Informe um ano válido.';
    if ($dados['genero'] === '') $erros[] = 'Informe o gênero.';
    if (!in_array($dados['status_leitura'], ['Não lido','Lendo','Lido'], true)) $erros[] = 'Status inválido.';

    if (!$erros) {
        $stmt = $pdo->prepare("INSERT INTO livros (titulo, autor, ano, genero, status_leitura, emprestado_para) VALUES (:titulo, :autor, :ano, :genero, :status_leitura, :emprestado_para)");
        $stmt->execute([
            ':titulo' => $dados['titulo'],
            ':autor' => $dados['autor'],
            ':ano' => $dados['ano'],
            ':genero' => $dados['genero'],
            ':status_leitura' => $dados['status_leitura'],
            ':emprestado_para' => $dados['emprestado_para'] !== '' ? $dados['emprestado_para'] : null
        ]);
        header('Location: listar.php?sucesso=cadastrado');
        exit;
    }
}
?>
<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="mb-4">
    <h1 class="h2">Cadastrar livro</h1>
    <p class="text-secondary">Preencha as informações do livro.</p>
</div>

<?php if ($erros): ?>
<div class="alert alert-danger"><ul class="mb-0"><?php foreach ($erros as $erro): ?><li><?= htmlspecialchars($erro) ?></li><?php endforeach; ?></ul></div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
<div class="card-body p-4">
<form method="POST" id="formLivro" class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Título *</label>
        <input type="text" name="titulo" class="form-control" maxlength="150" required value="<?= htmlspecialchars($dados['titulo']) ?>">
    </div>
    <div class="col-md-4">
        <label class="form-label">Ano *</label>
        <input type="number" name="ano" class="form-control" min="0" max="<?= date('Y') ?>" required value="<?= htmlspecialchars($dados['ano']) ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Autor *</label>
        <input type="text" name="autor" class="form-control" maxlength="100" required value="<?= htmlspecialchars($dados['autor']) ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Gênero *</label>
        <input type="text" name="genero" class="form-control" maxlength="50" placeholder="Ex.: Fantasia, Romance, Mistério" required value="<?= htmlspecialchars($dados['genero']) ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Status de leitura *</label>
        <select name="status_leitura" class="form-select" required>
            <?php foreach (['Não lido','Lendo','Lido'] as $opcao): ?>
                <option value="<?= $opcao ?>" <?= $dados['status_leitura'] === $opcao ? 'selected' : '' ?>><?= $opcao ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Emprestado para</label>
        <input type="text" name="emprestado_para" class="form-control" maxlength="100" placeholder="Deixe vazio se estiver com você" value="<?= htmlspecialchars($dados['emprestado_para']) ?>">
    </div>
    <div class="col-12 d-flex gap-2 pt-2">
        <button type="submit" class="btn btn-primary">Salvar livro</button>
        <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</form>
</div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>