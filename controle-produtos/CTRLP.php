<?php
session_start();

if (!isset($_SESSION['produtos'])) {
    $_SESSION['produtos'] = [];
}

$mensagem = '';
$termoPesquisa = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    switch ($acao) {
        case 'adicionar':
            $nome = trim((string) ($_POST['nome'] ?? ''));
            $categoria = trim((string) ($_POST['categoria'] ?? ''));
            $preco = (float) ($_POST['preco'] ?? 0);
            $quantidade = (int) ($_POST['quantidade'] ?? 0);
            $quantidadeVendida = (int) ($_POST['quantidadeVendida'] ?? 0);

            if ($nome !== '' && $categoria !== '' && $preco > 0 && $quantidade >= 0) {
                $_SESSION['produtos'][] = [
                    'nome' => $nome,
                    'categoria' => $categoria,
                    'preco' => $preco,
                    'quantidade' => $quantidade,
                    'quantidadeVendida' => $quantidadeVendida,
                ];
                $mensagem = 'Produto adicionado com sucesso!';
            } else {
                $mensagem = 'Preencha todos os campos corretamente.';
            }
            break;

        case 'remover_primeiro':
            if (!empty($_SESSION['produtos'])) {
                array_shift($_SESSION['produtos']);
            }
            break;

        case 'remover_ultimo':
            if (!empty($_SESSION['produtos'])) {
                array_pop($_SESSION['produtos']);
            }
            break;

        case 'pesquisar':
            $termoPesquisa = strtolower(trim((string) ($_POST['pesquisa'] ?? '')));
            break;
    }
}

$produtos = $_SESSION['produtos'];

if ($termoPesquisa !== '') {
    $produtos = array_values(array_filter($produtos, function ($produto) use ($termoPesquisa) {
        $nome = strtolower((string) ($produto['nome'] ?? ''));

        return str_contains($nome, $termoPesquisa);
    }));
}

function maiorEstoque(array $itens): ?array
{
    if (empty($itens)) {
        return null;
    }

    $maior = $itens[0];
    foreach ($itens as $produto) {
        if ((int) ($produto['quantidade'] ?? 0) > (int) ($maior['quantidade'] ?? 0)) {
            $maior = $produto;
        }
    }

    return $maior;
}

function menorEstoque(array $itens): ?array
{
    if (empty($itens)) {
        return null;
    }

    $menor = $itens[0];
    foreach ($itens as $produto) {
        if ((int) ($produto['quantidade'] ?? 0) < (int) ($menor['quantidade'] ?? 0)) {
            $menor = $produto;
        }
    }

    return $menor;
}

function maisVendido(array $itens): ?array
{
    if (empty($itens)) {
        return null;
    }

    $maisVendido = $itens[0];
    foreach ($itens as $produto) {
        if ((int) ($produto['quantidadeVendida'] ?? 0) > (int) ($maisVendido['quantidadeVendida'] ?? 0)) {
            $maisVendido = $produto;
        }
    }

    return $maisVendido;
}

function menosVendido(array $itens): ?array
{
    if (empty($itens)) {
        return null;
    }

    $menosVendido = $itens[0];
    foreach ($itens as $produto) {
        if ((int) ($produto['quantidadeVendida'] ?? 0) < (int) ($menosVendido['quantidadeVendida'] ?? 0)) {
            $menosVendido = $produto;
        }
    }

    return $menosVendido;
}

function produtoMaisCaro(array $itens): ?array
{
    if (empty($itens)) {
        return null;
    }

    $maisCaro = $itens[0];
    foreach ($itens as $produto) {
        if ((float) ($produto['preco'] ?? 0) > (float) ($maisCaro['preco'] ?? 0)) {
            $maisCaro = $produto;
        }
    }

    return $maisCaro;
}

function produtoMaisBarato(array $itens): ?array
{
    if (empty($itens)) {
        return null;
    }

    $maisBarato = $itens[0];
    foreach ($itens as $produto) {
        if ((float) ($produto['preco'] ?? 0) < (float) ($maisBarato['preco'] ?? 0)) {
            $maisBarato = $produto;
        }
    }

    return $maisBarato;
}

function valorTotalEstoque(array $itens): float
{
    $total = 0.0;

    foreach ($itens as $produto) {
        $total += (float) ($produto['preco'] ?? 0) * (int) ($produto['quantidade'] ?? 0);
    }

    return $total;
}

$produtoMaiorEstoque = maiorEstoque($produtos);
$produtoMenorEstoque = menorEstoque($produtos);
$produtoMaisVendido = maisVendido($produtos);
$produtoMenosVendido = menosVendido($produtos);
$produtoMaisCaro = produtoMaisCaro($produtos);
$produtoMaisBarato = produtoMaisBarato($produtos);
$totalEstoque = valorTotalEstoque($produtos);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Produtos</title>
    <link rel="stylesheet" href="/ARREI/controle-produtos/style.css">
