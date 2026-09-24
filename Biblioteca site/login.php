<?php
session_start();
require_once __DIR__ . '/config/conexao.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit;
}

$erro = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($email === '' || $senha === '') {
        $erro = 'Preencha e-mail e senha.';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            header('Location: dashboard.php');
            exit;
        }

        $erro = 'E-mail ou senha incorretos.';
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Entrar • Biblioteca Virtual</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="auth-page">
<div class="auth-layout">
    <section class="auth-visual">
        <div class="brand-mini">📚 BIBLIOTECA VIRTUAL</div>
        <div class="bookshelf-art" aria-hidden="true">
            <div class="shelf"><i class="book b1"></i><i class="book b2"></i><i class="book b3"></i><i class="book b4"></i><i class="book b5"></i><i class="book b6"></i><i class="book b7"></i><i class="book b8"></i></div>
            <div class="shelf"><i class="book b3"></i><i class="book b8"></i><i class="book b2"></i><i class="book b6"></i><i class="book b1"></i><i class="book b5"></i><i class="book b4"></i></div>
            <div class="shelf"><i class="book b6"></i><i class="book b4"></i><i class="book b1"></i><i class="book b7"></i><i class="book b2"></i><i class="book b5"></i><i class="book b8"></i></div>
        </div>
        <div class="visual-copy">
            <span>SEU ACERVO, SEU ESPAÇO</span>
            <h1>Entre nas histórias que fazem parte da sua biblioteca.</h1>
            <p>Organize seus livros, acompanhe suas leituras e registre seus empréstimos em um só lugar.</p>
        </div>
    </section>

    <section class="auth-form-area">
        <div class="auth-card">
            <div class="auth-logo">📖</div>
            <p class="eyebrow">BEM-VINDA(O)</p>
            <h2>Entrar na biblioteca</h2>
            <p class="muted">Acesse sua coleção de livros.</p>

            <?php if ($erro): ?>
                <div class="alert alert-danger py-2"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <form method="POST" class="mt-4">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="seu@email.com" value="<?= htmlspecialchars($email) ?>" required>

                <label class="form-label mt-3">Senha</label>
                <input type="password" name="senha" class="form-control form-control-lg" placeholder="••••••••" required>

                <button class="btn btn-primary btn-lg w-100 mt-4">Entrar</button>
            </form>

            <p class="text-center mt-4 mb-0 muted">Ainda não possui conta?
                <a href="cadastro.php" class="link-main">Criar conta</a>
            </p>

            <div class="demo-login mt-4">
                <strong>Acesso de demonstração</strong>
                <span>E-mail: admin@biblioteca.com</span>
                <span>Senha: 123456</span>
            </div>
        </div>
    </section>
</div>
</body>
</html>
