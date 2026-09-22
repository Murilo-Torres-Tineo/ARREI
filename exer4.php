<?php
$numbers = [
    5,
    12,
    7,
    5,
    3,
    12,
    9,
    7,
    21,
    3,
    18,
    9,
    30,
    5,
    41,
];

$counts = array_count_values($numbers);

$repeated = array_filter($counts, function ($c) {
    return $c > 1; });

$unique = array_filter($counts, function ($c) {
    return $c === 1; });

echo "<h2>Vetor de números</h2>\n<p>" . implode(', ', $numbers) . "</p>\n";

if (!empty($repeated)) {
    echo "<h3>Números repetidos</h3>\n<ul>\n";
    foreach ($repeated as $num => $cnt) {
        echo "<li>$num: $cnt vezes</li>\n";
    }
    echo "</ul>\n";
} else {
    echo "<p>Nenhum número repetido encontrado.</p>\n";
}

if (!empty($unique)) {
    echo "<h3>Números que aparecem somente uma vez</h3>\n<p>" . implode(', ', array_keys($unique)) . "</p>\n";
} else {
    echo "<p>Não há números únicos.</p>\n";
}

?>