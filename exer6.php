<?php
$products = [
    ['nome' => 'Camiseta', 'categoria' => 'Vestuário', 'preco' => 79.90, 'estoque' => 10],
    ['nome' => 'Calça Jeans', 'categoria' => 'Vestuário', 'preco' => 149.90, 'estoque' => 4],
    ['nome' => 'Tênis', 'categoria' => 'Calçados', 'preco' => 299.90, 'estoque' => 3],
    ['nome' => 'Meias (pacote)', 'categoria' => 'Vestuário', 'preco' => 29.90, 'estoque' => 20],
    ['nome' => 'Relógio', 'categoria' => 'Acessórios', 'preco' => 499.90, 'estoque' => 2],
    ['nome' => 'Boné', 'categoria' => 'Acessórios', 'preco' => 59.90, 'estoque' => 8],
    ['nome' => 'Mochila', 'categoria' => 'Acessórios', 'preco' => 199.90, 'estoque' => 6],
    ['nome' => 'Camisa Social', 'categoria' => 'Vestuário', 'preco' => 129.90, 'estoque' => 1],
];

$lowStock = [];
$totalValue = 0;
$highestValueProduct = null;

foreach ($products as $p) {
    $value = $p['preco'] * $p['estoque'];
    $totalValue += $value;
    if ($p['estoque'] < 5) {
        $lowStock[] = $p;
    }
    if ($highestValueProduct === null || $value > ($highestValueProduct['preco'] * $highestValueProduct['estoque'])) {
        $highestValueProduct = $p;
    }
}

echo "<h2>Produtos com estoque abaixo de 5 unidades</h2>\n";
if (!empty($lowStock)) {
    echo "<ul>\n";
    foreach ($lowStock as $l) {
        echo "<li>{$l['nome']} ({$l['categoria']}) - Estoque: {$l['estoque']}</li>\n";
    }
    echo "</ul>\n";
} else {
    echo "<p>Não há produtos com estoque baixo.</p>\n";
}

echo "<p><strong>Valor total do estoque:</strong> R$ " . number_format($totalValue, 2, ',', '.') . "</p>\n";
echo "<p><strong>Produto com maior valor armazenado:</strong> {$highestValueProduct['nome']} — R$ " . number_format($highestValueProduct['preco'] * $highestValueProduct['estoque'], 2, ',', '.') . "</p>\n";

?>