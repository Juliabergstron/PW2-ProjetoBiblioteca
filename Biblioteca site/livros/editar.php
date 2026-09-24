<?php
require_once __DIR__ . '/../config/auth.php';
exigirLogin();
require_once __DIR__ . '/../config/conexao.php';

$id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
if(!$id){header('Location:listar.php');exit;}
$stmt=$pdo->prepare('SELECT * FROM livros WHERE id=:id'); $stmt->execute([':id'=>$id]); $livro=$stmt->fetch();
if(!$livro){header('Location:listar.php');exit;}
$erros=[];
if($_SERVER['REQUEST_METHOD']==='POST'){
    foreach(['titulo','autor','ano','genero','status_leitura','emprestado_para'] as $campo) $livro[$campo]=trim($_POST[$campo]??'');
    if($livro['titulo']==='')$erros[]='Informe o título.';
    if($livro['autor']==='')$erros[]='Informe o autor.';
    if(!filter_var($livro['ano'],FILTER_VALIDATE_INT)||$livro['ano']<0||$livro['ano']>date('Y'))$erros[]='Informe um ano válido.';
    if($livro['genero']==='')$erros[]='Informe o gênero.';
    if(!in_array($livro['status_leitura'],['Não lido','Lendo','Lido'],true))$erros[]='Status inválido.';
    if(!$erros){
        $stmt=$pdo->prepare("UPDATE livros SET titulo=:titulo,autor=:autor,ano=:ano,genero=:genero,status_leitura=:status,emprestado_para=:emprestado WHERE id=:id");
        $stmt->execute([':titulo'=>$livro['titulo'],':autor'=>$livro['autor'],':ano'=>$livro['ano'],':genero'=>$livro['genero'],':status'=>$livro['status_leitura'],':emprestado'=>$livro['emprestado_para']!==''?$livro['emprestado_para']:null,':id'=>$id]);
        header('Location:listar.php?sucesso=editado');exit;
    }
}
?>
<?php include __DIR__ . '/../includes/app-header.php'; ?>
<div class="page-title"><div><span class="eyebrow">ATUALIZAÇÃO</span><h1>Editar livro</h1><p>Altere os dados e mantenha seu acervo atualizado.</p></div></div>
<?php if($erros): ?><div class="alert alert-danger"><ul class="mb-0"><?php foreach($erros as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<div class="content-card form-card">
<form method="POST" class="row g-4">
<div class="col-md-8"><label class="form-label">Título *</label><input class="form-control form-control-lg" name="titulo" maxlength="150" value="<?= htmlspecialchars($livro['titulo']) ?>" required></div>
<div class="col-md-4"><label class="form-label">Ano *</label><input class="form-control form-control-lg" type="number" name="ano" min="0" max="<?= date('Y') ?>" value="<?= htmlspecialchars($livro['ano']) ?>" required></div>
<div class="col-md-6"><label class="form-label">Autor *</label><input class="form-control form-control-lg" name="autor" maxlength="100" value="<?= htmlspecialchars($livro['autor']) ?>" required></div>
<div class="col-md-6"><label class="form-label">Gênero *</label><input class="form-control form-control-lg" name="genero" maxlength="50" value="<?= htmlspecialchars($livro['genero']) ?>" required></div>
<div class="col-md-6"><label class="form-label">Status de leitura *</label><select class="form-select form-select-lg" name="status_leitura"><?php foreach(['Não lido','Lendo','Lido'] as $s): ?><option <?= $livro['status_leitura']===$s?'selected':'' ?>><?= $s ?></option><?php endforeach; ?></select></div>
<div class="col-md-6"><label class="form-label">Emprestado para</label><input class="form-control form-control-lg" name="emprestado_para" maxlength="100" value="<?= htmlspecialchars($livro['emprestado_para']??'') ?>"></div>
<div class="col-12 d-flex gap-2"><button class="btn btn-primary btn-lg">Salvar alterações</button><a href="listar.php" class="btn btn-outline-secondary btn-lg">Cancelar</a></div>
</form>
</div>
<?php include __DIR__ . '/../includes/app-footer.php'; ?>