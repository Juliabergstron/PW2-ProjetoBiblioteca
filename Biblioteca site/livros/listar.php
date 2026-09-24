```php
<?php

require_once __DIR__ . '/../config/auth.php';
exigirLogin();

require_once __DIR__ . '/../config/conexao.php';


// ======================================================
// FILTROS
// ======================================================

$busca = trim($_GET['busca'] ?? '');
$status = $_GET['status'] ?? '';
$genero = trim($_GET['genero'] ?? '');


// ======================================================
// CONSULTA DOS LIVROS
// ======================================================

$sql = "SELECT * FROM livros WHERE 1=1";

$params = [];


// 🔎 PESQUISA POR TÍTULO OU AUTOR
if ($busca !== '') {

    $sql .= " AND (
        titulo LIKE :busca_titulo
        OR autor LIKE :busca_autor
    )";

    $termo = "%{$busca}%";

    $params[':busca_titulo'] = $termo;
    $params[':busca_autor'] = $termo;
}


// 📖 FILTRO POR STATUS
if ($status !== '') {

    $sql .= " AND status_leitura = :status";

    $params[':status'] = $status;
}


// 📚 FILTRO POR GÊNERO
if ($genero !== '') {

    $sql .= " AND genero = :genero";

    $params[':genero'] = $genero;
}


// ======================================================
// ORDENAÇÃO
// ======================================================

$sql .= " ORDER BY id DESC";


// ======================================================
// EXECUÇÃO
// ======================================================

$stmt = $pdo->prepare($sql);

$stmt->execute($params);

$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);


// ======================================================
// GÊNEROS DISPONÍVEIS
// ======================================================

$generos = $pdo
    ->query("SELECT DISTINCT genero FROM livros ORDER BY genero")
    ->fetchAll(PDO::FETCH_COLUMN);


// ======================================================
// MENSAGENS
// ======================================================

$mensagens = [

    'cadastrado' => 'Livro cadastrado com sucesso!',

    'editado' => 'Livro atualizado com sucesso!',

    'excluido' => 'Livro excluído com sucesso!'

];

$sucesso = $_GET['sucesso'] ?? '';

?>

<?php include __DIR__ . '/../includes/app-header.php'; ?>


<!-- ======================================================
     TÍTULO
====================================================== -->

<div class="page-title">

    <div>

        <span class="eyebrow">
            GERENCIAMENTO
        </span>

        <h1>
            Meu acervo
        </h1>

        <p>
            Todos os seus livros em um só lugar.
        </p>

    </div>


    <a
        href="cadastrar.php"
        class="btn btn-primary"
    >
        + Cadastrar livro
    </a>

</div>


<!-- ======================================================
     MENSAGEM DE SUCESSO
====================================================== -->

<?php if (isset($mensagens[$sucesso])): ?>

    <div
        class="alert alert-success alert-dismissible fade show"
        role="alert"
    >

        <?= htmlspecialchars($mensagens[$sucesso]) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>

    </div>

<?php endif; ?>


<!-- ======================================================
     PESQUISA E FILTROS
====================================================== -->

<div class="content-card mb-4">

    <form
        method="GET"
        class="row g-2 align-items-end"
    >

        <!-- PESQUISA -->

        <div class="col-lg-5">

            <label class="form-label">
                Pesquisar
            </label>

            <input
                type="text"
                name="busca"
                class="form-control"
                placeholder="Título ou autor..."
                value="<?= htmlspecialchars($busca) ?>"
            >

        </div>


        <!-- STATUS -->

        <div class="col-lg-3">

            <label class="form-label">
                Status
            </label>

            <select
                name="status"
                class="form-select"
            >

                <option value="">
                    Todos
                </option>

                <?php foreach (['Não lido', 'Lendo', 'Lido'] as $s): ?>

                    <option
                        value="<?= htmlspecialchars($s) ?>"
                        <?= $status === $s ? 'selected' : '' ?>
                    >

                        <?= htmlspecialchars($s) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>


        <!-- GÊNERO -->

        <div class="col-lg-2">

            <label class="form-label">
                Gênero
            </label>

            <select
                name="genero"
                class="form-select"
            >

                <option value="">
                    Todos
                </option>

                <?php foreach ($generos as $g): ?>

                    <option
                        value="<?= htmlspecialchars($g) ?>"
                        <?= $genero === $g ? 'selected' : '' ?>
                    >

                        <?= htmlspecialchars($g) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>


        <!-- BOTÃO -->

        <div class="col-lg-2 d-grid">

            <button
                type="submit"
                class="btn btn-dark"
            >
                Filtrar
            </button>

        </div>

    </form>


    <!-- LIMPAR FILTROS -->

    <?php if ($busca !== '' || $status !== '' || $genero !== ''): ?>

        <div class="mt-3">

            <a
                href="listar.php"
                class="btn btn-sm btn-outline-secondary"
            >
                Limpar filtros
            </a>

        </div>

    <?php endif; ?>

</div>


<!-- ======================================================
     TABELA
====================================================== -->

<div class="content-card p-0 overflow-hidden">

    <div class="table-responsive">

        <table class="table align-middle mb-0 library-table">

            <thead>

                <tr>

                    <th>
                        Livro
                    </th>

                    <th>
                        Autor
                    </th>

                    <th>
                        Ano
                    </th>

                    <th>
                        Gênero
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Emprestado para
                    </th>

                    <th class="text-end">
                        Ações
                    </th>

                </tr>

            </thead>


            <tbody>

                <?php foreach ($livros as $livro): ?>

                    <tr>

                        <!-- LIVRO -->

                        <td>

                            <div class="table-book">

                                <div class="mini-cover">

                                    <?= htmlspecialchars(
                                        mb_substr(
                                            $livro['titulo'],
                                            0,
                                            1
                                        )
                                    ) ?>

                                </div>

                                <strong>

                                    <?= htmlspecialchars(
                                        $livro['titulo']
                                    ) ?>

                                </strong>

                            </div>

                        </td>


                        <!-- AUTOR -->

                        <td>

                            <?= htmlspecialchars(
                                $livro['autor']
                            ) ?>

                        </td>


                        <!-- ANO -->

                        <td>

                            <?= htmlspecialchars(
                                $livro['ano']
                            ) ?>

                        </td>


                        <!-- GÊNERO -->

                        <td>

                            <span class="genre-tag">

                                <?= htmlspecialchars(
                                    $livro['genero']
                                ) ?>

                            </span>

                        </td>


                        <!-- STATUS -->

                        <td>

                            <span class="status-pill">

                                <?= htmlspecialchars(
                                    $livro['status_leitura']
                                ) ?>

                            </span>

                        </td>


                        <!-- EMPRÉSTIMO -->

                        <td>

                            <?php if (!empty($livro['emprestado_para'])): ?>

                                <?= htmlspecialchars(
                                    $livro['emprestado_para']
                                ) ?>

                            <?php else: ?>

                                <span class="muted">
                                    Disponível
                                </span>

                            <?php endif; ?>

                        </td>


                        <!-- AÇÕES -->

                        <td class="text-end text-nowrap">

                            <a
                                class="btn btn-sm btn-outline-primary"
                                href="editar.php?id=<?= (int)$livro['id'] ?>"
                            >
                                Editar
                            </a>


                            <a
                                class="btn btn-sm btn-outline-danger"
                                href="excluir.php?id=<?= (int)$livro['id'] ?>"
                                onclick="return confirmarExclusao(<?= htmlspecialchars(
                                    json_encode(
                                        $livro['titulo'],
                                        JSON_UNESCAPED_UNICODE
                                    )
                                ) ?>)"
                            >
                                Excluir
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>


                <!-- NENHUM RESULTADO -->

                <?php if (!$livros): ?>

                    <tr>

                        <td colspan="7">

                            <div class="empty-state py-5">

                                <div>
                                    🔎
                                </div>

                                <h3>
                                    Nenhum livro encontrado
                                </h3>

                                <?php if ($busca !== ''): ?>

                                    <p>
                                        Nenhum livro foi encontrado
                                        para
                                        <strong>
                                            "<?= htmlspecialchars($busca) ?>"
                                        </strong>.
                                    </p>

                                <?php else: ?>

                                    <p>
                                        Tente mudar os filtros ou
                                        cadastre um novo livro.
                                    </p>

                                <?php endif; ?>

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<?php include __DIR__ . '/../includes/app-footer.php'; ?>
```
