<?php
require_once __DIR__ . '/../config/auth.php';
exigirLogin();
require_once __DIR__ . '/../config/conexao.php';

$dados = ['titulo'=>'','autor'=>'','ano'=>'','genero'=>'','status_leitura'=>'Não lido','emprestado_para'=>''];
$erros = [];

if ($_SERVER['REQUEST_METHOD']==='POST') {
    foreach($dados as $campo=>$valor) $dados[$campo] = trim($_POST[$campo] ?? '');
    if ($dados['titulo']==='') $erros[]='Informe o título.';
    if ($dados['autor']==='') $erros[]='Informe o autor.';
    if (!filter_var($dados['ano'], FILTER_VALIDATE_INT) || $dados['ano']<0 || $dados['ano']>date('Y')) $erros[]='Informe um ano válido.';
    if ($dados['genero']==='') $erros[]='Informe o gênero.';
    if (!in_array($dados['status_leitura'],['Não lido','Lendo','Lido'],true)) $erros[]='Status inválido.';
    if (!$erros) {
        $stmt=$pdo->prepare("INSERT INTO livros (titulo,autor,ano,genero,status_leitura,emprestado_para) VALUES (:titulo,:autor,:ano,:genero,:status,:emprestado)");
        $stmt->execute([':titulo'=>$dados['titulo'],':autor'=>$dados['autor'],':ano'=>$dados['ano'],':genero'=>$dados['genero'],':status'=>$dados['status_leitura'],':emprestado'=>$dados['emprestado_para']!==''?$dados['emprestado_para']:null]);
        header('Location: listar.php?sucesso=cadastrado'); exit;
    }
}
?>
<?php include __DIR__ . '/../includes/app-header.php'; ?>
<div class="page-title"><div><span class="eyebrow">NOVO REGISTRO</span><h1>Cadastrar livro</h1><p>Adicione uma nova história ao seu acervo.</p></div></div>
<?php if($erros): ?><div class="alert alert-danger"><ul class="mb-0"><?php foreach($erros as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<div class="content-card form-card">
<form method="POST" class="row g-4">
<div class="col-md-8"><label class="form-label">Título *</label><input class="form-control form-control-lg" name="titulo" maxlength="150" value="<?= htmlspecialchars($dados['titulo']) ?>" required></div>
<div class="col-md-4"><label class="form-label">Ano *</label><input class="form-control form-control-lg" type="number" name="ano" min="0" max="<?= date('Y') ?>" value="<?= htmlspecialchars($dados['ano']) ?>" required></div>
<div class="col-md-6"><label class="form-label">Autor *</label><input class="form-control form-control-lg" name="autor" maxlength="100" value="<?= htmlspecialchars($dados['autor']) ?>" required></div>
<div class="col-md-6"><label class="form-label">Gênero *</label><input class="form-control form-control-lg" name="genero" maxlength="50" placeholder="Ex.: Fantasia" value="<?= htmlspecialchars($dados['genero']) ?>" required></div>
<div class="col-md-6"><label class="form-label">Status de leitura *</label><select class="form-select form-select-lg" name="status_leitura"><?php foreach(['Não lido','Lendo','Lido'] as $s): ?><option <?= $dados['status_leitura']===$s?'selected':'' ?>><?= $s ?></option><?php endforeach; ?></select></div>
<div class="col-md-6"><label class="form-label">Emprestado para</label><input class="form-control form-control-lg" name="emprestado_para" maxlength="100" placeholder="Deixe vazio se estiver com você" value="<?= htmlspecialchars($dados['emprestado_para']) ?>"></div>
<div class="col-12 d-flex gap-2"><button class="btn btn-primary btn-lg">Salvar livro</button><a href="listar.php" class="btn btn-outline-secondary btn-lg">Cancelar</a></div>
</form>
</div>
<?php include __DIR__ . '/../includes/app-footer.php'; ?>