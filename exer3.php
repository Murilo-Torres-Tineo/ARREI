<?php
$names = [
    'Ana',
    'Bruno',
    'Carla',
    'Diego',
    'Eduarda',
    'Fernando',
    'Gabriela',
    'Hugo',
];

$remove = 'Diego';
$index = array_search($remove, $names);
if ($index !== false) {
    unset($names[$index]);
    $names = array_values($names);
}

$old = 'Carla';
$new = 'Carolina';
$index = array_search($old, $names);
if ($index !== false) {
    $names[$index] = $new;
}

array_unshift($names, 'Isabela');
array_push($names, 'Joaquim');

$count = count($names);
echo "<p>Quantidade de nomes: <strong>$count</strong></p>\n";
echo "<ul>\n";
foreach ($names as $n) {
    echo "<li>$n</li>\n";
}
echo "</ul>\n";
?>