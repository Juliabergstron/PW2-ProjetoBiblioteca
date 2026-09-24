<?php
session_start();
require_once __DIR__ . '/config/conexao.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit;
}

$erro = '';
$nome = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmacao = $_POST['confirmacao'] ?? '';

    if ($nome === '' || $email === '' || $senha === '') {
        $erro = 'Preencha todos os campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Digite um e-mail válido.';
    } elseif (strlen($senha) < 6) {
        $erro = 'A senha deve ter pelo menos 6 caracteres.';
    } elseif ($senha !== $confirmacao) {
        $erro = 'As senhas não coincidem.';
    } else {
        $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = :email');
        $stmt->execute([':email' => $email]);

        if ($stmt->fetch()) {
            $erro = 'Este e-mail já está cadastrado.';
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)');
            $stmt->execute([':nome' => $nome, ':email' => $email, ':senha' => $hash]);
            header('Location: login.php?cadastro=ok');
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Criar conta • Biblioteca Virtual</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="auth-page">
<div class="auth-layout">
    <section class="auth-visual compact">
        <div class="brand-mini">📚 BIBLIOTECA VIRTUAL</div>
        <div class="bookshelf-art" aria-hidden="true">
            <div class="shelf"><i class="book b2"></i><i class="book b5"></i><i class="book b1"></i><i class="book b8"></i><i class="book b4"></i><i class="book b6"></i></div>
            <div class="shelf"><i class="book b7"></i><i class="book b3"></i><i class="book b6"></i><i class="book b2"></i><i class="book b5"></i></div>
        </div>
        <div class="visual-copy">
            <span>COMECE SUA COLEÇÃO</span>
            <h1>Crie seu cantinho para guardar suas histórias.</h1>
        </div>
    </section>
    <section class="auth-form-area">
        <div class="auth-card">
            <div class="auth-logo">✨</div>
            <p class="eyebrow">NOVO CADASTRO</p>
            <h2>Criar conta</h2>
            <p class="muted">Leva menos de um minuto.</p>

            <?php if ($erro): ?>
                <div class="alert alert-danger py-2"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <form method="POST" class="mt-4">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control form-control-lg" placeholder="Seu nome" value="<?= htmlspecialchars($nome) ?>" required>

                <label class="form-label mt-3">E-mail</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="seu@email.com" value="<?= htmlspecialchars($email) ?>" required>

                <label class="form-label mt-3">Senha</label>
                <input type="password" name="senha" class="form-control form-control-lg" minlength="6" placeholder="Mínimo de 6 caracteres" required>

                <label class="form-label mt-3">Confirmar senha</label>
                <input type="password" name="confirmacao" class="form-control form-control-lg" minlength="6" placeholder="Digite novamente" required>

                <button class="btn btn-primary btn-lg w-100 mt-4">Criar minha conta</button>
            </form>

            <p class="text-center mt-4 mb-0 muted">Já possui conta?
                <a href="login.php" class="link-main">Entrar</a>
            </p>
        </div>
    </section>
</div>
</body>
</html>
