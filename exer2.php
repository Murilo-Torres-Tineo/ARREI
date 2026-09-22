<?php
$products = [
    'Notebook' => 3500.00,
    'Smartphone' => 2500.00,
    'Geladeira' => 1800.00,
    'TV 55"' => 2200.00,
    'Fone de Ouvido' => 350.00,
    'Mouse' => 80.00,
    'Teclado' => 150.00,
    'Liquidificador' => 450.00,
    'Microondas' => 600.00,
    'Cafeteira' => 200.00,
];

function fmt($value)
{
    return 'R$ ' . number_format($value, 2, ',', '.');
}

echo "<h2>Lista de produtos</h2>\n<ul>\n";
foreach ($products as $name => $price) {
    echo "<li>$name: " . fmt($price) . "</li>\n";
}
echo "</ul>\n";

$maxPrice = max($products);
$minPrice = min($products);
$mostExpensive = array_search($maxPrice, $products);
$cheapest = array_search($minPrice, $products);

echo "<p><strong>Produto mais caro:</strong> $mostExpensive — " . fmt($maxPrice) . "</p>\n";
echo "<p><strong>Produto mais barato:</strong> $cheapest — " . fmt($minPrice) . "</p>\n";

$total = array_sum($products);
echo "<p><strong>Valor total (sem desconto):</strong> " . fmt($total) . "</p>\n";

$discounted = [];
foreach ($products as $name => $price) {
    if ($price > 500) {
        $discounted[$name] = $price * 0.90;
    } else {
        $discounted[$name] = $price;
    }
}

echo "<h2>Produtos após desconto (10% para itens &gt; R$ 500,00)</h2>\n<ul>\n";
foreach ($discounted as $name => $price) {
    $original = $products[$name];
    if ($original > 500) {
        echo "<li>$name: <del>" . fmt($original) . "</del> " . fmt($price) . "</li>\n";
    } else {
        echo "<li>$name: " . fmt($price) . "</li>\n";
    }
}
echo "</ul>\n";

$totalDiscounted = array_sum($discounted);
$savings = $total - $totalDiscounted;

echo "<p><strong>Valor total (com desconto):</strong> " . fmt($totalDiscounted) . "</p>\n";
echo "<p><strong>Total economizado:</strong> " . fmt($savings) . "</p>\n";

?>