</head>

<body>
    <div class="container">
        <header class="topo">
            <h1>Controle de Produtos</h1>
            <p>Gestão de estoque usando PHP, HTML, CSS e sessões.</p>
        </header>

        <?php if ($mensagem !== ''): ?>
            <div class="alerta"><?= htmlspecialchars($mensagem); ?></div>
        <?php endif; ?>

        <section class="painel">
            <h2>Adicionar produto</h2>
            <form method="post" class="form-grid">
                <input type="hidden" name="acao" value="adicionar">

                <label>
                    Nome
                    <input type="text" name="nome" placeholder="Ex.: Mouse sem fio" required>
                </label>

                <label>
                    Categoria
                    <input type="text" name="categoria" placeholder="Ex.: Eletrônicos" required>
                </label>

                <label>
                    Preço
                    <input type="number" name="preco" step="0.01" min="0.01" placeholder="0.00" required>
                </label>

                <label>
                    Quantidade em estoque
                    <input type="number" name="quantidade" min="0" value="0" required>
                </label>

                <label>
                    Quantidade vendida
                    <input type="number" name="quantidadeVendida" min="0" value="0">
                </label>

                <button type="submit">Adicionar</button>
            </form>
        </section>

        <section class="botoes-acao">
            <h2>Ações rápidas</h2>

            <form method="post" class="inline-form">
                <input type="hidden" name="acao" value="remover_primeiro">
                <button type="submit">Excluir primeiro</button>
            </form>

            <form method="post" class="inline-form">
                <input type="hidden" name="acao" value="remover_ultimo">
                <button type="submit">Excluir último</button>
            </form>
        </section>

        <section class="pesquisa">
            <h2>Pesquisar produto</h2>
            <form method="post" class="inline-form">
                <input type="hidden" name="acao" value="pesquisar">
                <input type="text" name="pesquisa" value="<?= htmlspecialchars($termoPesquisa); ?>"
                    placeholder="Digite o nome do produto">
                <button type="submit">Buscar</button>
            </form>
        </section>

        <section class="cards">
            <div class="card">
                <span>Maior estoque</span>
                <strong>
                    <?= $produtoMaiorEstoque ? htmlspecialchars($produtoMaiorEstoque['nome']) . ' (' . $produtoMaiorEstoque['quantidade'] . ')' : 'N/A'; ?>
                </strong>
            </div>

            <div class="card">
                <span>Menor estoque</span>
                <strong>
                    <?= $produtoMenorEstoque ? htmlspecialchars($produtoMenorEstoque['nome']) . ' (' . $produtoMenorEstoque['quantidade'] . ')' : 'N/A'; ?>
                </strong>
            </div>

            <div class="card">
                <span>Mais vendido</span>
                <strong>
                    <?= $produtoMaisVendido ? htmlspecialchars($produtoMaisVendido['nome']) . ' (' . $produtoMaisVendido['quantidadeVendida'] . ')' : 'N/A'; ?>
                </strong>
            </div>

            <div class="card">
                <span>Menos vendido</span>
                <strong>
                    <?= $produtoMenosVendido ? htmlspecialchars($produtoMenosVendido['nome']) . ' (' . $produtoMenosVendido['quantidadeVendida'] . ')' : 'N/A'; ?>
                </strong>
            </div>

            <div class="card">
                <span>Valor total do estoque</span>
                <strong>R$ <?= number_format($totalEstoque, 2, ',', '.'); ?></strong>
            </div>

            <div class="card">
                <span>Produto mais caro</span>
                <strong>
                    <?= $produtoMaisCaro ? htmlspecialchars($produtoMaisCaro['nome']) . ' (R$ ' . number_format((float) $produtoMaisCaro['preco'], 2, ',', '.') . ')' : 'N/A'; ?>
                </strong>
            </div>

            <div class="card">
                <span>Produto mais barato</span>
                <strong>
                    <?= $produtoMaisBarato ? htmlspecialchars($produtoMaisBarato['nome']) . ' (R$ ' . number_format((float) $produtoMaisBarato['preco'], 2, ',', '.') . ')' : 'N/A'; ?>
                </strong>
            </div>
        </section>

        <section class="tabela">
            <h2>Produtos cadastrados</h2>

            <?php if (empty($produtos)): ?>
                <p class="vazio">Nenhum produto encontrado na pesquisa.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Vendidas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos as $produto): ?>
                            <tr>
                                <td><?= htmlspecialchars($produto['nome']); ?></td>
                                <td><?= htmlspecialchars($produto['categoria']); ?></td>
                                <td>R$ <?= number_format((float) ($produto['preco'] ?? 0), 2, ',', '.'); ?></td>
                                <td><?= (int) ($produto['quantidade'] ?? 0); ?></td>
                                <td><?= (int) ($produto['quantidadeVendida'] ?? 0); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </div>
</body>

</html>